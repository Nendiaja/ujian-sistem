@extends('layouts.app')

{{-- set title --}}
@section('title', 'User')

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
                    <h3 class="content-header-title mb-0 d-inline-block">User</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a></li>
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
                                            <h4 class="card-title text-white">Add Data</h4>
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

                                            <form class="form form-horizontal" action="{{ route('backsite.user.store') }}" method="POST" enctype="multipart/form-data">

                                                @csrf

                                                <div class="form-body">
                                                    <div class="form-section">
                                                        <p>Please complete the input <code>required</code>, before you click the submit button.</p>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="nim">NIM <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="number" id="nim" name="nim" class="form-control" placeholder="Masukkan NIM" value="" autocomplete="off" required>

                                                            @if($errors->has('nim'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('nim') }}</p>
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
                                                        <label class="col-md-3 label-control" for="email">Email <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="email" name="email" class="form-control" placeholder="Masukkan Email" value="" autocomplete="off" required>

                                                            @if($errors->has('email'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('email') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="password">Password <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password" value="" autocomplete="off" required>

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
                                                                    <option value="{{ $prodi->id }}">
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
                                                                    <option value="{{ $semester->id }}">
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
                                                            <input type="file" id="foto" name="foto" class="form-control" accept="image/*">
                                                    
                                                            @if($errors->has('foto'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('foto') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
                                                

                                                </div>

                                                <div class="form-actions text-right">
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
                                                        <th>NIM</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Password</th>
                                                        <th>Foto</th>
                                                        <th style="text-align:center; width:150px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($userResourceCollection as $data)
                                                        <tr data-entry-id="{{ $data->id }}">
                                                            <td>{{ $data->nim }}</td>
                                                            <td>{{ $data->name }}</td>
                                                            <td>{{ $data->email }}</td>
                                                            <td>{{ $data->password }}</td>
                                                            <td>
                                                                @if($data->foto)
                                                                <img src="{{ asset('/images/' . $data->foto ) }}" alt="{{ $data->foto }}" class="img-thumbnail" style="width: 50px; height: 50px;">
                                                                @else
                                                                    No Image
                                                                @endif
                                                            </td>
                                                            
                                                            <td class="text-center">
                                                                <div class="btn-group mr-1 mb-1">
                                                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="{{ route('backsite.user.edit', $data->id) }}">Edit</a>
                                                                        <form action="{{ route('backsite.user.destroy', $data) }}" method="POST" onsubmit="return confirm('Are Syou sure want to delete this data ?');">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="dropdown-item">Delete</button>
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
                                                        <th>NIM</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Password</th>
                                                        <th>Foto</th>
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
