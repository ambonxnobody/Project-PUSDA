@extends('layouts.base')
@section('title','Management User Create')
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
                                        <li class="breadcrumb-item"><a href="{{route('usermanagement.index')}}">Management Users</a></li>
                                        <li class="breadcrumb-item active">Create</li>
                                    </ol>
                                </div>
                                <h4 class="page-title"/>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                                <!-- start card -->
                                <div class="card">
                                <!-- start card header -->
                                <div class="card-header bg-success">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4 class="text-light text-white"><i data-feather="plus"></i> @yield('title')</h4>
                                        </div><!-- end col-->
                                        <div class="col-lg-4">
                                            <div class="text-lg-right">
                                                <a href="{{ route('usermanagement.index') }}" class="btn btn-sm btn-danger" title="Back"><div class="fas fa-reply"></div></a>
                                            </div>
                                        </div><!-- end col-->
                                    </div> <!-- end row -->
                                </div>
                                <!-- end card header -->

                                    <!-- start card-body -->
                                    <div class="card-body">
                                        <form action="{{route('usermanagement.store')}}" method="POST">
                                        @csrf

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Name</label>
                                                <input  type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name"  value="{{ old('name') }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Email Address</label>
                                                <input  type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email"  value="{{ old('email') }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Password</label>
                                                <input  type="password" class="form-control @error('password') is-invalid @enderror"
                                                name="password"  value="{{ old('password') }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="input-group-append" data-password="false">
                                                    <div class="input-group-text">
                                                        <span class="password-eye"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Confirm Password</label>
                                                <input  type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                                name="password_confirmation"  value="{{ old('password_confirmation') }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                <div class="input-group-append" data-password="false">
                                                    <div class="input-group-text">
                                                        <span class="password-eye"></span>
                                                    </div>
                                                </div>
                                                @error('password_confirmation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4" class="col-form-label">Roles</label>
                                                <select name="role_id" class="form-control @error('role_id') is-invalid @enderror" required autocomplete="on">
                                                    <option selected>--Selected---</option>
                                                    @foreach ($roles as $r )
                                                     <option value="{{$r->id}}">{{$r->display_name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('role_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- start card-footer -->
                                        <div class="card-footer">
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-outline-success waves-effect waves-light">Submit</button>
                                        </div>
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
