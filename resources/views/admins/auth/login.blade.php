<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>
        {{ env('APP_NAME') }} admin | {{ __('login') }}
    </title>
    {{-- <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/favicon.ico"> --}}
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/custom-rtl.css') }}">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/core/menu/menu-types/vertical-content-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/pages/login-register.css') }}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style-rtl.css') }}">
    <!-- END Custom CSS-->
  </head>
<body style="direction: ltr" class="vertical-layout vertical-content-menu 1-column  bg-full-screen-image menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-content-menu" data-col="1-column">
    
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row"></div>
            
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        {{-- <img src="../../../app-assets/images/logo/logo-dark.png" alt="branding logo"> --}}
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal" method="POST" action="{{ route('admins.login') }}" novalidate>
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left">
                                                {{-- <input type="text" class="form-control" id="user-name" placeholder="Your Username" required> --}}
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Your Email" required autocomplete="email" autofocus style="
                                                    padding-left: calc(2.75rem + 2px);
                                                    padding-right: 1rem;
                                                ">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                {{-- <input type="password" class="form-control" id="user-password" placeholder="Enter Password" required> --}}
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Your Password" name="password" required autocomplete="current-password" style="
                                                    padding-left: calc(2.75rem + 2px);
                                                    padding-right: 1rem;
                                                ">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <div class="form-control-position">
                                                    <i class="fa fa-key"></i>
                                                </div>
                                            </fieldset>
                                            <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i> Login</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/ui/headroom.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('app-assets/js/scripts/forms/form-login-register.js') }}"></script>
    <!-- END PAGE LEVEL JS-->
</body>
</html>