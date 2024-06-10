@extends('layouts.app')


@section('title', 'Dashboard')

@section('src')

<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('/AdminLTE-2/bower_components/font-awesome/css/font-awesome.min.css') }}">
<!-- Theme style -->

@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
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

        <div class="content-body">
            <section id="add-home">
                <div class="row">
                    <div class="col-12">


                    </div>
                </div>
            </section>
        </div>

        
        {{-- baru  --}}
        <!-- Small boxes (Stat box) -->
        <div class="row" >
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->

                <div class="small-box bg-aqua ">
                    <div class="inner">
                        <h3></h3>

                        <p>Total Kategori</p>
                        <h1 class="text-white font-weight-bold display-4">{{ $kategori ?? '0' }}</h1>
                    </div>
                    <div class="icon mt-2">
                        <i class="fa fa-cube"></i>
                    </div>
                    <a href="{{ route('admin.kategori.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3></h3>
                        <p class="text-white">Total PIC</p>
                        <h1 class="text-white font-weight-bold display-4">{{ $admin ?? '0' }}</h1>
                    </div>
                    <div class="icon mt-2">
                        <i class="fa fa-coffee"></i> <!-- Ganti ikon dengan ikon kopi -->
                    </div>
                    <a href="{{ route('admin.pic.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3></h3>

                        <p>Total User</p>
                        <h1 class="text-white font-weight-bold display-4">{{ $user ?? '0' }}</h1>
                    </div>
                    <div class="icon mt-2">
                        <i class="fa fa-cubes"></i>
                    </div>
                    <a href="{{ route('admin.user.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            {{-- <div class="col-lg-3 col-xs-6">
                <!-- small box -->

                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3></h3>
                        <p class="text-white">Total Soal</p>
                        <h1 class="text-white font-weight-bold display-4">{{ $soal ?? '0' }}</h1>
                    </div>
                    <div class="icon mt-2">
                        <i class="fa fa-eye"></i>
                    </div>
                    <a href="{{ route('admin.soal.index') }}" class="small-box-footer text-white">Lihat <i class="fa fa-arrow-circle-right" style="color: #ffffff;"></i></a>
                </div>  
            </div> --}}

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3></h3>
                        <p class="text-white">Total Request</p>
                        <h1 class="text-white font-weight-bold display-4">{{ $request ?? '0' }}</h1>
                    </div>
                    <div class="icon mt-2">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <a href="{{ route('admin.request.index') }}" class="small-box-footer text-white">Lihat <i class="fa fa-arrow-circle-right" style="color: #ffffff;"></i></a>
                </div>  
            </div>
            <!-- ./col -->
            
        </div>
    
    <!-- ./col -->
</div>
    </div>
</div>

<!-- END: Content-->

@endsection
