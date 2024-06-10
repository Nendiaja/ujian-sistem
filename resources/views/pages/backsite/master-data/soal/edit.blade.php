@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - Soal')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Edit Kategori</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Soal</li>
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
                                        <form id="soalForm" class="form form-horizontal" action="{{ route('admin.soal.update', $datas->id) }}" method="POST" enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf

                                                <div class="form-body">

                                                    <h4 class="form-section"><i class="fa fa-edit"></i> Form Opsi</h4>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="kategori_id">Kategori <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select id="kategori_id" name="kategori_id" class="form-control" required>
                                                                <option value="{{ old('kategori_id', $datas->soal->kategori->id) }}">{{ $datas->soal->kategori->nama }}</option>
                                                            </select>
                                                                @if($errors->has('kategori_id'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('kategori_id') }}</p>
                                                                @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="soal">Soal <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="soal" name="soal" class="form-control" placeholder="Masukkan Soal" value="{{ old('soal', $datas->soal->soal) }}" autocomplete="off" required>

                                                            @if($errors->has('soal'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('soal') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="foto">Gambar <code style="color:green;">optional</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="file" id="gambar" name="gambar"  class="form-control" accept="image/*">
                                                    
                                                            @if($errors->has('gambar'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('gambar') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-section">
                                                        <p>Tambahkan Opsi</p>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="a">Opsi a <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="a" name="a" class="form-control" placeholder="Masukkan a" value="{{ old('a', $datas->a) }}" autocomplete="off" required>

                                                            @if($errors->has('a'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('a') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="b">Opsi b <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="b" name="b" class="form-control" placeholder="Masukkan b" value="{{ old('b', $datas->b) }}" autocomplete="off" required>

                                                            @if($errors->has('b'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('b') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="c">Opsi c <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="c" name="c" class="form-control" placeholder="Masukkan c" value="{{ old('c', $datas->c) }}"autocomplete="off" required>

                                                            @if($errors->has('c'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('c') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="d">Opsi d <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="d" name="d" class="form-control" placeholder="Masukkan d" value="{{ old('d', $datas->d) }}" autocomplete="off" required>

                                                            @if($errors->has('d'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('d') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-section">
                                                        <p>Tambahkan Jawaban </p>
                                                    </div>

                                                    
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="jawaban">Jawaban <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="jawaban" id="jawaban" class="form-control" required>
                                                                <option value="" disabled>Pilih Jawaban</option>
                                                                <option value="a" {{ $datas->jawaban == 'a' ? 'selected' : '' }}>Jawaban A</option>
                                                                <option value="b" {{ $datas->jawaban == 'b' ? 'selected' : '' }}>Jawaban B</option>
                                                                <option value="c" {{ $datas->jawaban == 'c' ? 'selected' : '' }}>Jawaban C</option>
                                                                <option value="d" {{ $datas->jawaban == 'd' ? 'selected' : '' }}>Jawaban D</option>
                                                            </select>
                                                    
                                                            @if($errors->has('jawaban'))
                                                            <p style="font-weight: bold; color: red;">{{ $errors->first('jawaban') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
                                                    

                                                </div>

                                                <div class="form-actions text-right">
                                                    <a href="{{ route('admin.soal.index') }}" style="width:120px;" class="btn bg-blue-grey text-white mr-1" onclick="return confirmCancel()">
                                                        <i class="ft-x"></i> Cancel
                                                    </a>
                                                    <button type="button" style="width:120px;" class="btn btn-cyan" onclick="confirmSubmit()">
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
                document.getElementById("soalForm").submit();
            }
        });
    }
</script>

<script>
    // Fungsi untuk menampilkan SweetAlert konfirmasi sebelum menutup halaman
    function confirmCancel() {
        Swal.fire({
            title: 'Are you sure?',
            text: "Any changes you make will not be saved.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the specified URL if user confirms
                window.location.href = "{{ route('admin.soal.index') }}";
            }
        });

        // Prevent default action (closing the page) if user cancels
        return false;
    }
</script>


@endpush
