<?php

namespace App\Http\Controllers;

use App\Models\Opsi;
use App\Models\Soal;
use App\Models\Nilai;
use App\Models\Rules;
use App\Models\Kategori;
use App\Models\PageVisit;
use App\Models\KategoriUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class UjianController extends Controller
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
    
        // Menyimpan ID kategori terakhir ke dalam sesi
    
        return view('pages.frontsite.ujian.index', compact('user', 'kategoris'));
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

        $user = auth()->user();
        $kategori_id; 

        foreach ($request->opsi as $index => $jawaban) {
            // Pisahkan nilai jawaban dan soal_id
            $data = explode('|', $jawaban);
            $jawabanPengguna = $data[0];
            $soal_id = $data[1];

            $soal = Soal::find($soal_id);

            $jumlahBenar = 0;
            
            $kategori_id = $soal->kategori->id;
            if ($jawabanPengguna == $soal->opsi[0]->jawaban) {
                $jumlahBenar = $jumlahBenar + $soal->poin;

                // jumlahbenar harus sesuai poin yang ada (4);
            }

            Nilai::create([
                'user_id' => $user->id,
                'soal_id' => $soal_id,
                'kategori_id' => $kategori_id,
                'jawabanUser' => $jawabanPengguna,
                'nilai' => $jumlahBenar,
            ]);
       

        } 
        // Hitung total nilai
        $totalNilai = Nilai::where('user_id', $user->id)
            ->where('kategori_id', $kategori_id)
            ->sum('nilai');

        // Periksa apakah nilai terbaru lebih tinggi dari yang ada di database
        $currentNilaiTotal = KategoriUser::where('user_id', $user->id)
            ->where('kategori_id', $kategori_id)
            ->value('nilai_total');

        if ($totalNilai > $currentNilaiTotal) {
            // Lakukan pembaruan jika nilai terbaru lebih tinggi
            KategoriUser::where('user_id', $user->id)
                ->where('kategori_id', $kategori_id)
                ->update([
                    'status' => 'new',
                    'nilai_total' => $totalNilai
                ]);
        }

        alert()->success('Success Message', 'Skor anda ' . $totalNilai);
        return redirect()->route('user.dashboard.index');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($encryptedId)
    {
        // Mendekripsi nilai sebelum menggunakannya
        $id = Crypt::decryptString($encryptedId);   

        $waktu = Rules::pluck('waktu');

        // Menjumlahkan nilai-nilai yang telah dikalikan
        $durasi_ujian_in_detik = $waktu->sum() * 60;
        
        $user = auth()->user(); // Mengambil model pengguna saat ini dari autentikasi

        // Mendapatkan status dari tabel kategori_user
        $kategoriUser = KategoriUser::where('kategori_id', $id)
        ->where('user_id', $user->id)
        ->first();

        // Periksa apakah pengguna telah mengunjungi halaman show ini sebelumnya
        $visited = PageVisit::where('user_id', $user->id)
        ->where('kategori_id', $id) // Sesuaikan ini dengan logika Anda
        ->exists();

        // Jika sudah, tampilkan pesan error dan redirect
        if ($visited) {
        Alert::error('Error', 'Anda telah menyelesaikan ujian ini sebelumnya. Silakan hubungi Administrator!');
        return redirect()->route('user.dashboard.index');
        }

        // Tambahkan entri baru ke dalam tabel log pengunjungan
        PageVisit::create([
        'user_id' => $user->id,
        'kategori_id' => $id, // Sesuaikan ini dengan logika Anda
        ]);

        // Update status kategori_user menjadi null setelah pengguna menyelesaikan ujian
        KategoriUser::where('user_id', $user->id)
        ->where('kategori_id', $id)
        ->update(['status' => 'new']);

        // Periksa apakah statusnya sudah disetujui
        if (!$kategoriUser || $kategoriUser->status !== 'approved') {
        // Tampilkan pesan alert bahwa pengguna tidak diizinkan untuk mengikuti ujian pada kategori ini
        Alert::error('Error', 'Anda tidak diizinkan untuk mengikuti ujian pada kategori ini.');
        return redirect()->route('user.dashboard.index');
        }

        // Hitung jumlah total soal yang tersedia untuk kategori ini
        $totalSoal = Soal::where('kategori_id', $id)->count();

        // Batasan maksimum jumlah data soal yang akan diambil
        $maxSoals = 25;
        // Periksa apakah jumlah total soal mencukupi
        if ($totalSoal < $maxSoals) {
            Alert::error('Error', 'Sistem Maintenance');
            return redirect()->back();

        } 

        // Hapus sesi jawaban sebelumnya jika ada
        session()->forget('jawaban_' . $id);

        // Inisialisasi variabel untuk menampung data soal
        $allSoals = collect([]);

        // Looping untuk mengambil data soal hingga mencapai batasan maksimum
        while ($allSoals->count() < $maxSoals) {
            // Ambil data soal secara acak
            $newSoals = Soal::where('kategori_id', $id)
                            ->with('kategori', 'opsi')
                            ->inRandomOrder()
                            ->take(min($maxSoals - $allSoals->count(), 5))
                            ->get();

            // Tambahkan data soal yang baru ke dalam koleksi
            $allSoals = $allSoals->concat($newSoals);

            // Hapus duplikat dari koleksi jika ada
            $allSoals = $allSoals->unique('id');
        }

        // Ambil 25 data soal yang unik secara acak atau kurang
        $soals = $allSoals->take($maxSoals);

        // Simpan data soal ke dalam sesi
        session()->put('soals_' . $id, $soals);


        // dd($soals);
        $kategoriUjian = Kategori::findOrFail($id);

        return view('pages.frontsite.ujian.index', compact('user', 'durasi_ujian_in_detik', 'soals', 'kategoriUjian'));

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
