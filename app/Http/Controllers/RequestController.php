<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\PageVisit;
use App\Models\KategoriUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RequestController extends Controller
{

    public function approve(Request $request, $id)
    {
        // Dapatkan KategoriUser yang sesuai dengan ID
        $kategoriUser = KategoriUser::findOrFail($id);

        $kategoriId = $kategoriUser->kategori_id;
        $userId = $kategoriUser->user_id;

        // dd($kategoriUser);
        
        // Hapus semua entri pada tabel nilai yang sesuai dengan kategori_user dan user_id
        Nilai::where('user_id', $userId)
             ->where('kategori_id', $kategoriId)
             ->delete();

        // Menghapus entri dari tabel kategori_user berdasarkan kategori_id dan user_id
        $deleted = PageVisit::where('kategori_id', $kategoriId)
            ->where('user_id', $userId)
            ->delete();

        $kategoriUser->update([
            'status' => 'approved',
        ]);
        
    
        alert()->success('Success', 'Data berhasil diperbarui');
        return redirect()->route('admin.request.index');
    }
    
}
