@extends('layouts.appUser')

{{-- set title --}}
@section('title', 'Nilai ')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Nilai</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Nilai</li>
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
                                    <h4 class="card-title">Detail Nilai</h4>
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
                                                        <th>Nama Kategori</th>
                                                        <th style="text-align:center;" >Nilai</th>
                                                        <th style="text-align:center; width:120px;">Status Kelulusan</th>
                                                        <th style="text-align:center; width:100px;">Status Ujian</th>
                                                        <th style="text-align:center; width:120px;">Permission</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($nilaiUserKategori as $index => $data)
                                                    <tr data-entry-id="{{ $index }}">
                                                        <td>{{ $data['namaKategori'] }}</td>
                                                        <td style="text-align:center;">{{ $data['total_nilai'] }}</td>
                                                        <td style="text-align:center; color: 
                                                            @if ($data['total_nilai'] == 0)
                                                                gray
                                                            @elseif ($data['total_nilai'] >= $kkm && $data['total_nilai'] <= 100)
                                                                green
                                                            @else
                                                                red
                                                            @endif; font-weight: bold;">
                                                            @if ($data['total_nilai'] == 0)
                                                                {{-- Belum Mengikuti Ujian --}}
                                                            @elseif ($data['total_nilai'] >= $kkm && $data['total_nilai'] <= 100)
                                                                Lulus
                                                            @else
                                                                Gagal
                                                            @endif
                                                        </td>
                                                        <td style="text-align:center;">{{ $data['status'] }}</td>
                                                        <td>
                                                            <form id="requestForm{{ $index }}" action="{{ route('user.request.store') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                                <input type="hidden" name="kategori_id" value="{{ $data['kategori_id'] }}">
                                                                <div style="text-align: center;">
                                                                    @if($user->status != 'approved')
                                                                        <button type="button" onclick="confirmRequest({{ $index }})" class="btn btn-success btn-sm ml-1">Request Permission</button>
                                                                    @else
                                                                        <button type="button" class="btn btn-success btn-sm ml-1" disabled>Request Permission</button>
                                                                        <small class="text-muted">Permission already approved</small>
                                                                    @endif
                                                                </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">No data found.</td>
                                                    </tr>
                                                    @endforelse     
                                                </tbody>
                                                <tfoot>
                                                    {{-- <tr>
                                                        <th>Nama</th>
                                                        <th>Nilai</th>
                                                        <th>Grade</th>
                                                        <th>Status</th>
                                                        <th>Permission</th>
                                                    </tr> --}}
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
        // Fungsi untuk menampilkan SweetAlert konfirmasi
        function confirmRequest(index) {
        swal({
            title: "Konfirmasi",
            text: "Apakah Anda yakin ingin melakukan permintaan ujian?",
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
        })
        .then((willRequest) => {
            if (willRequest) {
                // Jika pengguna mengklik OK, submit formulir yang sesuai dengan index
                document.getElementById("requestForm" + index).submit();
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


