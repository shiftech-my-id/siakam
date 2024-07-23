<?php

namespace App\Http\Controllers;

use App\Models\StudentBill;
use Illuminate\Http\Request;

class StudentBillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $items = [];
        return view('pages.admin.student-bill.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentBill $studentBill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentBill $studentBill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentBill $studentBill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentBill $studentBill)
    {
        //
    }
}
