@extends('layouts.app')

{{-- set title --}}
@section('title', 'Rules ')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Rules</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Rules</li>
                            </ol>
                        </div>
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
                                    <h4 class="card-title">List Data Rules</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered text-inputs-searching default-table">
                                                <thead>
                                                    <tr>
                                                        <th>Waktu Ujian (dalam satuan menit)</th>
                                                        <th>KKM </th>
                                                        <th style="text-align:center; width:200px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($waktu as $data)
                                                        <tr data-entry-id="{{ $data->id }}">
                                                            <td>{{ $data->waktu }}</td>
                                                            <td>{{ $data->KKM }}</td>
                                                            <td class="text-center">
                                                                <div class="btn-group mr-1 mb-1">
                                                                    <button type="button" class="btn btn-info btn-sm ml-1 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="{{ route('admin.rules.edit', $data->id) }}">Edit</a>
                                                                    </div> 
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
                                                        <th>Waktu</th>
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
                document.getElementById("kategoriForm").submit();
            }
        });
    }
</script>

<script>
    function confirmDelete(id) {
        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
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
                // If user confirms deletion, submit the delete form with the corresponding ID
                document.getElementById('deleteForm' + id).submit();
            }
        });
    }
</script>
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
