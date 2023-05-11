@extends('layouts.app', [
    'title' => $publicCertificate->certificate_name,
    'scripts' => 'pages.certificate.show',
])

@section('content')
<!-- Contact Page Section -->
<section class="contact-page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center" style="margin-top: 100px;margin-bottom:100px;">
                <canvas id="idCanvas" width="1123" height="794" ></canvas>
                <div class="form-group">
                    <button class="btn btn-success btn-sm" id="download">download</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Page Section -->
@endsection