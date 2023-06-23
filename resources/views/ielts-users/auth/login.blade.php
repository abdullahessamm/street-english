@extends('web.layouts.app')

@section('content')
<!-- Login Section -->
<section class="login-section ">
    <div class="auto-container">
        <div class="login-box">
            <!-- Title Box -->
            <div class="title-box">
                <h2>For IETLS Users</h2>
                <div class="text"><span class="theme_color">Welcome!</span> Please confirm that you are visiting</div>
            </div>
            
            <!-- Login Form -->
            <div class="styled-form">
                <form method="POST" action="{{ route('ieltsStudent.login') }}" novalidate>
                    @csrf
                    
                    <div class="form-group">
                        <input id="email" type="email" class="form-control form-control-prepended @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Your Email" required autocomplete="email" autofocus style="color: #18a674;font-weight: bold;">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" class="form-control form-control-prepended @error('password') is-invalid @enderror" name="password" placeholder="Your Password" required autocomplete="current-password" style="color: #18a674;font-weight: bold;">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="theme-btn btn-style-three"><span class="txt">Login <i class="fa fa-angle-right"></i></span></button>
                    </div>

                </form>
            </div>
            
        </div>
    </div>
</section>
<!-- End Login Section -->
@endsection
