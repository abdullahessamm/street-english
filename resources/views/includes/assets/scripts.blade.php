<!-- BEGIN VENDOR JS-->
<script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{ asset('app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/ui/headroom.min.js') }}"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN ROBUST JS-->
<script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('app-assets/js/core/app.js') }}"></script>
<!-- END ROBUST JS-->
<!-- BEGIN PAGE LEVEL JS-->

@if(isset($assets))
    @include('includes.assets.scripts.'.$assets)
@endif

@if(isset($scripts))
    @include('includes.assets.scripts.'.$scripts)
@endif
<!-- END PAGE LEVEL JS-->