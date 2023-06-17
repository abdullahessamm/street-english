@extends('web.layouts.app', [
    'title' => 'Check your certificate by serial number',
    'scripts' => 'pages.certificate.index',
])

@section('content')
<!-- Contact Page Section -->
<section class="contact-page-section">
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card-body row no-gutters align-items-center">
                    <div class="col-auto">
                        <i class="fa fa-search h4 text-body"></i>
                    </div>
                    <!--end of col-->
                    <div class="col">
                        <input class="form-control form-control-lg form-control-borderless" id="serial" name="serial" type="search" placeholder="Write your certificate serial number">
                    </div>
                    <!--end of col-->
                    <div class="col-auto">
                        <button class="btn btn-lg btn-success" id="searchCertificationBtn" type="submit">Search</button>
                    </div>
                </div>
            </div>
            <!--end of col-->
        </div>

        <div class="row justify-content-center my-5">
            <div class="col-md-8">
                <div class="jumbotron text-center">
                    <div id="res"></div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- End Contact Page Section -->
@endsection