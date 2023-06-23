@extends('web.layouts.app',[
    'title' => 'Create New Account'
])

@section('content')
<!-- Register Section -->
<section class="register-section">
    <div class="auto-container">
        <div class="register-box">
            
            <!-- Title Box -->
            <div class="title-box">
                <h2>Register</h2>
                <div class="text"><span class="theme_color">Welcome!</span> Please confirm that you are visiting</div>
            </div>
            
            <!-- Login Form -->
            <div class="styled-form">
                <form method="POST" action="{{ route('recordedStudent.register') }}" novalidate>
                    @csrf
                    
                    <div class="row clearfix">
                        
                        <!-- Form Group -->
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <input id="name" type="text" class="form-control form-control-prepended @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Your Name" required autocomplete="name" autofocus style="color: #18a674;font-weight: bold;">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <!-- Form Group -->
                        <div class="form-group col-lg-6 col-12">
                            <input id="email" type="email" class="form-control form-control-prepended @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Your Email" required autocomplete="email" style="color: #18a674;font-weight: bold;">
            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Form Group -->
                        <div class="form-group col-lg-6 col-12">
                            <input id="phone" type="text" class="form-control form-control-prepended @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Your phone (optional)" required autocomplete="phone" style="color: #18a674;font-weight: bold;">
            
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <!-- Form Group -->
                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                            <input id="password" type="password" class="form-control form-control-prepended @error('password') is-invalid @enderror" name="password" placeholder="Your Password" required autocomplete="new-password" style="color: #18a674;font-weight: bold;">
            
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <!-- Form Group -->
                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" style="color: #18a674;font-weight: bold;">
            
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 text-center p-0 m-0">
                            <button type="submit" class="theme-btn btn-style-three"><span class="txt">Create my account <i class="fa fa-angle-right"></i></span></button>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>

                        <div class="form-group text-center mt-2 col-12">
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
                                "> Register with google </span>
                            </a>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="users">Already have an account? <a href="{{ route('recordedStudent.login') }}">Sign In</a></div>
                        </div>
                        
                    </div>
                    
                </form>
            </div>
            
        </div>
    </div>
</section>
<!-- End Login Section -->
@endsection