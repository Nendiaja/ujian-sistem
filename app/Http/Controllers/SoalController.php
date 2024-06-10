<?php

namespace App\Http\Controllers;

use App\Models\Opsi;
use App\Models\Soal;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Soal\SoalRequest;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Soal::with('opsi')->get();

        // dd('datas');

        $kategoris = Kategori::all();

        return view('pages.backsite.master-data.soal.index', compact('datas', 'kategoris'));
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
        $filebaru = null;
    
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filebaru = time() . '.' . $file->getClientOriginalExtension();
    
            $file->move(public_path('images'), $filebaru);
        }


        $request->validate([
            // tabel soal
            'soal' => 'required',
            'gambar' => 'sometimes',
            'poin' => 'sometimes',
            'kategori_id' => 'required',

            // tabel opsi
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'jawaban' => 'required',
        ]);

        $soal = Soal::create([
            'soal' => $request->input('soal'),
            'gambar' => $filebaru,
            'kategori_id' => $request->input('kategori_id'),
        ]);

        $opsi = Opsi::create([
            
            'soal_id' => $soal->id,
            'a' => $request->input('a'),
            'b' => $request->input('b'),
            'c' => $request->input('c'),
            'd' => $request->input('d'),
            'jawaban' => $request->input('jawaban'),
        ]);


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
        $datas = Opsi::with('soal')->findOrFail($id);

        return view('pages.backsite.master-data.soal.edit', compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{

    $request->validate([
        // tambahkan validasi yang diperlukan di sini
        'soal' => 'required',
        'gambar' => 'sometimes',
        'kategori_id' => 'required',
        'a' => 'required',
        'b' => 'required',
        'c' => 'required',
        'd' => 'required',
        'jawaban' => 'required',
    ]);

    $opsi = Opsi::findOrFail($id);


    $opsi->update([
        'a' => $request->input('a'),
        'b' => $request->input('b'),
        'c' => $request->input('c'),
        'd' => $request->input('d'),
        'jawaban' => $request->input('jawaban'),
    ]);

    $gambar = null;

    // Periksa apakah foto baru dimasukkan
    if ($request->hasFile('gambar')) {
        // Jika ada gambar baru, proses unggahan gambar
        $file = $request->file('gambar');
        $filebaru = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filebaru);
        
        // Hapus foto lama jika ada
        $fotoLama = public_path('images') . '/' . $opsi->soal->gambar;

        if (File::exists($fotoLama)) {
            File::delete($fotoLama);
        } 
                
        // Simpan nama foto baru ke dalam data
        $gambar = $filebaru;
    }

    $opsi->soal()->update([
        'soal' => $request->input('soal'),
        'gambar' => $gambar,
        'kategori_id' => $request->input('kategori_id'),
    ]);

    alert()->success('Pesan Berhasil', 'Data berhasil diperbarui');
    return redirect()->route('admin.soal.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Soal $soal)
    {

        if(File::exists($path = public_path('images'). '/' . $soal->gambar)){
            File::delete($path);
        }
        // Hapus barang
        $soal->delete();

        alert()->success('Success Message', 'Berhasil Dihapus');
        return redirect()->route('admin.soal.index');
    }

    public function soalByKategori ($id) {

    // Mengambil semua data soal berdasarkan kategori_id
    $datas = Soal::where('kategori_id', $id)->get();
        return view('pages.backsite.master-data.soal.soalByKategori', compact('datas'));
    }
}
