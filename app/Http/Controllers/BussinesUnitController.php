<?php

namespace App\Http\Controllers;

use App\Models\BussinesUnit;
use Illuminate\Http\Request;
use App\Http\Requests\BussinesUnit\BussinesUnitRequest;

class BussinesUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = BussinesUnit::all();

        return view('pages.backsite.master-data.bussinesUnit.index', compact('datas'));
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
    public function store(BussinesUnitRequest $request)
    {
        $bussinesUnit = BussinesUnit::create($request->validated());

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
    public function edit($id)
    {
        $bussinesUnit = BussinesUnit::findOrFail($id);

        return view('pages.backsite.master-data.bussinesUnit.edit', compact('bussinesUnit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BussinesUnitRequest $request,  $id)
    {
        $data = $request->validated();

        $bussinesUnit = BussinesUnit::find($id);

        $bussinesUnit->update($data);

        alert()->success('Pesan Berhasil', 'Data berhasil diperbarui');
        return redirect()->route('admin.bussinesUnit.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BussinesUnit $bussinesUnit)
    {
        try {
            $bussinesUnit->delete();
            alert()->success('Success Message', 'Berhasil Dihapus');
        } catch (\Exception $e) {
            alert()->error('Error Message', 'Gagal Menghapus: ' . 'Masih ada Department di Bussines Unit ini !');
        }
        
        return redirect()->route('admin.bussinesUnit.index');
    }
}
