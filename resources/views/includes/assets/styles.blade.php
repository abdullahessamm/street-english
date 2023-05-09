{{-- <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CMuli:300,400,500,700" rel="stylesheet"> --}}

<!-- BEGIN VENDOR CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/vendors.css') }}">
<!-- END VENDOR CSS-->
<!-- BEGIN ROBUST CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/app.css') }}">
<!-- END ROBUST CSS-->
<!-- BEGIN Page Level CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/core/menu/menu-types/vertical-content-menu.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/core/colors/palette-gradient.css') }}">
<!-- END Page Level CSS-->
<!-- BEGIN Custom CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style-rtl.css') }}">
@if(isset($assets))
    @include('includes.assets.styles.'.$assets)
@endif

@if(isset($styles))
    @include('includes.assets.styles.'.$styles)
@endif
<!-- END Custom CSS-->