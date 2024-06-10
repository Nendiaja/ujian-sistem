<?php

namespace Database\Seeders;

use App\Models\Opsi;
use App\Models\Soal;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class dualimaSeeder extends Seeder
{

        public function run(): void
        {
            $questions = [
                [
                    'soal' => 'Apa itu algoritma dalam pemrograman?',
                    'kategori_id' => 1,
                    'a' => 'Sebuah aplikasi perangkat lunak',
                    'b' => 'Sebuah urutan langkah-langkah logis untuk menyelesaikan masalah',
                    'c' => 'Sebuah bahasa pemrograman',
                    'd' => 'Sebuah sistem operasi',
                    'jawaban' => 'b',
                ],
                [
                    'soal' => 'Apa yang dimaksud dengan variabel dalam pemrograman?',
                    'kategori_id' => 1,
                    'a' => 'Sebuah nilai yang berubah-ubah',
                    'b' => 'Sebuah konstanta',
                    'c' => 'Sebuah tipe data',
                    'd' => 'Sebuah fungsi',
                    'jawaban' => 'a',
                ],
                [
                    'soal' => 'Apa yang dimaksud dengan loop dalam pemrograman?',
                    'kategori_id' => 1,
                    'a' => 'Sebuah urutan langkah-langkah',
                    'b' => 'Sebuah perulangan',
                    'c' => 'Sebuah kondisi',
                    'd' => 'Sebuah array',
                    'jawaban' => 'b',
                ],
                [
                    'soal' => 'Apa fungsi dari pernyataan "if" dalam pemrograman?',
                    'kategori_id' => 1,
                    'a' => 'Untuk mencetak nilai',
                    'b' => 'Untuk melakukan perulangan',
                    'c' => 'Untuk membuat kondisi',
                    'd' => 'Untuk mendeklarasikan variabel',
                    'jawaban' => 'c',
                ],
                [
                    'soal' => 'Apa itu array dalam pemrograman?',
                    'kategori_id' => 1,
                    'a' => 'Sebuah tipe data tunggal',
                    'b' => 'Sebuah kumpulan nilai',
                    'c' => 'Sebuah kondisi',
                    'd' => 'Sebuah loop',
                    'jawaban' => 'b',
                ],
                [
                    'soal' => 'Apa itu rekursi dalam pemrograman?',
                    'kategori_id' => 1,
                    'a' => 'Sebuah fungsi yang memanggil dirinya sendiri',
                    'b' => 'Sebuah tipe data',
                    'c' => 'Sebuah variabel',
                    'd' => 'Sebuah kondisi',
                    'jawaban' => 'a',
                ],
                [
                    'soal' => 'Apa yang dimaksud dengan tipe data?',
                    'kategori_id' => 1,
                    'a' => 'Sebuah metode untuk menyimpan data',
                    'b' => 'Sebuah loop',
                    'c' => 'Sebuah kondisi',
                    'd' => 'Sebuah algoritma',
                    'jawaban' => 'a',
                ],
                [
                    'soal' => 'Apa yang dimaksud dengan fungsi dalam pemrograman?',
                    'kategori_id' => 1,
                    'a' => 'Sebuah urutan langkah-langkah logis',
                    'b' => 'Sebuah blok kode yang dapat digunakan kembali',
                    'c' => 'Sebuah tipe data',
                    'd' => 'Sebuah kondisi',
                    'jawaban' => 'b',
                ],
                [
                    'soal' => 'Apa yang dimaksud dengan pseudocode?',
                    'kategori_id' => 1,
                    'a' => 'Bahasa pemrograman',
                    'b' => 'Representasi informal dari algoritma',
                    'c' => 'Sebuah kondisi',
                    'd' => 'Sebuah tipe data',
                    'jawaban' => 'b',
                ],
                [
                    'soal' => 'Apa itu debugging dalam pemrograman?',
                    'kategori_id' => 1,
                    'a' => 'Menulis kode',
                    'b' => 'Menghapus bug dari kode',
                    'c' => 'Menjalankan program',
                    'd' => 'Membuat algoritma',
                    'jawaban' => 'b',
                ],
                [
                    'soal' => 'Apa yang dimaksud dengan kompleksitas waktu dalam algoritma?',
                    'kategori_id' => 1,
                    'a' => 'Waktu yang dibutuhkan untuk menulis kode',
                    'b' => 'Waktu yang dibutuhkan untuk menjalankan algoritma',
                    'c' => 'Jumlah memori yang digunakan',
                    'd' => 'Jumlah variabel yang digunakan',
                    'jawaban' => 'b',
                ],
                [
                    'soal' => 'Apa itu struktur data?',
                    'kategori_id' => 1,
                    'a' => 'Sebuah tipe data',
                    'b' => 'Sebuah cara menyimpan dan mengatur data',
                    'c' => 'Sebuah fungsi',
                    'd' => 'Sebuah loop',
                    'jawaban' => 'b',
                ],
                [
                    'soal' => 'Apa yang dimaksud dengan "for" loop?',
                    'kategori_id' => 1,
                    'a' => 'Perulangan yang dilakukan dengan kondisi',
                    'b' => 'Perulangan yang dilakukan dengan nilai tertentu',
                    'c' => 'Perulangan yang dilakukan dengan kondisi dan nilai tertentu',
                    'd' => 'Perulangan yang dilakukan sekali',
                    'jawaban' => 'c',
                ],
                [
                    'soal' => 'Apa yang dimaksud dengan "while" loop?',
                    'kategori_id' => 1,
                    'a' => 'Perulangan yang dilakukan dengan nilai tertentu',
                    'b' => 'Perulangan yang dilakukan dengan kondisi',
                    'c' => 'Perulangan yang dilakukan sekali',
                    'd' => 'Perulangan yang dilakukan tanpa henti',
                    'jawaban' => 'b',
                ],
                [
                    'soal' => 'Apa itu parameter dalam fungsi?',
                    'kategori_id' => 1,
                    'a' => 'Sebuah nilai tetap',
                    'b' => 'Sebuah nilai yang diterima oleh fungsi',
                    'c' => 'Sebuah tipe data',
                    'd' => 'Sebuah loop',
                    'jawaban' => 'b',
                ],
                [
                    'soal' => 'Apa yang dimaksud dengan return dalam fungsi?',
                    'kategori_id' => 1,
                    'a' => 'Mengakhiri fungsi',
                    'b' => 'Mengembalikan nilai dari fungsi',
                    'c' => 'Mendeklarasikan fungsi',
                    'd' => 'Menjalankan fungsi',
                    'jawaban' => 'b',
                ],
                [
                    'soal' => 'Apa yang dimaksud dengan sorting dalam algoritma?',
                    'kategori_id' => 1,
                    'a' => 'Menghapus data',
                    'b' => 'Mengurutkan data',
                    'c' => 'Menambah data',
                    'd' => 'Mengganti data',
                    'jawaban' => 'b',
                ],
                [
                    'soal' => 'Apa yang dimaksud dengan searching dalam algoritma?',
                    'kategori_id' => 1,
                    'a' => 'Menghapus data',
                    'b' => 'Mencari data',
                    'c' => 'Menambah data',
                    'd' => 'Mengganti data',
                    'jawaban' => 'b',
                ],
                [
                    'soal' => 'Apa yang dimaksud dengan stack dalam struktur data?',
                    'kategori_id' => 1,
                    'a' => 'Struktur data FIFO',
                    'b' => 'Struktur data LIFO',
                    'c' => 'Struktur data acak',
                    'd' => 'Struktur data terurut',
                    'jawaban' => 'b',
                ],
                [
                    'soal' => 'Apa yang dimaksud dengan queue dalam struktur data?',
                    'kategori_id' => 1,
                    'a' => 'Struktur data LIFO',
                    'b' => 'Struktur data FIFO',
                    'c' => 'Struktur data acak',
                    'd' => 'Struktur data terurut',
                    'jawaban' => 'b',
                ],
                [
                    'soal' => 'Apa yang dimaksud dengan linked list?',
                    'kategori_id' => 1,
                    'a' => 'Sebuah array',
                    'b' => 'Sebuah struktur data yang terdiri dari node yang saling terhubung',
                    'c' => 'Sebuah tipe data',
                    'd' => 'Sebuah loop',
                    'jawaban' => 'b',
                ],
                [
                    'soal' => 'Apa yang dimaksud dengan binary tree?',
                    'kategori_id' => 1,
                    'a' => 'Sebuah loop',
                    'b' => 'Sebuah kondisi',
                    'c' => 'Sebuah struktur data hierarkis',
                    'd' => 'Sebuah tipe data',
                    'jawaban' => 'c',
                ],
                [
                    'soal' => 'Apa yang dimaksud dengan hash table?',
                    'kategori_id' => 1,
                    'a' => 'Sebuah array',
                    'b' => 'Sebuah struktur data yang menggunakan hash function',
                    'c' => 'Sebuah loop',
                    'd' => 'Sebuah tipe data',
                    'jawaban' => 'b',
                ],
                [
                    'soal' => 'Apa yang dimaksud dengan graph dalam struktur data?',
                    'kategori_id' => 1,
                    'a' => 'Sebuah kondisi',
                    'b' => 'Sebuah struktur data yang terdiri dari node dan edge',
                    'c' => 'Sebuah tipe data',
                    'd' => 'Sebuah loop',
                    'jawaban' => 'b',
                ],
            ];
    
            foreach ($questions as $question) {
                $soal = Soal::create([
                    'soal' => $question['soal'],
                    'kategori_id' => $question['kategori_id'],
                ]);
    
                Opsi::create([
                    'soal_id' => $soal->id,
                    'a' => $question['a'],
                    'b' => $question['b'],
                    'c' => $question['c'],
                    'd' => $question['d'],
                    'jawaban' => $question['jawaban'],
                ]);
            }
        }
}
