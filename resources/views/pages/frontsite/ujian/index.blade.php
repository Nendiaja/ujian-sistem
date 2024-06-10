@extends('layouts.appUserUjian')

@section('content')
<div class="container">

    <style>
        /* CSS untuk membuat tombol ABCD */
        .option-buttons label {
            display: inline-block;
            margin-right: 10px;
            padding: 5px 10px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            cursor: pointer;
        }
        .option-buttons label:hover {
            background-color: #e0e0e0;
        }
        .option-buttons input[type="radio"] {
            display: none;
        }
        .option-buttons input[type="radio"]:checked + label {
            background-color: #009207;
            color: #fff;
        }

            /* CSS untuk mengatur posisi waktu ujian */
        #countdown {
            position: fixed;
            top: 20px; /* Adjust as needed */
            right: 20px; /* Adjust as needed */
            z-index: 1000; /* Ensure it stays on top of other content */
            background-color: white; /* Optional: add background color */
            padding: 10px; /* Optional: add padding */
            border-radius: 5px; /* Optional: add border radius */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Optional: add shadow */
        }
    </style>

    <div id="countdown"></div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form id="ujian_form" method="POST" action="{{ route('user.ujian.store') }}">
                @csrf
                <div class="card">
                    <div class="card-header">Deskripsi dan Syarat Ujian</div>
                    <div class="card-body">
                        {{-- <h4>Deskripsi Ujian: {{ session('soals')[0]->kategori->nama ?? 'kodongs'}}</h4> --}}
                        <h4>Deskripsi Ujian: {{ $kategoriUjian->nama ?? 'kodongs' }}</h4>
                        <table border="0">
                            <tr>
                                <td><strong>Jumlah Soal  </strong></td>
                                <td><strong> :</strong></td>
                                <td><strong> 25 Soal</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Waktu  </strong></td>
                                <td><strong> :</strong></td>
                                <td><strong> 30 Menit</strong></td>
                            </tr>
                        </table>

                        <hr>
                        <h5>Daftar Pertanyaan:</h5>
                        @php
                            $no = 1;
                        @endphp
@foreach ($soals as $index => $soal)
<div class="mb-4">
    <p><strong> {{ $no++ }}</strong>. {{ $soal->soal }}</p>
    @if ($soal->gambar)
        <img src="{{ asset('images/' . $soal->gambar) }}" alt="Gambar Soal" width="300">
    @endif
    <ul style="list-style-type: none;">
        @foreach ($soal->opsi as $o)
            <div class="option-buttons mt-2">
                <div>
                    <input type="radio" id="{{ $o->id }}_a" name="opsi[{{ $index }}]" value="a|{{ $soal->id }}">
                    <label for="{{ $o->id }}_a">A</label> {{ $o->a }}
                </div>
                <div>
                    <input type="radio" id="{{ $o->id }}_b" name="opsi[{{ $index }}]" value="b|{{ $soal->id }}">
                    <label for="{{ $o->id }}_b">B</label> {{ $o->b }}
                </div>
                <div>
                    <input type="radio" id="{{ $o->id }}_c" name="opsi[{{ $index }}]" value="c|{{ $soal->id }}">
                    <label for="{{ $o->id }}_c">C</label> {{ $o->c }}
                </div>
                <div>
                    <input type="radio" id="{{ $o->id }}_d" name="opsi[{{ $index }}]" value="d|{{ $soal->id }}">
                    <label for="{{ $o->id }}_d">D</label> {{ $o->d }}
                </div>
            </div>
        @endforeach                           
    </ul>
</div>
@endforeach

                        <hr>            
                        <!-- Tombol kembali -->
                        {{-- <a href="#" class="btn btn-secondary">Kembali</a> --}}
            
                        <!-- Tombol submit -->
                        <button type="button" style="width:120px;" class="btn btn-cyan" onclick="confirmSubmit()">
                            <i class="la la-check-square-o"></i> Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@push('after-script')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    // Fungsi untuk menampilkan SweetAlert konfirmasi sebelum mengirimkan formulir
    function confirmSubmit() {
        swal({
            title: "Konfirmasi",
            text: "Apakah Anda yakin ingin menyimpan data?",
            icon: "warning",
            buttons: {
                cancel: "Batal",
                confirm: {
                    text: "OK",
                    value: true,
                    className: "bg-primary",
                },
            },
            dangerMode: true,
        }).then((willSubmit) => {
            if (willSubmit) {
                // Jika pengguna mengklik OK, submit formulir
                document.getElementById("ujian_form").submit();
            }
        });
    }
</script>

<script>
    var timer = {{ $durasi_ujian_in_detik }};

    function startTimer() {
        var countdownTimer = setInterval(function() {
            timer--;
            var minutes = Math.floor(timer / 60);
            var seconds = timer % 60;

            // Tampilkan waktu mundur
            document.getElementById('countdown').innerHTML = minutes + " menit " + seconds + " detik";

            // Periksa jika waktu telah habis
            if (timer <= 0) {
                clearInterval(countdownTimer); // Hentikan perhitungan mundur
                submitForm(); // Kirim formulir secara otomatis
            }
        }, 1000); // Perbarui setiap 1 detik
    }

    startTimer(); // Mulai hitung mundur saat halaman dimuat

    // Fungsi untuk mengirim formulir secarafd otomatis
    function submitForm() {
        document.querySelector('form').submit(); // Submit formulir
    }
</script>
@endpush
