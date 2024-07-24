<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AclResource;
use App\Models\UserActivity;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private const VALIDATION_RULE_NAME = 'required|max:100';
    private const VALIDATION_RULE_PASSWORD = 'min:5|max:40';

    private $validation_messages = [
        'fullname.required' => 'Nama harus diisi.',
        'fullname.max' => 'Nama terlalu panjang, maksimal 100 karakter.',
        'username.required' => 'ID Pengguna harus diisi.',
        'username.unique' => 'ID Pengguna harus unik.',
        'username.min' => 'ID Pengguna terlalu pendek, minial 5 karakter.',
        'username.max' => 'ID Pengguna terlalu panjang, maksimal 40 karakter.',
        'password.min' => 'Kata sandi terlalu pendek, minimal 5 karakter.',
        'password.max' => 'Kata sandi terlalu panjang, maksimal 40 karakter.',
        'password.confirmed' => 'Kata sandi yang anda konfirmasi salah.',
        'password_confirmation.required' => 'Anda belum mengkonfirmasi kata sandi.',
        'current_password.required' => 'Kata sandi harus diisi.',
    ];

    public function index(Request $request)
    {
        ensure_user_can_access(AclResource::USER_MANAGEMENT);

        $filter = [
            'search' => $request->get('search', ''),
            'status' => $request->get('status', '-1'),
            'type' => $request->get('type', '-1'),
            'group_id' => $request->get('group_id', ''),
        ];
        $q = User::with('group');
        if ($filter['status'] != -1) {
            $q->where('is_active', '=', $filter['status']);
        }
        if ($filter['type'] != -1) {
            $q->where('is_admin', '=', $filter['type']);
        }
        if ($filter['group_id'] > 0) {
            $q->where('group_id', '=', $filter['group_id']);
        }
        if (!empty($filter['search'])) {
            $q->where('username', 'like', '%' . $filter['search'] . '%');
            $q->orWhere('fullname', 'like', '%' . $filter['search'] . '%');
        }
        $items = $q->orderBy('fullname', 'asc')->paginate(10);
        $groups = UserGroup::orderBy('name', 'asc')->get();
        return view('pages.admin.user.index', compact('items', 'filter', 'groups'));
    }

    public function edit(Request $request, $id = 0)
    {
        ensure_user_can_access(AclResource::USER_MANAGEMENT);

        $user = (int)$id == 0 ? new User() : User::find($id);

        if (!$user) {
            return redirect('admin/user')->with('warning', 'Pengguna tidak ditemukan.');
        } else if ($user->username == 'admin') {
            return redirect('admin/user')->with('warning', 'Akun <b>' . $user->username . '</b> tidak boleh diubah.');
        }

        if ($request->method() == 'POST') {
            $rules = ['fullname' => self::VALIDATION_RULE_NAME];

            if (!$id) {
                $rules['username'] = 'required|unique:users,username,' . $id . '|min:3|max:40';
            } else if (!empty($request->password)) {
                $rules['password'] = self::VALIDATION_RULE_PASSWORD;
            }

            $data = $request->all();
            $validator = Validator::make($data, $rules, $this->validation_messages);
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }

            fill_with_default_value($data, ['is_active', 'is_admin'], false);
            fill_with_default_value($data, ['group_id'], null);

            if (empty($request->password)) {
                unset($data['password']);
            }

            $user->fill($data);

            if (!$id) {
                $message = 'Akun pengguna <b>' . $data['username'] . '</b> telah dibuat.';
            } else {
                $message = 'Akun pengguna <b>' . $data['username'] . '</b> telah diperbarui.';
            }

            $user->save();

            UserActivity::log(UserActivity::USER_MANAGEMENT, ($id == 0 ? 'Tambah' : 'Perbarui') . ' Pengguna', $message);

            return redirect('admin/user')->with('info', $message);
        }

        $groups = UserGroup::orderBy('name', 'asc')->get();

        return view('pages.admin.user.edit', compact('user', 'groups'));
    }

    public function profile(Request $request)
    {
        if (!$user = User::find(Auth::user()->id)) {
            return redirect('/admin/login');
        }

        if ($request->method() == 'POST') {
            $changedFields = ['fullname'];
            $rules = [
                'fullname' => self::VALIDATION_RULE_NAME,
                'current_password' => 'required',
            ];

            if (!empty($request->password)) {
                $changedFields[] = 'password';
                $rules['password'] = self::VALIDATION_RULE_PASSWORD . '|confirmed';
                $rules['password_confirmation'] = 'required';
            }

            $validator = Validator::make($request->all(), $rules, $this->validation_messages);

            if (!Hash::check($request->current_password, $user->password)) {
                $validator->errors()->add('current_password', 'Password anda salah.');
                return redirect()->back()->withInput()->withErrors($validator);
            }

            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }

            $user->update($request->only($changedFields));

            UserActivity::log(UserActivity::USER_MANAGEMENT, 'Perbarui Profil Pengguna', 'Profil pengguna ' . e($user->username) . ' telah diperbarui.');

            return redirect('admin/user/profile')->with('info', 'Profil anda telah diperbarui.');
        }

        return view('pages.admin.user.profile', compact('user'));
    }

    public function delete(Request $request, $id)
    {
        ensure_user_can_access(AclResource::USER_MANAGEMENT);

        $user = User::findOrFail($id);

        if ($user->username == 'admin') {
            return redirect('admin/user')->with('error', 'Akun <b>' . e($user->username) . '</b> tidak boleh dihapus.');
        } else if ($user->id == Auth::user()->id) {
            return redirect('admin/user')->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        if ($request->method() == 'POST') {
            try {
                $user->delete();
                $message = 'Akun pengguna <b>' . e($user->username) . '</b> telah dihapus.';
                UserActivity::log(UserActivity::USER_MANAGEMENT, 'Hapus Pengguna', $message);
            } catch (QueryException $ex) {
                $message = 'Grup pengguna <b>' . e($user->username) . '</b> tidak dapat dihapus. ' .
                    'Grup sudah digunakan atau terdapat kesalahan pada sistem.';
            }

            return redirect('admin/user')->with('info', $message);
        }

        return view('pages.admin.user.delete', compact('user'));
    }
}
