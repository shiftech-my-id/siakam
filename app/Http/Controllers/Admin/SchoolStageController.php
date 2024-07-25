<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolStage;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolStageController extends Controller
{
    /**
     * Display a listing of the stage.
     */
    public function index(Request $request)
    {
        // ensure_user_can_access(AclResource::);

        $q = SchoolStage::query();
        $items = $q->orderBy('priority', 'asc')->paginate(10);
        return view('pages.admin.school-stage.index', compact('items'));
    }

    /**
     *
     */
    public function edit(Request $request, $id)
    {
        $item = $id ? SchoolStage::find($id) : new SchoolStage();
        if (!$item) {
            return redirect('admin/school-stage')->with('warning', 'Marhalah tidak ditemukan.');
        }

        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:school_stages,name,' . $request->id . '|max:100',
            ], [
                'name.required' => 'Nama marhalah harus diisi.',
                'name.unique' => 'Nama marhalah sudah digunakan.',
                'name.max' => 'Nama marhalah terlalu panjang, maksimal 100 karakter.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }

            $data = $request->only('name', 'description', 'priority');
            fill_with_default_value($data, ['description'], '');
            fill_with_default_value($data, ['priority'], 1);

            // $data = ['Old Data' => $item->toArray()];
            $item->fill($data);
            $item->save();
            // $data['New Data'] = $item->toArray();

            // UserActivity::log(
            //     UserActivity::PRODUCT_CATEGORY_MANAGEMENT,
            //     ($id == 0 ? 'Tambah' : 'Perbarui') . ' Kategori Produk',
            //     'Kategori Produk ' . e($item->name) . ' telah ' . ($id == 0 ? 'dibuat' : 'diperbarui'),
            //     $data
            // );

            return redirect('admin/school-stage')->with('info', 'Kategori produk telah disimpan.');
        }

        return view('pages.admin.school-stage.edit', compact('item'));
    }

    /**
     * Delete
     */
    public function Delete(Request $request, $id)
    {
        if (!$item = SchoolStage::find($id)) {
            $message = 'Marhalah tidak ditemukan.';
        } else if ($item->delete($id)) {
            $message = 'Marhalah ' . e($item->name) . ' telah dihapus.';
            // UserActivity::log(
            //     UserActivity::PRODUCT_CATEGORY_MANAGEMENT,
            //     'Hapus Kategori',
            //     $message,
            //     $item->toArray()
            // );
        }

        return redirect('admin/school-stage')->with('info', $message);
    }
}
