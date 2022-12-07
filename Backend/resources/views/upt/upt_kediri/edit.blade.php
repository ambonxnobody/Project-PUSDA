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
                                                <a href="{{ route('kediri.index') }}" class="btn btn-sm btn-danger" title="Back"><div class="fas fa-reply"></div></a>
                                            </div>
                                        </div><!-- end col-->
                                    </div> <!-- end row -->
                                </div>
                                <!-- end card header -->

                                    <!-- start card-body -->
                                    <div class="card-body">
                                        <form action="{{route('kediri.update',['kediri' => $parent->id])}}" method="POST">
                                            @method('PUT')
                                            @csrf

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Name Goods</label>
                                                <input type="hidden" name="auhtor" value="{{ old('auhtor',$parent->auhtor) }}">
                                                <input type="hidden" name="no_reg" value="{{ old('no_reg',$parent->no_reg) }}" >

                                                <input  type="text" class="form-control @error('name_goods') is-invalid @enderror"
                                                name="name_goods"  value="{{ old('name_goods',$parent->name_goods) }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('name_goods')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">No</label>
                                                <input  type="number" class="form-control @error('no') is-invalid @enderror"
                                                name="no"  value="{{ old('no',$parent->no) }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Date</label>
                                                <input  type="date" class="form-control @error('date') is-invalid @enderror"
                                                name="date"  value="{{ old('date',$parent->date) }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('date')
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
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Address</label>
                                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Type"  rows="1">{{old('address',$parent->address)}}</textarea>
                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Village</label>
                                                <input  type="text" class="form-control @error('village') is-invalid @enderror"
                                                name="village"  value="{{ old('village',$parent->village) }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('village')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Kecamatan</label>
                                                <input  type="text" class="form-control @error('kec') is-invalid @enderror"
                                                name="kec"  value="{{ old('kec',$parent->kec) }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('kec')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Kabupaten/City</label>
                                                <input  type="text" class="form-control @error('kab_city') is-invalid @enderror"
                                                name="kab_city"  value="{{ old('kab_city',$parent->kab_city) }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('kab_city')
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
