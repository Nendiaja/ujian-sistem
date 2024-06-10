<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Rules;
use App\Models\KategoriUser;
use Illuminate\Http\Request;

class UserNilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private function hitungTotalNilai($userId, $kategoriId)
    {
        $user = auth()->user();
        $kategoris = $user->kategoris;

        foreach ($kategoris as $kategori) {
        return Nilai::where('user_id', $user->id)
            ->where('kategori_id', $kategori->id)
            ->sum('nilai');
    }
}

    public function index()
    {
        $user = auth()->user(); // Mengambil model pengguna saat ini dari autentikasi
        
        // Mengambil kategori-kategori yang terkait dengan pengguna
        $kategoris = $user->kategoris;
    
        $nilaiUserKategori = []; // Inisialisasi array untuk menyimpan hasil perhitungan nilai per kategori
        
        // Loop melalui setiap kategori untuk menghitung total nilai
        foreach ($kategoris as $kategori) {
           // Temukan atau buat entri KategoriUser yang sesuai dengan user_id dan kategori_id
        $kategoriUser = KategoriUser::updateOrCreate(
            ['kategori_id' => $kategori->id, 'user_id' => $user->id],
        );

            // Jika KategoriUser ditemukan, ambil statusnya
            if ($kategoriUser) {
            $status = $kategoriUser->status;
            } else {
            $status = 'tidak ditemukan'; // Atau sesuaikan dengan logika Anda jika tidak ada data ditemukan
            }
            
            $totalNilai = KategoriUser::where('user_id', $user->id)
                ->where('kategori_id', $kategori->id)
                ->sum('nilai_total');

            $kkm = Rules::pluck('KKM')->first(); // Mengambil nilai tunggal dari koleksi KKM

            // Tentukan status kelulusan berdasarkan total nilai
            $grade = ($totalNilai >= $kkm) ? 'lulus' : '';

            // Simpan hasil perhitungan ke dalam array asosiatif
            $nilaiUserKategori[] = [
                'namaKategori' => $kategori->nama,
                'kategori_id' => $kategori->id,
                'total_nilai' => $totalNilai,
                'status'=> $status,
                'grade' => $grade,
            ];

            // dd($nilaiUserKategori);
        }
        
        return view('pages.frontsite.nilai.index', compact('user', 'nilaiUserKategori', 'kkm'));
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
    public function show(string $id)
    {

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
