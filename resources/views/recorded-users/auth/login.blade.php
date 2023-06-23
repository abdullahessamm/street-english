@extends('web.layouts.app',[
    'title' => 'Login'
])

@section('content')
<!-- Login Section -->
<section class="login-section ">
    <div class="auto-container">
        <div class="login-box">
            <!-- Title Box -->
            <div class="title-box">
                <h2>Login</h2>
                <div class="text"><span class="theme_color">Welcome!</span> Please confirm that you are visiting</div>
            </div>
            
            <!-- Login Form -->
            <div class="styled-form">
                <form method="POST" action="{{ route('recordedStudent.login') }}" novalidate>
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

                    <div class="form-group text-center m-0">
                        <button type="submit" class="theme-btn btn-style-three"><span class="txt">Login <i class="fa fa-angle-right"></i></span></button>
                    </div>
                    <hr>

                    <div class="form-group text-center mt-4">
                        <a href="{{ route('recordedStudent.loginWithGoogle') }}" class="google-login-btn" style="
                            display: inline-flex;
                            justify-content: center;
                            align-items: center;
                            box-shadow: 0px 1px 7px #bbb;
                            padding: 10px 37px;
                            border-radius: 50px;   
                        ">
                            <img src="{{ asset('public/google-icon.png') }}" alt="google logo" style="
                                width: 25px;
                                margin-right: 15px;
                            ">
                            <span class="text-container text-center" style="
                                color: #444;
                                font-size: 15px;
                            "> Login with google </span>
                        </a>
                    </div>
                    <div class="form-group">
                        <div class="users">New User? <a href="{{ route('recordedStudent.register') }}">Sign Up</a></div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</section>
<!-- End Login Section -->
@endsection