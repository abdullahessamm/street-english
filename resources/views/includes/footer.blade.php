<footer class="footer footer-static footer-light navbar-border">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
        <span class="float-md-left d-block d-md-inline-block">
            Copyright  &copy; {{ date('Y') }} 
            <a class="text-bold-800 grey darken-2" href="{{ config('app.main_url') }}" target="_blank">
                {{ str_replace('_', ' ', config('app.name')) }}
            </a>
            , All rights reserved. 
        </span>
        <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">
            This website developed by <a href="https://eastmagic.net" target="_blank">East Magic</a>
            <i class="ft-heart pink"></i>
        </span>
    </p>
</footer>