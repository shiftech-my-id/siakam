<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolGrade;
use Illuminate\Http\Request;

class SchoolGradeController extends Controller
{
    /**
     * Display a listing of grades.
     */
    public function index(Request $request)
    {
        $q = SchoolGrade::query();
        $items = $q->orderBy('priority', 'asc')
            ->orderBy('stage_id', 'asc')->paginate(10);
        return view('pages.admin.school-grade.index', compact('items'));
    }

    /**
     * Edit a school grade
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Delete a school grade
     */
    public function delete(Request $request)
    {
        //
    }
}
