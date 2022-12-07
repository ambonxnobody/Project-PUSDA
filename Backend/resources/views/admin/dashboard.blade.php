@extends('layouts.base')
@section('title','Dashboard Admin')
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
                                        <li class="breadcrumb-item active">@yield('title')</li>
                                    </ol>
                                </div>
                                <h4 class="page-title"><i data-feather="home"></i>  @yield('title'),Hi {{Auth::user()->name}} </h4>
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
                                <div class="card-box">
                                    <div class="dropdown float-right">

                                    </div>

                                    <h4 class="header-title mb-3 text-dark">History Users</h4>
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-nowrap table-hover table-centered m-0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                                @foreach($data  as $n)
                                                <tr >
                                                    <td>
                                                        <h5 class="m-0 font-weight-normal"> {{$n->name}} </h5>
                                                    </td>
                                                    <td> {{ $n->created_at->format('D-m-y')  }} </td>
                                                    <td>  {{ $n->created_at->diffForHumans()  }}  </td>
                                                    <td><span class="badge bg-soft-success text-dark">New</span></td>
                                                    <td>
                                                        <a href="#" title="detail" class="btn btn-xs btn-light">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                            </tbody>
                                            @endforeach
                                        </table>
                                    </div> <!-- end .table-responsive-->
                                </div> <!-- end card-box-->
                            </div>
                    </div> <!-- container -->
                </div> <!-- content -->
            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->

           <!-- ============================================================== -->








@stop
