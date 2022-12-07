@extends('layouts.base')
@section('title','Asset Soil Parent')
@section('content')




            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                       <!-- start page title -->
                       <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">@yield('title')</li>
                                    </ol>
                                </div>
                                <h4 class="page-title"><i data-feather="database"></i> @yield('title') </h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-xl-12 " >
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{route('soil.create')}}" title="Create" class=" font-18 btn btn-xs btn-light">
                                        <i class="mdi mdi-plus"></i>
                                    </a>
                                </div>

                            </div>
                            <div class="card-box">
                                    <div class="dropdown float-right">
                                        <form action="{{route('importinduk.post')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                             <div class="input-group mb-3">
                                                <input type="file" name="file" required="" onfocus="file" accept=".xls,.xlsx,.csv,.xlx"
                                                class="form-control @error('file') is-invalid @enderror" placeholder="Recipient's username"
                                                aria-label="Recipient's username" aria-describedby="button-addon2">
                                                <button class="btn btn-primary" type="submit" id="button-addon2" required>IMPORT</button>
                                                @error('file')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                 @enderror
                                            </div>
                                        </form>
                                    </div>

                                    <div class="">
                                        <a href="{{route('export.post')}}" title="Create" class=" font-18 btn btn-xs btn-light">
                                            <i class="mdi mdi-file-import text-success"></i> Export All Data
                                        </a>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-borderless table-nowrap table-hover table-centered m-0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Author</th>
                                                    <th>Certificate Number</th>
                                                    <th>Certificate Date</th>
                                                    <th>Item Name</th>
                                                    <th>Value Asset</th>
                                                    <th>Large(m2)</th>
                                                    <th>Address</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                                @foreach($data  as $no => $n)
                                                <tr >
                                                    <td> {{ $no + $data->firstItem() }} </td>
                                                    <td> {{$n->user->name}} </td>
                                                    <td>
                                                        <h5 class="m-0 font-weight-normal"> {{$n->certificate_number}} </h5>
                                                    </td>
                                                    <td> {{$n->certificate_date}}  </td>
                                                    <td> {{$n->item_name}}  </td>
                                                    <td> @currency($n->asset_value) </td>
                                                    <td>
                                                        {{$n->large}}
                                                    </td>
                                                    <td> {!! Str::limit($n->address, 20, ' ...') !!} </td>
                                                    <td class="text-center">
                                                        <a href="{{route('soil.show', ['soil' => $n->id])}}" title="Detail" class="btn btn-xs btn-light">
                                                            <i class="mdi mdi-eye text-info"></i>
                                                        </a>
                                                        <a href="{{route('soil.edit', ['soil' => $n->id])}}" title="Edit" class="btn btn-xs btn-light">
                                                            <i class="mdi mdi-pencil text-warning"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-xs btn-light" title="Delete"
                                                            data-toggle="modal" data-target="#hapus_event_{{ $n->id }}">
                                                            <i class="mdi mdi-trash-can text-danger"></i>
                                                        </button>
                                                        <a href="#" title="Import Data Excel" class="btn btn-xs btn-light">
                                                            <i class="mdi mdi-file-import text-success"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                            </tbody>

                                             <!-- modal Delete -->
                                                <form method="POST" action="{{route('soil.destroy', ['soil' => $n->id])}}">
                                                    <div class="modal fade" id="hapus_event_{{$n->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                <p>Apakah anda yakin ingin hapus data ini?</p>
                                                                @csrf
                                                                {{ method_field('DELETE') }}
                                                                </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Tidak</button>
                                                            <button type="submit" class="btn btn-danger"><i class="fa fa-paper-plane m-r-5"></i> Hapus</button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                {{-- End Modal Delete --}}

                                            @endforeach
                                        </table>
                                    </div> <!-- end .table-responsive-->
                            </div> <!-- end card-box-->
                            {{$data->links('vendor.pagination.bootstrap-4')}}
                        </div>
                    </div>
                    </div> <!-- container -->
                </div> <!-- content -->
            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->

           <!-- ============================================================== -->








@stop
