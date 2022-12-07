@extends('layouts.base')
@section('title','Upload Photo')
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
                                            <li class="breadcrumb-item"><a href="{{route('profil.index')}}">Profil</a></li>
                                            <li class="breadcrumb-item active">@yield('title')</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Upload Photo Profile</h4>
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
                                                <h4 class="text-light text-dark"></h4>
                                            </div><!-- end col-->
                                            <div class="col-lg-4">
                                                <div class="text-lg-right">
                                                    <a href="{{ route('profil.index') }}" class="btn btn-sm btn-danger" title="Back"><div class="fas fa-reply"></div></a>
                                                </div>
                                            </div><!-- end col-->
                                        </div> <!-- end row -->
                                    </div>
                                    <!-- end card header -->

                                        <!-- start card-body -->
                                        <div class="card-body">
                                            <form action="{{route('uploadphoto.post',['id' =>$user->id ])}}" method="POST" enctype="multipart/form-data">
                                                @csrf

                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4" class="col-form-label">File</label>
                                                    <input  type="file" class="form-control @error('photo') is-invalid @enderror"
                                                    name="photo" id="photo" value="{{ old('photo') }}" required autocomplete="on"
                                                    autofocus accept="image/*">
                                                    @error('photo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4" class="col-form-label"></label>
                                                    <img id="preview-image" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                                    alt="preview image" style="max-height: 250px;">
                                                </div>
                                            </div>

                                        <!-- start card-footer -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
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

@push('js-internal')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@endpush

@push('js-external')
<script type="text/javascript">

$(document).ready(function (e) {


   $('#photo').change(function(){

    let reader = new FileReader();

    reader.onload = (e) => {

      $('#preview-image').attr('src', e.target.result);
    }

    reader.readAsDataURL(this.files[0]);

   });

});

</script>
@endpush
