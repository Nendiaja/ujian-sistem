<?php

namespace App\Http\Controllers;

use App\Models\KategoriUser;
use Illuminate\Http\Request;

class UserRequestController extends Controller
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
        $user_id = $request->input('user_id');
        $kategori_id = $request->input('kategori_id');
    
        // Temukan entri KategoriUser dengan user_id dan kategori_id yang sesuai
        $kategoriUser = KategoriUser::where('user_id', $user_id)
                                     ->where('kategori_id', $kategori_id)
                                     ->first();
    
        // Jika tidak ditemukan, tambahkan entri baru
        if (!$kategoriUser) {
            $kategoriUser = new KategoriUser();
            $kategoriUser->user_id = $user_id;
            $kategoriUser->kategori_id = $kategori_id;
        }
    
        // Periksa apakah pengguna sudah memiliki izin pending atau disetujui sebelumnya
        if ($kategoriUser->status !== 'new') {
            alert()->warning('Warning', 'Permission already requested or approved');
            return redirect()->back();
        }        
    
        // Ubah statusEnum menjadi 'pending' dan simpan perubahan
        $kategoriUser->status = 'pending';
        $kategoriUser->save();
    
        alert()->success('Success', 'Berhasil mengajukan Request!');
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
        //
    }
}
