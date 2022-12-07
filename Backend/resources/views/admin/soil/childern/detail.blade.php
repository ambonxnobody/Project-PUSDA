@extends('layouts.base')
@section('title','Detail Asset Soil children')
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
                                <h4 class="page-title">
                                    <div class="text-lg-left">
                                        <a href="{{ route('soil.index') }}" class="btn btn-sm btn-danger" title="Back"><div class="fas fa-reply"></div></a>
                                    </div>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">


                        <div class="col-md-12">
                            <div class="card-box">
                                <div class="tab-content">
                                    <div class="tab-pane active">

                                        <form>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="firstname">Author</label>
                                                        <input type="text" class="form-control" readonly value="{{Auth::user()->name}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lastname">Author Email</label>
                                                        <input type="text" class="form-control" readonly value="{{Auth::user()->email}}">
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="firstname">Rental Retribution</label>
                                                        <input type="text" class="form-control" readonly value="{{$chil->rental_retribution}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lastname">Utilization Engagement Type</label>
                                                        <input type="text" class="form-control" readonly value="{{$chil->utilization_engagement_type}}">
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="firstname">Utilization Engagement Name</label>
                                                        <input type="text" class="form-control" readonly value="{{$chil->utilization_engagement_name}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lastname">Allotment Of Use</label>
                                                        <input type="text" class="form-control" readonly value="{{$chil->allotment_of_use}}">
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="firstname">Coordinate</label>
                                                        <input type="text" class="form-control" readonly value="{{$chil->coordinate}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lastname">Large</label>
                                                        <input type="text" class="form-control" readonly value="{{$chil->large}}">
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="firstname">Validity Period Of</label>
                                                        <input type="text" class="form-control" readonly value="{{$chil->validity_period_of}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lastname">Validity Period Until</label>
                                                        <input type="text" class="form-control" readonly value="{{$chil->validity_period_until}}">
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="firstname">Engagement Number</label>
                                                        <input type="text" class="form-control" readonly value="{{$chil->engagement_number}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lastname">Engagement Date</label>
                                                        <input type="text" class="form-control" readonly value="{{$chil->engagement_date}}">
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="firstname">Application Letter</label>
                                                        <input type="text" class="form-control" readonly value="{{$chil->application_letter}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lastname">Agreement Letter</label>
                                                        <input type="text" class="form-control" readonly value="{{$chil->agreement_letter}}">
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->



                                        </form>

                                    </div> <!-- end tab-pane -->

                                    <!-- end settings content-->

                                </div> <!-- end tab-content -->
                            </div> <!-- end card-box-->

                        </div> <!-- end col -->
                    </div>

                    </div> <!-- container -->
                </div> <!-- content -->
            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->

           <!-- ============================================================== -->



@stop
