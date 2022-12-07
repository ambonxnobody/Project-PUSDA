@extends('layouts.base')

@if(Auth::user()->hasRole('upt_psda_kediri'))

    @section('title','Dashboard UPT Kediri')
    @section('content')

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
                                            <li class="breadcrumb-item active">@yield('title')</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i data-feather="home"></i> Dashboard {{Auth::user()->name}} </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


                            <div class="row">
                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                                    <i class="fe-users font-22 avatar-title text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class="mb-1"> <b>TOTAL USERS</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->

                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                                    <i class="fe-user font-22 avatar-title text-success"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class=" mb-1"> <b>UPT</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->

                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                                    <i class="fe-user font-22 avatar-title text-info"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class="mb-1"> <b>UPT</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->

                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                                    <i class="fe-users font-22 avatar-title text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class=" mb-1"> <b>UPT</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->
                            <!-- End Col 1 -->

                            <div class="col-xl-12 " >

                            </div>
                        </div> <!-- container -->
                    </div> <!-- content -->
        </div>

    @stop


@elseif (Auth::user()->hasRole('upt_psda_lumajang')){
    @section('title','Dashboard UPT Lumajang')
    @section('content')

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
                                            <li class="breadcrumb-item active">@yield('title')</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i data-feather="home"></i> Dashboard {{Auth::user()->name}} </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


                            <div class="row">
                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                                    <i class="fe-users font-22 avatar-title text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class="mb-1"> <b>TOTAL USERS</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->

                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                                    <i class="fe-user font-22 avatar-title text-success"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class=" mb-1"> <b>UPT</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->

                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                                    <i class="fe-user font-22 avatar-title text-info"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class="mb-1"> <b>UPT</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->

                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                                    <i class="fe-users font-22 avatar-title text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class=" mb-1"> <b>UPT</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->
                            <!-- End Col 1 -->

                            <div class="col-xl-12 " >

                            </div>
                        </div> <!-- container -->
                    </div> <!-- content -->
        </div>

    @stop
}

@elseif (Auth::user()->hasRole('upt_psda_bondowoso')){
    @section('title','Dashboard UPT Lumajang')
    @section('content')

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
                                            <li class="breadcrumb-item active">@yield('title')</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i data-feather="home"></i>  Dashboard {{Auth::user()->name}} </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


                            <div class="row">
                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                                    <i class="fe-users font-22 avatar-title text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class="mb-1"> <b>TOTAL USERS</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->

                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                                    <i class="fe-user font-22 avatar-title text-success"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class=" mb-1"> <b>UPT</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->

                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                                    <i class="fe-user font-22 avatar-title text-info"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class="mb-1"> <b>UPT</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->

                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                                    <i class="fe-users font-22 avatar-title text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class=" mb-1"> <b>UPT</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->
                            <!-- End Col 1 -->

                            <div class="col-xl-12 " >

                            </div>
                        </div> <!-- container -->
                    </div> <!-- content -->
        </div>

    @stop
}
@elseif (Auth::user()->hasRole('upt_psda_pasuruan')){
    @section('title','Dashboard UPT Lumajang')
    @section('content')

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
                                            <li class="breadcrumb-item active">@yield('title')</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i data-feather="home"></i> Dashboard {{Auth::user()->name}} </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


                            <div class="row">
                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                                    <i class="fe-users font-22 avatar-title text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class="mb-1"> <b>TOTAL USERS</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->

                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                                    <i class="fe-user font-22 avatar-title text-success"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class=" mb-1"> <b>UPT</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->

                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                                    <i class="fe-user font-22 avatar-title text-info"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class="mb-1"> <b>UPT</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->

                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                                    <i class="fe-users font-22 avatar-title text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class=" mb-1"> <b>UPT</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->
                            <!-- End Col 1 -->

                            <div class="col-xl-12 " >

                            </div>
                        </div> <!-- container -->
                    </div> <!-- content -->
        </div>

    @stop
}
@elseif (Auth::user()->hasRole('upt_psda_bojonegoro')){
    @section('title','Dashboard UPT Lumajang')
    @section('content')

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
                                            <li class="breadcrumb-item active">@yield('title')</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i data-feather="home"></i>Dashboard {{Auth::user()->name}} </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


                            <div class="row">
                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                                    <i class="fe-users font-22 avatar-title text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class="mb-1"> <b>TOTAL USERS</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->

                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                                    <i class="fe-user font-22 avatar-title text-success"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class=" mb-1"> <b>UPT</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->

                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                                    <i class="fe-user font-22 avatar-title text-info"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class="mb-1"> <b>UPT</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->

                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                                    <i class="fe-users font-22 avatar-title text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class=" mb-1"> <b>UPT</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->
                            <!-- End Col 1 -->

                            <div class="col-xl-12 " >

                            </div>
                        </div> <!-- container -->
                    </div> <!-- content -->
        </div>

    @stop
}
@elseif (Auth::user()->hasRole('upt_psda_pamekasan')){
    @section('title','Dashboard UPT Lumajang')
    @section('content')

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
                                            <li class="breadcrumb-item active">@yield('title')</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i data-feather="home"></i>Dashboard {{Auth::user()->name}} </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


                            <div class="row">
                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                                    <i class="fe-users font-22 avatar-title text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class="mb-1"> <b>TOTAL USERS</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->

                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                                    <i class="fe-user font-22 avatar-title text-success"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class=" mb-1"> <b>UPT</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->

                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                                    <i class="fe-user font-22 avatar-title text-info"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class="mb-1"> <b>UPT</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->

                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                                    <i class="fe-users font-22 avatar-title text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"> 12 </span></h3>
                                                    <p class=" mb-1"> <b>UPT</b> </p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div> <!-- end col-->
                            <!-- End Col 1 -->

                            <div class="col-xl-12 " >

                            </div>
                        </div> <!-- container -->
                    </div> <!-- content -->
        </div>

    @stop
}

@endif



