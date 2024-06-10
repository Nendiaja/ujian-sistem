<?php

namespace App\Http\Controllers;

use App\Models\Rules;
use App\Models\Settings;
use App\Models\KategoriUser;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user(); // Mengambil model pengguna saat ini dari autentikasi

        // Mengambil kategori-kategori yang terkait dengan pengguna
        $kategoris = $user->kategoris;

        // Mengakses data 'nama' dari setiap kategori
            // Lakukan validasi pada nilai password
        if ($user->password == bcrypt('123456')) {
            $showModal = true; // Tentukan bahwa modal akan ditampilkan
        } else {
            $showModal = false; // Modal tidak perlu ditampilkan
        }

        $announcements = Settings::pluck('pengumuman')->toArray();

        // Jika tidak ada pengumuman yang ditemukan, Anda dapat menangani kasus ini sesuai kebutuhan
        if (empty($announcements)) {
            $announcements = ["Pengumuman tidak tersedia saat ini."];
        }

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
        }

            // dd($nilaiUserKategori);
        return view('pages.frontsite.dashboard.index', compact('user', 'kategoris', 'showModal', 'announcements', 'nilaiUserKategori'));
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
