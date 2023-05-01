@extends('student.layouts.auth')

@section('content')
<a href="" class="btn btn-light btn-block mb-24pt">
    <h4>سجل دخولك كمحاضر</h4>
</a>


<form method="POST" action="{{ route('coach.login') }}" aria-label="{{ __('Login') }}">

    @csrf
    
    <div class="form-group " dir="rtl">
        <div class="input-group input-group-merge">
            <input id="email" type="email" class="form-control form-control-prepended @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="بريدك الالكتروني" required autocomplete="email" autofocus>

            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="far fa-envelope"></span>
                </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group ">
        <div class="input-group input-group-merge">
            <input id="password" type="password" class="form-control form-control-prepended @error('password') is-invalid @enderror" name="password" placeholder="كلمة السر" required autocomplete="current-password">
            
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fa fa-key"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-block btn-primary" type="submit">الدخول</button>
    </div>
    <div class="form-group text-center">
        <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="custom-control-label" for="remember">تذكرني</label>
        </div>
    </div>
    
</form>
@endsection