@extends('layouts.app')

{{-- set title --}}
@section('title', 'Soal ')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Soal</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Soal</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

     
                <div class="content-body">
                    <section id="add-home">
                        <div class="row">
                            <div class="col-12">

                                <div class="card">
                                    <div class="card-header bg-success text-white">
                                        <a data-action="collapse">
                                            <h4 class="card-title text-white">Add Data Soal :  @foreach($datas as $data)
                                                {{ $data->kategori->nama }}
                                                @break 
                                            @endforeach</h4>
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

                                            <form class="form form-horizontal" id="soalForm" action="{{ route('admin.soalByKategori.store') }}" method="POST" enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-body">
                                                    <div class="form-section">
                                                        <p>Please complete the input <code>required</code>, before you click the submit button.</p>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="kategori_id">Kategori <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select id="kategori_id" name="kategori_id" class="form-control" required>
                                                                @foreach($datas as $data)
                                                                    <option value="{{ $data->kategori->id }}">{{ $data->kategori->nama }}</option>
                                                                    @break 
                                                                @endforeach
                                                            </select>
                                                                @if($errors->has('kategori_id'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('kategori_id') }}</p>
                                                                @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="soal">Soal <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <textarea id="soal" name="soal" class="form-control" placeholder="Masukkan Soal" autocomplete="off" required></textarea>
                                                    
                                                            @if($errors->has('soal'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('soal') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-section">
                                                        <p>Tambahkan Opsi</p>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="a">Opsi a <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="a" name="a" class="form-control" placeholder="Masukkan a" value="" autocomplete="off" required>

                                                            @if($errors->has('a'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('a') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="b">Opsi b <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="b" name="b" class="form-control" placeholder="Masukkan b" value="" autocomplete="off" required>

                                                            @if($errors->has('b'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('b') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="c">Opsi c <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="c" name="c" class="form-control" placeholder="Masukkan c" value="" autocomplete="off" required>

                                                            @if($errors->has('c'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('c') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="d">Opsi d <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="d" name="d" class="form-control" placeholder="Masukkan d" value="" autocomplete="off" required>

                                                            @if($errors->has('d'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('d') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-section">
                                                        <p>Tambahkan Jawaban </p>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="jawaban1">Jawaban <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="jawaban1" id="jawaban1" class="form-control" required>
                                                                <option value="" disabled selected>Pilih Jawaban</option>
                                                                <option value="a">Jawaban A</option>
                                                                <option value="b">Jawaban B</option>
                                                                <option value="c">Jawaban C</option>
                                                                <option value="d">Jawaban D</option>
                                                            </select>
                                                    
                                                            @if($errors->has('jawaban1'))
                                                            <p style="font-weight: bold; color: red;">{{ $errors->first('jawaban') }}</p>
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
                                    <h4 class="card-title">List Data Soal @foreach($datas as $data)
                                        {{ $data->kategori->nama }}
                                        @break 
                                    @endforeach</h4>
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
                                                        <th>Kategori</th>
                                                        <th>Soal</th>
                                                        <th>Opsi A</th>
                                                        <th>Opsi B</th>
                                                        <th>Opsi C</th>
                                                        <th>Opsi D</th>
                                                        <th>Jawaban</th>
                                                        {{-- <th>Poin</th> --}}
                                                        <th style="text-align:center; width:150px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($datas as $data)
                                                        <tr data-entry-id="{{ $data->id }}">
                                                            <td>{{ $data->kategori->nama }}</td>
                                                            <td>{{ $data->soal }}</td>
                                                            <td>{{ $data->opsi[0]->a }}</td>
                                                            <td>{{ $data->opsi[0]->b }}</td>
                                                            <td>{{ $data->opsi[0]->c }}</td>
                                                            <td>{{ $data->opsi[0]->d }}</td>
                                                            <td>{{ $data->opsi[0]->jawaban ?? 'belum ada jawaban' }}</td>
                                                            {{-- <td>{{ $data->poin }}</td> --}}

                                                            <td class="text-center">
                                                                <div class="btn-group mr-1 mb-1">
                                                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle ml-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="{{ route('admin.soal.edit', $data->id) }}">Edit</a>
                                                                        <form id="deleteForm{{ $data->id }}" action="{{ route('admin.soal.destroy', $data->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="button" class="dropdown-item" onclick="confirmDelete({{ $data->id }})">Delete</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6">No data found.</td>
                                        
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Kategori</th>
                                                        <th>Soal</th>
                                                        <th>Opsi A</th>
                                                        <th>Opsi B</th>
                                                        <th>Opsi C</th>
                                                        <th>Opsi D</th>
                                                        <th>Jawaban</th>
                                                        {{-- <th>poin</th> --}}
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
                document.getElementById("soalForm").submit();
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var a = document.querySelector("#a").value;
            var b = document.querySelector("#b").value;
            var c = document.querySelector("#c").value;
            var d = document.querySelector("#d").value;
    
            var jawabanSelect = document.querySelector("#jawaban");
    
            // Atur nilai-nilai opsi sebagai nilai masing-masing opsi pada dropdown jawaban
            var options = jawabanSelect.querySelectorAll("option");
            options[1].setAttribute("value", a);
            options[1].setAttribute("data-value", a);
            options[2].setAttribute("value", b);
            options[2].setAttribute("data-value", b);
            options[3].setAttribute("value", c);
            options[3].setAttribute("data-value", c);
            options[4].setAttribute("value", d);
            options[4].setAttribute("data-value", d);
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
