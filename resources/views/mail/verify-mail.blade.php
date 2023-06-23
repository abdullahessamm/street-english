@extends('mail.layout')

@section('content')
<div style="font-size: 18px; color: #1E284B">
    Hi, <b>{{ $user->name }}</b> <br>
    Welcome to <b>Street English</b> family, <br>
    To keep your account safe you must verify your Email address. <br> <br>
    Note: This verification button is valid until 2 hours from now.
    <div style="text-align: center; margin-top: 20px; color: #1E284B">
        <a href="{{ $redirect }}" style="
            display: inline-block;
            padding: 7px 30px;
            background-color: #1da877;
            color: #fff;
            text-decoration: none;
            border-radius: 50px
        ">Verify Email</a>
    </div>
</div>
@endsection
