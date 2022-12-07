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
                                        <form action="{{route('childern.update',['id' => $chil->id])}}" method="POST">
                                            @method('PUT')
                                            @csrf


                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Rental Retribution</label>
                                                <input type="hidden" name="parent_id" value="{{ old('parent_id',$chil->parent_id) }}">
                                                <input  type="number" class="form-control @error('rental_retribution') is-invalid @enderror"
                                                name="rental_retribution"  value="{{ old('rental_retribution',$chil->rental_retribution) }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('rental_retribution')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Utilization Engagement Type</label>
                                                <select name="utilization_engagement_type" class="form-control @error('utilization_engagement_type') is-invalid @enderror" required autocomplete="on">
                                                    <option value="{{$chil->utilization_engagement_type}}"> {{$chil->utilization_engagement_type}} </option>
                                                    <option value="sewa_sip_bmd">Sewa/Sip BMD</option>
                                                    <option value="retribusi">Retribusi</option>
                                                </select>
                                                @error('utilization_engagement_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Utilization Engagement Name</label>
                                                <input  type="text" class="form-control @error('utilization_engagement_name') is-invalid @enderror"
                                                name="utilization_engagement_name"  value="{{ old('utilization_engagement_name',$chil->utilization_engagement_name) }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('utilization_engagement_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Allotment Of Use</label>
                                                <input  type="text" class="form-control @error('allotment_of_use') is-invalid @enderror"
                                                name="allotment_of_use"  value="{{ old('allotment_of_use',$chil->allotment_of_use) }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('allotment_of_use')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Coordinate</label>
                                                <input  type="text" class="form-control @error('coordinate') is-invalid @enderror"
                                                name="coordinate"  value="{{ old('coordinate',$chil->coordinate) }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('coordinate')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Large</label>
                                                <input  type="text" class="form-control @error('large') is-invalid @enderror"
                                                name="large"  value="{{ old('large',$chil->large) }}" required autocomplete="on"
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
                                                <label for="inputEmail4" class="col-form-label">Validity Period Of</label>
                                                <input  type="date" class="form-control @error('validity_period_of') is-invalid @enderror"
                                                name="validity_period_of"  value="{{ old('validity_period_of',$chil->validity_period_of) }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('validity_period_of')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Validity Period Until</label>
                                                <input  type="date" class="form-control @error('validity_period_until') is-invalid @enderror"
                                                name="validity_period_until"  value="{{ old('validity_period_until',$chil->validity_period_until) }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('validity_period_until')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Engagement Number</label>
                                                <input  type="text" class="form-control @error('engagement_number') is-invalid @enderror"
                                                name="engagement_number"  value="{{ old('engagement_number',$chil->engagement_number) }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('engagement_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Engagement Date</label>
                                                <input  type="date" class="form-control @error('engagement_date') is-invalid @enderror"
                                                name="engagement_date"  value="{{ old('engagement_date',$chil->engagement_date) }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('engagement_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Application Letter</label>
                                                <input  type="file" class="form-control @error('application_letter') is-invalid @enderror"
                                                name="application_letter"  value="{{ old('application_letter',$chil->application_letter) }}"  accept=".pdf">
                                                <label class="text-muted mt-1">{{$chil->application_letter}}</label>
                                                @error('application_letter')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Agreement Letter</label>
                                                <input  type="file" class="form-control @error('agreement_letter') is-invalid @enderror"
                                                name="agreement_letter"  value="{{ old('agreement_letter',$chil->agreement_letter) }}" accept=".pdf">
                                                <label class="text-muted mt-1">{{$chil->agreement_letter}}</label>
                                                @error('agreement_letter')
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
