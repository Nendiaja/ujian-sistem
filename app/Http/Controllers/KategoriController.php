<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\Kategori\KategoriRequest;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Kategori::all();

        return view('pages.backsite.master-data.kategori.index', compact('datas'));
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
    public function store(KategoriRequest $request)
    {
        $kategori = Kategori::create($request->validated());

        // Mendapatkan semua pengguna
        $users = User::where('role', 'user')->get();

        // Menambahkan kategori baru ke semua pengguna
        foreach ($users as $user) {
            $user->kategoriUser()->create([
                'kategori_id' => $kategori->id,
                'status' => 'new', // Atur status sesuai kebutuhan
                'nilai_total' => 0 // Atur nilai_total sesuai kebutuhan
            ]);
        }

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
        $kategori = Kategori::findOrFail($id);

        return view('pages.backsite.master-data.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KategoriRequest $request,  $id)
    {
        $data = $request->validated();

        $kategori = Kategori::find($id);

        $kategori->update($data);

        alert()->success('Pesan Berhasil', 'Data berhasil diperbarui');
        return redirect()->route('admin.kategori.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        try {
            $kategori->delete();
            alert()->success('Success Message', 'Berhasil Dihapus');
        } catch (\Exception $e) {
            alert()->error('Error Message', 'Gagal Menghapus: ' . 'Masih ada soal di Kategori ini !');
        }
        
        return redirect()->route('admin.kategori.index');
    }
    

}
