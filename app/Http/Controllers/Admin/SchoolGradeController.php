<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolGrade;
use App\Models\SchoolStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolGradeController extends Controller
{
    /**
     * Display a listing of grades.
     */
    public function index(Request $request)
    {
        $q = SchoolGrade::query();
        $items = $q->orderBy('stage_id', 'asc')->orderBy('priority', 'asc')->paginate(25);
        return view('pages.admin.school-grade.index', compact('items'));
    }

    /**
     * Edit a school grade
     */
    public function edit(Request $request, $id)
    {
        $item = $id ? SchoolGrade::find($id) : new SchoolGrade();
        if (!$item) {
            return redirect('admin/school-grade')->with('warning', 'Kelas tidak ditemukan.');
        }

        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:school_grades,name,' . $request->id . '|max:100',
                'stage_id' => 'required',
            ], [
                'name.required' => 'Nama kelas harus diisi.',
                'name.unique' => 'Nama kelas sudah digunakan.',
                'name.max' => 'Nama kelas terlalu panjang, maksimal 100 karakter.',
                'stage_id.required' => 'Anda belum memilih marhalah.'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }

            $data = $request->only('name', 'stage_id', 'description', 'priority');
            fill_with_default_value($data, ['stage_id'], null);
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

            return redirect('admin/school-grade')->with('info', 'Rekaman telah disimpan.');
        }

        $stages = SchoolStage::orderBy('priority', 'asc')->get();
        return view('pages.admin.school-grade.edit', compact('item', 'stages'));
    }

    /**
     * Delete a school grade
     */
    public function delete(Request $request, $id)
    {
        if (!$item = SchoolGrade::find($id)) {
            $message = 'Kelas tidak ditemukan.';
        } else if ($item->delete($id)) {
            $message = 'Rekaman ' . e($item->name) . ' telah dihapus.';
            // UserActivity::log(
            //     UserActivity::PRODUCT_CATEGORY_MANAGEMENT,
            //     'Hapus Kategori',
            //     $message,
            //     $item->toArray()
            // );
        }

        return redirect('admin/school-grade')->with('info', $message);
    }
}
