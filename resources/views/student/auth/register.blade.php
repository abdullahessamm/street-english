@extends('layouts.app',[
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
                <form method="POST" action="{{ route('register') }}" novalidate>
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
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <input id="email" type="email" class="form-control form-control-prepended @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Your Email" required autocomplete="email" style="color: #18a674;font-weight: bold;">
            
                            @error('email')
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
                        
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 text-center">
                            <button type="submit" class="theme-btn btn-style-three"><span class="txt">Create my account <i class="fa fa-angle-right"></i></span></button>
                        </div>
                        
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="users">Already have an account? <a href="{{ route('login') }}">Sign In</a></div>
                        </div>
                        
                    </div>
                    
                </form>
            </div>
            
        </div>
    </div>
</section>
<!-- End Login Section -->
@endsection