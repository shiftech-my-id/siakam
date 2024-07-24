<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private function _logout(Request $request)
    {
        $user = Auth::user();
        Auth::logout();
        if ($user) {
            // UserActivity::log(
            //     UserActivity::AUTHENTICATION,
            //     'Logout',
            //     'Logout sukses. Pengguna ' . e($user->username) . ' telah logout.',
            //     null, $user->username, $user->id
            // );
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function login(Request $request)
    {
        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required',
            ], [
                'username.required' => 'ID Pengguna harus diisi.',
                'password.required' => 'Kata sandi harus diisi.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }

            $error = '';
            $data = $request->only(['username', 'password']);
            if (!Auth::attempt($data)) {
                $error = 'Username atau password salah!';
                // UserActivity::log(UserActivity::AUTHENTICATION, 'Login', 'Login gagal. Pengguna dengan username ' . e($request->post('username')) . ' mencoba login.');
            } else if (!Auth::user()->is_active) {
                $error = 'Akun anda tidak aktif. Silahkan hubungi administrator!';
                // UserActivity::log(UserActivity::AUTHENTICATION, 'Login', 'Login gagal. Pengguna tidak aktif dengan username ' . e($request->post('username')) . ' mencoba login.');
                $this->_logout($request);
            } else {
                $request->session()->regenerate();
                // TODO: Redirect based on user role
                // UserActivity::log(UserActivity::AUTHENTICATION, 'Login', 'Login sukses. Pengguna ' . e(Auth::user()->username) . ' telah login.');
                return redirect('/admin/dashboard');
            }

            return redirect()->back()->withInput()->with('error', $error);
        }

        return view('pages.public.auth.login');
    }

    public function logout(Request $request)
    {
        $this->_logout($request);
        return redirect(route('auth.login'));
    }
}
