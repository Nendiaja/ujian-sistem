@extends('layouts.app')

@section('title', 'Detail User')

@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

        {{-- error --}}
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
                <h3 class="content-header-title mb-0 d-inline-block">Detail User</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
                            <li class="breadcrumb-item active">Detail User</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="dropdown float-md-right">
                    <button class="btn btn-primary btn-print" data-url="{{ route('user.printpdf', $user->id) }}">Print PDF</button>
                </div>
            </div>
        </div>

        {{-- table card --}}
        <div class="content-body">
            <section id="table-home">
                <!-- Zero configuration table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-2">Detail User {{ $user->name }} </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>SAP</th>
                                            <th>Nama</th>
                                            <th>Bussines Unit</th>
                                            <th>Department</th>
                                            {{-- <th>PIC</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $user->SAP }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->BU }}</td>
                                            <td>{{ $user->department }}</td>
                                        </tr>
                                    </tbody>
                                </table>            
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <h4 class="card-title">Detail Nilai </h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered text-inputs-searching default-table">
                                            <thead>
                                                <tr>
                                                    <th style="width:500px;"> Kategori</th>
                                                    <th style="text-align:center;">Nilai</th>
                                                    <th style="text-align:center;">Status Kelulusan</th>
                                                    {{-- <th style="text-align:center;">Tanggal Ujian</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($kategoriUsers as $kategoriUser)
                                                    <tr>
                                                        <td>{{ $kategoriUser->kategori->nama }}</td>
                                                        <td style="text-align:center;">{{ $kategoriUser->nilai_total }}</td>
                                                        <td style="text-align:center; color: 
                                                            @if ($kategoriUser->nilai_total == 0)
                                                                gray
                                                            @elseif ($kategoriUser->nilai_total >= 83 && $kategoriUser->nilai_total <= 100)
                                                                green
                                                            @else
                                                                red
                                                            @endif; font-weight: bold;">
                                                            @if ($kategoriUser->nilai_total == 0)
                                                                {{-- Belum Mengikuti Ujian --}}
                                                            @elseif ($kategoriUser->nilai_total >= 83 && $kategoriUser->nilai_total <= 100)
                                                                Lulus
                                                            @else
                                                                Gagal
                                                            @endif
                                                        </td>
                                                        {{-- <td style="text-align:center;">
                                                            @if ($kategoriUser->nilai_total != null && $kategoriUser->nilai_total != 0 && $kategoriUser->updated_at)
                                                                {{ $kategoriUser->updated_at->timezone('Asia/Jakarta')->translatedFormat('l, d F Y H:i:s') }}
                                                            @endif --}}
                                                        </td>
                                                                                                         
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">No data found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- END: Content-->

@endsection

@push('after-script')
<!-- Memuat jQuery dari CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    // Fungsi untuk menangani klik tombol print
    $(document).on('click', '.btn-print', function() {
        var url = $(this).data('url');
        window.location.href = url;
    });
</script>

@endpush