<?php

namespace App\Http\Controllers;

use App\Models\Opsi;
use App\Models\Soal;
use App\Models\User;
use Illuminate\Http\Request;

class SoalByKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        
        $request->validate([
            // tabel soal
            'soal' => 'required',
            'poin' => 'sometimes',
            'kategori_id' => 'required',

            // tabel opsi
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'jawaban' => 'sometimes',
        ]);

        $soal = Soal::create([
            'soal' => $request->input('soal'),
            'kategori_id' => $request->input('kategori_id'),
        ]);

        $opsi = Opsi::create([
            
            'soal_id' => $soal->id,
            'a' => $request->input('a'),
            'b' => $request->input('b'),
            'c' => $request->input('c'),
            'd' => $request->input('d'),
            'jawaban' => $request->input('jawaban1'),
        ]);

        alert()->success('Success Message', 'Berhasil Ditambahkan');
        return redirect()->back();   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $datas = Soal::where('kategori_id', $id)->get();
    
        if ($datas->isEmpty()) {
            alert()->warning('Warning','Tidak ada Soal Dalam Kategori ini !')->showConfirmButton('OK');
            return redirect()->back()->with('error', 'Gagal Menghapus: Masih ada soal di Kategori ini!');
        }
        
        return view('pages.backsite.master-data.soal.soalByKategori', compact('datas'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //z
    }
}
