@extends('layouts.base')
@section('title','Profile Edit')
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
                                            <li class="breadcrumb-item"><a href="{{route('profil.index')}}">Profil</a></li>
                                            <li class="breadcrumb-item active">@yield('title')</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Edit Profile</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                    <!-- start card -->
                                    <div class="card">
                                    <!-- start card header -->
                                    <div class="card-header bg-warning">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4 class="text-light text-dark">Form @yield('title')</h4>
                                            </div><!-- end col-->
                                            <div class="col-lg-4">
                                                <div class="text-lg-right">
                                                    <a href="{{ route('profil.index') }}" class="btn btn-sm btn-danger" title="Back"><div class="fas fa-reply"></div></a>
                                                </div>
                                            </div><!-- end col-->
                                        </div> <!-- end row -->
                                    </div>
                                    <!-- end card header -->

                                        <!-- start card-body -->
                                        <div class="card-body">
                                            <form action="{{route('profil.update',['profil' =>$user->id ])}}" method="POST">
                                                @method('PUT')
                                                @csrf

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Full Name</label>
                                                    <input  type="text" class="form-control @error('name') is-invalid @enderror"
                                                    name="name" value="{{ old('name',$user->name) }}" required autocomplete="name"
                                                    autofocus placeholder="Nama Lengkap">
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Email</label>
                                                    <input  type="email" class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email',$user->email) }}" required autocomplete="email"
                                                    autofocus placeholder="Email">
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                        <!-- start card-footer -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                                        </div>
                                        <!-- start card-footer -->
                                    </form>
                                    </div>
                                    <!-- end card-->

                            </div> <!-- end col -->
                        </div>

                    </div> <!-- container -->

                </div> <!-- content -->


            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

@stop
