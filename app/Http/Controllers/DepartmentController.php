<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\BussinesUnit;
use Illuminate\Http\Request;
use App\Http\Requests\Departement\DepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Department::all();

        $bussinesUnit = BussinesUnit::all();

        return view('pages.backsite.master-data.department.index', compact('datas', 'bussinesUnit'));
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
    public function store(DepartmentRequest $request)
    {
        $department = Department::create($request->validated());

        alert()->success('Success Message', 'Berhasil Ditambahkan');
        return redirect()->back(); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $bussinesUnit = BussinesUnit::all();
        $department = Department::findOrFail($id);
    
        return view('pages.backsite.master-data.department.edit', compact('bussinesUnit', 'department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, string $id)
    {
        $data = $request->validated();

        $department = Department::find($id);

        $department->update($data);

        alert()->success('Pesan Berhasil', 'Data berhasil diperbarui');
        return redirect()->route('admin.department.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
