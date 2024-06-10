@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - Department')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Edit Department</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Department</li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- forms --}}
            <div class="content-body">
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
                                        <form class="form form-horizontal" id="kategoriForm" action="{{ route('admin.department.update', $department->id) }}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf                                     
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="fa fa-edit"></i> Form Department</h4>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="BU">Business Unit <code style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <select id="bussines_unit_id" name="bussines_unit_id" class="form-control" required onchange="filterDepartments()">
                                                            <option value="">Select Business Unit</option>
                                                            @foreach ($bussinesUnit as $bu)
                                                                <option value="{{ $bu->id }}" {{ (old('bussines_unit_id', $department->bussines_unit_id) == $bu->id) ? 'selected' : '' }}>
                                                                    {{ $bu->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>                                                 
                                                        @if($errors->has('bussines_unit_id'))
                                                            <p style="font-style: bold; color: red;">{{ $errors->first('bussines_unit_id') }}</p>
                                                        @endif
                                                    </div>  
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="nama">Nama Department<code style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan Nama Department" value="{{ old('id', $department->nama) }}" autocomplete="off" required>
                                                        @if($errors->has('nama'))
                                                            <p style="font-style: bold; color: red;">{{ $errors->first('nama') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="form-actions text-right">
                                                <a href="{{ route('admin.bussinesUnit.index') }}" style="width:120px;" class="btn bg-blue-grey text-white mr-1" id="cancelBtn">
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
    <script>
        jQuery(document).ready(function($){
            $('#mymodal').on('show.bs.modal', function(e){
                var button = $(e.relatedTarget);
                var modal = $(this);

                modal.find('.modal-body').load(button.data("remote"));
                modal.find('.modal-title').html(button.data("title"));
            });

            $('.select-all').click(function () {
                let $select2 = $(this).parent().siblings('.select2-full-bg')
                $select2.find('option').prop('selected', 'selected')
                $select2.trigger('change')
            })

            $('.deselect-all').click(function () {
                let $select2 = $(this).parent().siblings('.select2-full-bg')
                $select2.find('option').prop('selected', '')
                $select2.trigger('change')
            })
        });

        $('.default-table').DataTable( {
            "order": [],
            "paging": true,
            "lengthMenu": [ [5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"] ],
            "pageLength": 10
        });
    </script>

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
                document.getElementById("kategoriForm").submit();
            }
        });
    }
</script>
    <div class="modal fade" id="mymodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="btn close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <i class="fa fa-spinner fa spin"></i>
                </div>
            </div>
        </div>
    </div>
@endpush
