@extends('layouts.base')
@section('title','Edit Asset Soil')
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
                                        <li class="breadcrumb-item"><a href="{{route('soil.index')}}">Asset Soil</a></li>
                                        <li class="breadcrumb-item active">@yield('title')</li>
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
                                <div class="card-header bg-warning">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4 class="text-light text-white"><i data-feather="edit"></i> @yield('title')</h4>
                                        </div><!-- end col-->
                                        <div class="col-lg-4">
                                            <div class="text-lg-right">
                                                <a href="{{ route('soil.index') }}" class="btn btn-sm btn-danger" title="Back"><div class="fas fa-reply"></div></a>
                                            </div>
                                        </div><!-- end col-->
                                    </div> <!-- end row -->
                                </div>
                                <!-- end card header -->

                                    <!-- start card-body -->
                                    <div class="card-body">
                                        <form action="{{route('soil.update',['soil' => $parent->id])}}" method="POST">
                                            @method('PUT')
                                            @csrf

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Certificate Number</label>
                                                    <input type="hidden" name="auhtor" value="{{ old('auhtor',$parent->auhtor) }}">
                                                    <input  type="text" class="form-control @error('certificate_number') is-invalid @enderror"
                                                    name="certificate_number"  value="{{ old('certificate_number',$parent->certificate_number) }}" required autocomplete="on"
                                                    autofocus placeholder="Type">
                                                    @error('certificate_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Certificate Date</label>
                                                    <input  type="date" class="form-control @error('certificate_date') is-invalid @enderror"
                                                    name="certificate_date"  value="{{ old('certificate_date',$parent->certificate_date) }}" required autocomplete="on"
                                                    autofocus placeholder="Type">
                                                    @error('certificate_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Utilization Type</label>
                                                    <select name="utilization_type" class="form-control @error('utilization_type') is-invalid @enderror" required autocomplete="on">
                                                        <option value="{{$parent->utilization_type}}" selected>{{$parent->utilization_type}}</option>
                                                        <option value="pinjam_pakai">Pinjam Pakai</option>
                                                        <option value="pakai_sendiri">Pakai Sendiri</option>
                                                        <option value="sewa_retibusi">Sewa Retibusi</option>
                                                    </select>
                                                    @error('utilization_type')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Large</label>
                                                    <input  type="number" class="form-control @error('large') is-invalid @enderror"
                                                    name="large"  value="{{ old('large',$parent->large) }}" required autocomplete="on"
                                                    autofocus placeholder="Type">
                                                    @error('large')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4" class="col-form-label">Address</label>
                                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Type"  rows="4">{{old('address',$parent->address)}}</textarea>
                                                    @error('address')
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
