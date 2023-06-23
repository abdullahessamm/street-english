@extends('web.layouts.app', [
    'title' => config('app.name')
])

@section('content')

<style>
    a.dashboard-btn:hover {
        color: #18a674 !important;
    }
</style>

<section class="contact-page-section">
    <div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-1.png)"></div>
    <div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-2.png)"></div>
    <div class="auto-container mt-5">
        <div class="container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <h3 style="color: #18a674;"> {{
                    $verified ? ('Your email has been verified!') : (
                        $errMsg ?? 'Error during verification, please try again!'
                    )
                }} </h3>
            </div>

            @if ($verified)
                <div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
                    <a class="theme-btn btn-style-three text-white dashboard-btn" href="{{ $redirect ?? '/recorded/login' }}"><span class="txt">Go to dashboard <i class="fa fa-angle-right"></i></span></a>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
