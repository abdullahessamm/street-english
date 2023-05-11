<!-- jQuery -->
<script src="{{ asset('public/assets/dashboard/vendor/jquery.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('public/assets/dashboard/vendor/popper.min.js') }}"></script>
<script src="{{ asset('public/assets/dashboard/vendor/bootstrap.min.js') }}"></script>

<!-- Perfect Scrollbar -->
<script src="{{ asset('public/assets/dashboard/vendor/perfect-scrollbar.min.js') }}"></script>

<!-- DOM Factory -->
<script src="{{ asset('public/assets/dashboard/vendor/dom-factory.js') }}"></script>

<!-- MDK -->
<script src="{{ asset('public/assets/dashboard/vendor/material-design-kit.js') }}"></script>

<!-- App JS -->
<script src="{{ asset('public/assets/dashboard/js/app.js') }}"></script>

<!-- Preloader -->
<script src="{{ asset('public/assets/dashboard/js/preloader.js') }}"></script>

<!-- Global Settings -->
<script src="{{ asset('public/assets/dashboard/js/settings.js') }}"></script>

<!-- Moment.js -->
<script src="{{ asset('public/assets/dashboard/vendor/moment.min.js') }}"></script>
<script src="{{ asset('public/assets/dashboard/vendor/moment-range.js') }}"></script>

@isset($scripts)
    @include('coach.includes.assets.scripts.'.$scripts)
@endisset

@isset($assets)
    @include('coach.includes.assets.scripts.'.$assets)
@endisset