@extends('layouts.app')

{{-- set title --}}
@section('title', 'Visitor')

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

        {{-- breadcrumb --}}
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">User</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- add card --}}
        <div class="content-body">
            <section id="add-home">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <a data-action="collapse">
                                    <h4 class="card-title text-white">Add Data User</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-plus"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>

                            <div class="card-content collapse hide">
                                <div class="card-body card-dashboard">
                                    <form class="form form-horizontal" id="userForm" action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="role" value="visitor">
                                        <div class="form-body">
                                            <div class="form-section">
                                                <p>Please complete the input <code>required</code>, before you click the submit button.</p>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="SAP">SAP <code style="color:red;">required</code></label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="number" id="SAP" name="SAP" class="form-control" placeholder="Masukkan No. SAP" value="" autocomplete="off" required>
                                                    @if($errors->has('SAP'))
                                                    <p style="font-style: bold; color: red;">{{ $errors->first('SAP') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="name">Nama <code style="color:red;">required</code></label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan Nama" value="" autocomplete="off" required>
                                                    @if($errors->has('name'))
                                                    <p style="font-style: bold; color: red;">{{ $errors->first('name') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="BU">Business Unit <code style="color:red;">required</code></label>
                                                <div class="col-md-9 mx-auto">
                                                    <select id="BU" name="BU" class="form-control" required onchange="filterDepartments()">
                                                        <option value="">Select Business Unit</option>
                                                        @foreach ($BU as $bu)
                                                        <option value="{{ $bu->nama }}">{{ $bu->nama }}</option>
                                                        @endforeach
                                                    </select>                                                 
                                                    @if($errors->has('BU'))
                                                    <p style="font-style: bold; color: red;">{{ $errors->first('BU') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="department">Department <code style="color:red;">required</code></label>
                                                <div class="col-md-9 mx-auto">
                                                    <select id="department" name="department" class="form-control" required>
                                                        <option value="">Select Department</option>
                                                        @foreach ($department as $dept)
                                                        <option value="{{ $dept->nama }}" data-bu="{{ $dept->bussinesUnit->nama }}" class="department-option">{{ $dept->nama }}</option>
                                                        @endforeach                                                        
                                                    </select>
                                                    
                                                    @if($errors->has('department'))
                                                    <p style="font-style: bold; color: red;">{{ $errors->first('department') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions text-right">
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

        {{-- table card --}}
        <div class="content-body">
            <section id="table-home">
                <!-- Zero configuration table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">List</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered text-inputs-searching default-table">
                                            <thead>
                                                <tr>
                                                    <th>SAP</th>
                                                    <th>Nama</th>
                                                    <th>Business Unit</th>
                                                    <th>Department</th>
                                                    <th style="text-align:center; width:180px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($datas as $data)
                                                <tr data-entry-id="{{ $data->id }}">
                                                    <td>{{ $data->SAP }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $data->BU }}</td> <!-- Nama Business Unit -->
                                                    <td>{{ $data->department }}</td> <!-- Nama Business Unit -->
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{ route('admin.user.edit', $data->id) }}">Edit</a>
                                                                <form id="deleteForm_{{ $data->id }}" action="{{ route('admin.user.destroy', $data->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="dropdown-item delete-btn">Delete</button>
                                                                </form>
                                                            </div>
                                                            <a href="{{ route('admin.user.show', $data->id) }}" class="btn btn-success btn-sm ml-1" aria-haspopup="true" aria-expanded="false">Detail User</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No data found.</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>SAP</th>
                                                    <th>Nama</th>
                                                    <th>Bussines Unit</th>
                                                    <th>Department</th>
                                                    <th style="text-align:center; width:150px;">Action</th>
                                                </tr>
                                            </tfoot>
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
                document.getElementById("userForm").submit();
            }
        });
    }
</script>

<script>
    // Fungsi untuk menampilkan SweetAlert konfirmasi sebelum penghapusan
    function confirmDelete(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
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
        }).then((willDelete) => {
            if (willDelete) {
                // Jika pengguna mengonfirmasi, submit formulir penghapusan dengan ID yang sesuai
                document.getElementById('deleteForm_' + id).submit();
            }
        });
    }

    // Menambahkan event listener untuk tombol "Delete"
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const formId = btn.parentNode.id.split('_')[1]; // Ambil ID formulir dari ID tombol
            confirmDelete(formId); // Panggil fungsi konfirmasi penghapusan
        });
    });
</script>

<script>
    function filterDepartments() {
        var selectedBUName = document.getElementById('BU').value;
        var departments = document.querySelectorAll('.department-option');
    
        departments.forEach(function(option) {
            var buName = option.getAttribute('data-bu');
            if (selectedBUName === "" || buName === selectedBUName) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        });
    
        // Reset department selection
        document.getElementById('department').value = "";
    }
</script>
         
@endpush
