@extends('layouts.base')
@section('title','Create Payment')
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
                                        <li class="breadcrumb-item"><a href="#">Detail Asset Soil</a></li>
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
                                <div class="card-header bg-success">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4 class="text-light text-white"><i data-feather="plus"></i>@yield('title')</h4>
                                        </div><!-- end col-->
                                        <div class="col-lg-4">
                                            <div class="text-lg-right">
                                                <a href="{{route('soil.index')}}" class="btn btn-sm btn-danger" title="Back"><div class="fas fa-reply"></div></a>
                                            </div>
                                        </div><!-- end col-->
                                    </div> <!-- end row -->
                                </div>
                                <!-- end card header -->

                                    <!-- start card-body -->
                                    <div class="card-body">
                                        <form action="{{route('payment.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-row">
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4" class="col-form-label">Year</label>
                                                <input type="hidden" name="childrens_id" value="{{$chil->id}}">
                                                <input  type="text" class="form-control @error('year') is-invalid @enderror"
                                                name="year"  value="{{ old('year') }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('year')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4" class="col-form-label">Payment Amount</label>
                                                <input  type="number" class="form-control @error('payment_amount') is-invalid @enderror"
                                                name="payment_amount"  value="{{ old('payment_amount') }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('payment_amount')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Proof Of Payment</label>
                                                <input  type="file" class="form-control @error('proof_of_payment') is-invalid @enderror"
                                                name="proof_of_payment"  value="{{ old('proof_of_payment') }}" required autocomplete="on"
                                                autofocus placeholder="Type" accept=".pdf">
                                                @error('proof_of_payment')
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
