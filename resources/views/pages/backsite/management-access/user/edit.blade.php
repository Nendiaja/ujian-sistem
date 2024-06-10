@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - User')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Edit User</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">User</li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- forms --}}
            <div class="content-body"><!-- Basic form layout section start -->
                <section id="horizontal-form-layouts">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="horz-layout-basic">Form Input</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collpase show">
                                    <div class="card-body">
                                        <div class="card-text">
                                            <p>Please complete the input <code>required</code>, before you click the submit button.</p>
                                        </div>
                                        <form class="form form-horizontal" action="{{ route('backsite.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">

                                                @method('PUT')
                                                @csrf

                                                <div class="form-body">

                                                    <h4 class="form-section"><i class="fa fa-edit"></i> Form User</h4>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="nim">NIM <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="number" id="nim" name="nim" class="form-control" placeholder="Masukkan NIM" 
                                                                   value="{{ old('nim', $user->nim) }}" autocomplete="off" required>
                                                    
                                                            @if($errors->has('nim'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('nim') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="name">Nama <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan Nama" value="{{ old('name', $user->name) }}" autocomplete="off" required>

                                                            @if($errors->has('name'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('name') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="email">Email <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="email" name="email" class="form-control" placeholder="Masukkan Email" value="{{ old('email', $user->email) }}" autocomplete="off" required>

                                                            @if($errors->has('email'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('email') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="password">Password <code style="color:green;">optional</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password Baru" value="" autocomplete="off" >

                                                            @if($errors->has('password'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('password') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="prodi_id">Program Studi <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select id="prodi_id" name="prodi_id" class="form-control" required>
                                                                <option value="">Pilih Program Studi</option>
                                                                @foreach ($prodis as $prodi)
                                                                    <option value="{{ $prodi->id }}" {{ old('prodi', $user->prodi_id) == $prodi->id ? 'selected' : '' }}>
                                                                        {{ $prodi->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('prodi_id'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('prodi_id') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="semester_id">Semester <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select id="semester_id" name="semester_id" class="form-control" required>
                                                                <option value="">Pilih Semester</option>
                                                                @foreach ($semesters as $semester)
                                                                    <option value="{{ $semester->id }}" {{ old('semester', $user->semester_id) == $semester->id ? 'selected' : '' }}>
                                                                        {{ $semester->semester }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('semester_id'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('semester_id') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="foto">Foto <code style="color:green;">optional</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="file" id="foto" name="foto"  class="form-control" accept="image/*">
                                                    
                                                            @if($errors->has('foto'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('foto') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-actions text-right">
                                                    <a href="{{ route('backsite.user.index') }}" style="width:120px;" class="btn bg-blue-grey text-white mr-1" onclick="return confirm('Are you sure want to close this page? , Any changes you make will not be saved.')">
                                                        <i class="ft-x"></i> Cancel
                                                    </a>
                                                    <button type="submit" style="width:120px;" class="btn btn-cyan" onclick="return confirm('Are you sure want to save this data ?')">
                                                        <i class="la la-check-square-o"></i> Submit
                                                    </button>
                                                </div>
                                            </form>
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
