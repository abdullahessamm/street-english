<script src="{{ asset('public/assets/js/jquery.js') }}"></script>
<script src="{{ asset('public/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.scrollTo.js') }}"></script>
<script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('public/assets/js/appear.js') }}"></script>
<script src="{{ asset('public/assets/js/swiper.min.js') }}"></script>
<script src="{{ asset('public/assets/js/element-in-view.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.paroller.min.js') }}"></script>
<script src="{{ asset('public/assets/js/parallax.min.js') }}"></script>
<script src="{{ asset('public/assets/js/tilt.jquery.min.js') }}"></script>
<script src="{{ asset('public/assets/js/validate.js') }}"></script>
<!--Master Slider-->
<script src="{{ asset('public/assets/js/jquery.easing.min.js') }}"></script>
<script src="{{ asset('public/assets/js/owl.js') }}"></script>
<script src="{{ asset('public/assets/js/wow.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery-ui.js') }}"></script>
<script src="{{ asset('public/assets/js/script.js') }}"></script>

@isset($scripts)
    @include('web.includes.assets.scripts.'.$scripts)
@endisset

@isset($assets)
    @include('web.includes.assets.scripts.'.$assets)
@endisset

@yield('scripts');

<script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "1066319133437946");
    chatbox.setAttribute("attribution", "biz_inbox");

    window.fbAsyncInit = function() {
      FB.init({
        xfbml            : true,
        version          : 'v12.0'
      });
    };

    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>