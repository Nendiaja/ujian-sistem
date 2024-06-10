@extends('layouts.appVisitor')


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
        <div class="content-body">
            <section id="table-home">
                <!-- Zero configuration table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ $title }}</h4>
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
                                                    @foreach($kategoris as $kategori)
                                                        <th>{{ $kategori->nama }}</th>
                                                    @endforeach
                                            </thead>
                                            <tbody>
                                                @foreach($datas as $data)
                                                <tr>
                                                    <td>{{ $data->SAP }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $data->BU }}</td>
                                                    <td>{{ $data->department }}</td>

                                                        @foreach($kategoris as $kategori)
                                                        @php
                                                            $nilai = $data->kategoriUser->firstWhere('kategori_id', $kategori->id)->nilai_total ?? 'N/A';
                                                        @endphp
                                                        <td>{{ $nilai }}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach  
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
@endsection
