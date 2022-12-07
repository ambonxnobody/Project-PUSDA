@extends('layouts.base')
@section('title','Create Asset Soil children')
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
                                        <li class="breadcrumb-item"><a href="{{route('soil.show', ['soil' => $parent->id])}}">Detail Asset Soil</a></li>
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
                                                <a href="{{route('soil.show', ['soil' => $parent->id])}}" class="btn btn-sm btn-danger" title="Back"><div class="fas fa-reply"></div></a>
                                            </div>
                                        </div><!-- end col-->
                                    </div> <!-- end row -->
                                </div>
                                <!-- end card header -->

                                    <!-- start card-body -->
                                    <div class="card-body">
                                        <form action="{{route('childern.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Rental Retribution</label>
                                                <input type="hidden" name="parent_id" value="{{$parent->id}}">
                                                <input  type="number" class="form-control @error('rental_retribution') is-invalid @enderror"
                                                name="rental_retribution"  value="{{ old('rental_retribution') }}" required autocomplete="on"
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
                                                    <option selected>--Selected---</option>
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
                                                name="utilization_engagement_name"  value="{{ old('utilization_engagement_name') }}" required autocomplete="on"
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
                                                name="allotment_of_use"  value="{{ old('allotment_of_use') }}" required autocomplete="on"
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
                                                name="coordinate"  value="{{ old('coordinate') }}" required autocomplete="on"
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
                                                name="large"  value="{{ old('large') }}" required autocomplete="on"
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
                                                name="validity_period_of"  value="{{ old('validity_period_of') }}" required autocomplete="on"
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
                                                name="validity_period_until"  value="{{ old('validity_period_until') }}" required autocomplete="on"
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
                                                name="engagement_number"  value="{{ old('engagement_number') }}" required autocomplete="on"
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
                                                name="engagement_date"  value="{{ old('engagement_date') }}" required autocomplete="on"
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
                                                name="application_letter"  value="{{ old('application_letter') }}" required autocomplete="on"
                                                autofocus placeholder="Type" accept=".pdf">
                                                @error('application_letter')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Agreement Letter</label>
                                                <input  type="file" class="form-control @error('agreement_letter') is-invalid @enderror"
                                                name="agreement_letter"  value="{{ old('agreement_letter') }}" required autocomplete="on"
                                                autofocus placeholder="Type" accept=".pdf">
                                                @error('agreement_letter')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- <h4 class="text-light text-dark mt-2"> Payment</h4>

                                        <div class="form-row">
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4" class="col-form-label">Year</label>
                                                <input type="hidden" name="childrens_id" value="{{old('childrens_id')}}">
                                                <input  type="text" class="form-control @error('year') is-invalid @enderror"
                                                name="year"  value="{{ old('year') }}" required autocomplete="on"
                                                autofocus placeholder="Type">
                                                @error('year')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
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
                                            <div class="form-group col-md-4">
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
                                        </div> --}}

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
