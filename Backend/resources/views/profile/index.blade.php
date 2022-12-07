@extends('layouts.base')
@section('title','Profile')
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
                                    <h4 class="page-title">Profil Info</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-4 col-xl-4">
                                <div class="card-box text-center">
                                    @if (Auth::user()->photo)
                                    <img src="{{asset('photos')}}/{{Auth::user()->photo}}" class="rounded-circle avatar-lg img-thumbnail" alt="{{Auth::user()->slug}}">
                                    @else
                                    <img src="{{asset('assets/images/user-circle.png')}}" class="rounded-circle avatar-lg img-thumbnail" alt="Profile">

                                    @endif
                                    <h4 class="mb-0">  {{Auth::user()->name}} </h4>
                                    <p class="text-muted">Administator</p>

                                    <a href="{{route('upload.photo', ['id' => Auth::user()->slug])}}" class="font-18 text-dark mt-1 mr-2" title="Upload Photo">
                                        <i class="mdi mdi-file-upload mdi-24-px"></i>
                                    </a>

                                    <a href="{{route('profil.edit', ['profil' => Auth::user()->slug])}}" class="font-18 text-warning mt-1" title="Edit" >
                                        <i class="mdi mdi-pencil mdi-24-px"></i></a>
                                </div> <!-- end card-box -->
                            </div> <!-- end col-->

                            <div class="col-lg-8 col-xl-8">
                                <div class="card-box">
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="settings">
                                            <form>
                                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Info Profil</h5>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="firstname">Name</label>
                                                            <input type="text" class="form-control" name="name"
                                                            value="{{old('name',Auth::user()->name)}}" placeholder=" Nama Lengkap" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="lastname">E-mail</label>
                                                            <input type="email" class="form-control" name="email"
                                                            value="{{old('name',Auth::user()->email)}}" placeholder="email" readonly>
                                                        </div>
                                                    </div> <!-- end col -->
                                                </div> <!-- end row -->
                                                <div class="text-right">

                                                </div>
                                            </form>
                                        </div>
                                        <!-- end settings content-->

                                    </div> <!-- end tab-content -->
                                </div> <!-- end card-box-->

                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->

                    </div> <!-- container -->

                </div> <!-- content -->


            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

@stop
