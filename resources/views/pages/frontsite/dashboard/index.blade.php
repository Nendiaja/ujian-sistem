@extends('layouts.appUser')


@section('title', 'Dashboard')

@section('src')

<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('/AdminLTE-2/bower_components/font-awesome/css/font-awesome.min.css') }}">
<!-- Theme style -->

@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-body">
        <!-- Pengumuman -->
        <section id="announcement">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title" style="font-size: 24px;">ANNOUNCEMENT</h1>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @foreach($announcements as $announcementItem)
                                <p>{{ $announcementItem }}</p>
                            @endforeach
                        
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <div class="content-wrapper">

        {{-- show error --}}
        @if ($errors->any())
            <div class="alert bg-danger alert-dismissible mb-2" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- breadcumb --}}
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Dashboard</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Activity</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade show" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateProfileModalLabel">Lengkapi Profil Pengguna</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-horizontal" id="userForm" action="{{ route('user.updatePasswordBaru', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="SAP">SAP <code style="color:red;"></code></label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="text" id="SAP" name="SAP" class="form-control" value="{{ $user->SAP }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="name">Nama <code style="color:red;"></code></label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="pic">PIC <code style="color:red;"></code></label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="text" id="pic" name="pic" class="form-control" value="{{ $user->pic }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="password">Password</label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="password" id="password" name="password" class="form-control mb-2" placeholder="Masukkan Password Baru" value="" autocomplete="off">
                        
                                        @if($errors->has('password'))
                                            <p style="font-style: bold; color: red;">{{ $errors->first('password') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($kategoris as $kategori)
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-{{ $loop->iteration % 4 == 0 ? 'yellow' : ($loop->iteration % 3 == 0 ? 'red' : ($loop->iteration % 2 == 0 ? 'blue' : 'green')) }}">
                        <div class="inner">
                            <h3></h3>
                            <p >{{ $kategori->nama }}</p>
                            <!-- Menggunakan $kategori->nama untuk menampilkan nama kategori -->
                        </div>
                        <div class="icon mt-2">
                            <i class="fa fa-cubes" style="font-size: 70px;"></i> <!-- Menggunakan inline CSS untuk mengatur ukuran ikon -->
                        </div>
                        <a href="#" class="small-box-footer" data-toggle="modal" data-target="#konfirmasiModal_{{ $loop->index }}">Mulai Ujian <i class="fa fa-arrow-circle-right"></i></a>
        
                        <!-- Modal -->
                        <div class="modal fade" id="konfirmasiModal_{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="konfirmasiModalLabel_{{ $loop->index }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="konfirmasiModalLabel_{{ $loop->index }}">Konfirmasi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-dark">
                                        Apakah Anda yakin ingin memulai ujian ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <?php
                                        // Enkripsi nilai sebelum menyertakannya dalam URL
                                        $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString($kategori->id);
                                        ?>
        
                                        <a href="{{ route('user.ujian.show', $encryptedId) }}" class="btn btn-primary">Ya, Lanjutkan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Chart container -->
        {{-- <div class="row">
            <div class="col-md-12">
                <div id="chartContainer" style="width: 1000px; height: 600px;">
                    <canvas id="nilaiUjianChart"></canvas>
                </div>                
            </div>
        </div> --}}
    </div>
</div>

<!-- END: Content-->

@push('after-script')
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Get the data for the chart from PHP (assuming it's available in the JavaScript variable named 'nilaiUserKategori')
    var nilaiUserKategori = {!! json_encode($nilaiUserKategori) !!};

    // Extracting category names and total values
    var categories = [];
    var totalValues = [];
    nilaiUserKategori.forEach(function(item) {
        categories.push(item.namaKategori);
        totalValues.push(item.total_nilai);
    });

    // Define an array of solid colors (for pie chart)
    var solidColors = [
        'rgba(255, 99, 132, 0.5)',
        'rgba(255, 159, 64, 0.5)',
        'rgba(255, 205, 86, 0.5)',
        'rgba(75, 192, 192, 0.5)',
        'rgba(54, 162, 235, 0.5)',
        'rgba(153, 102, 255, 0.5)',
        'rgba(201, 203, 207, 0.5)'
    ];

    // Create the chart
    var ctx = document.getElementById('nilaiUjianChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar', // Change the type to 'pie'
        data: {
            labels: categories,
            datasets: [{
                label: 'Nilai Ujian per Kategori',
                data: totalValues,
                backgroundColor: solidColors, // Assign solid colors
                borderColor: solidColors, // Assign solid colors
                borderWidth: 1
            }]
        },
        options: {
            // Remove the scales as they are not needed for a pie chart
            scales: {},
            legend: {
                display: true, // Display legend for pie chart
                position: 'right', // You can change the position of the legend as per your requirement
            },
            title: {
                display: true,
                text: 'Nilai Ujian per Kategori'
            }
        }
    });
</script> --}}
@endpush
@endsection
