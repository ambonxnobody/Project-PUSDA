@extends('layouts.base')
@section('title','Change Password')
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
                                    <h4 class="page-title">Change Password</h4>
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
                                                    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-danger" title="Back"><div class="fas fa-reply"></div></a>
                                                </div>
                                            </div><!-- end col-->
                                        </div> <!-- end row -->
                                    </div>
                                    <!-- end card header -->

                                        <!-- start card-body -->
                                        <div class="card-body">

                                            <form action="{{ route('changepassword.post') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="userpassword">Old password</label>
                                                                <div class="input-group input-group-merge">
                                                                    <input id="password" type="password" class="form-control  @error('current_passsowrd') is-invalid @enderror"
                                                                    placeholder="Enter your old password" name="current_passsowrd" required="">
                                                                    <div class="input-group-append" data-password="false">
                                                                        <div class="input-group-text">
                                                                            <span class="password-eye"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error('current_passsowrd')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div> <!-- end col -->
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="lastname">New Password</label>
                                                                <div class="input-group input-group-merge">
                                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                                                    placeholder="Enter your new password" name="password" required="">
                                                                    <div class="input-group-append" data-password="false">
                                                                        <div class="input-group-text">
                                                                            <span class="password-eye"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error('current_passsowrd')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div> <!-- end col -->
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="lastname">Confirm New Password</label>
                                                                <div class="input-group input-group-merge">
                                                                    <input id="password" type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                                                    placeholder="Enter your Confirm New Password" name="password_confirmation" required="">
                                                                    <div class="input-group-append" data-password="false">
                                                                        <div class="input-group-text">
                                                                            <span class="password-eye"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error('password_confirmation')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div> <!-- end col -->
                                                </div> <!-- end row -->

                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                                                </div>
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
