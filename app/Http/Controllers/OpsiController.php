<?php

namespace App\Http\Controllers;

use App\Models\Opsi;
use Illuminate\Http\Request;
use App\Http\Requests\Opsi\OpsiRequest;
use App\Http\Requests\Opsi\UpdateOpsiRequest;

class OpsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.backsite.master-data.opsi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('pages.backsite.master-data.opsi.index', compact('id'));
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
    public function show(string $id)
    {
        $datas = Opsi::where('soal_id', $id)->get();

        if ($datas->isEmpty()) {
            // Jika tidak ada data Opsi yang ditemukan, redirect ke halaman lain
            return redirect()->route('admin.opsi.index')->with('error', 'Data tidak ditemukan');
        }
    
        // Jika data ditemukan, lanjutkan ke halaman edit
        return redirect()->route('admin.opsi.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $opsi = Opsi::findOrFail($id);

        $soal_id = $id;

        return view('pages.backsite.master-data.opsi.edit', compact('opsi', 'soal_id'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOpsiRequest $request,  $id)
    {
        $data = $request->validated();

        $opsi = Opsi::find($id);

        $opsi->update($data);

        alert()->success('Pesan Berhasil', 'Data berhasil diperbarui');
        return redirect()->route('admin.opsi.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Opsi $opsi)
    {
        $opsi->delete();

        alert()->success('Success Message', 'Berhasil Dihapus');
        return redirect()->route('admin.opsi.index'); 
    }
}
