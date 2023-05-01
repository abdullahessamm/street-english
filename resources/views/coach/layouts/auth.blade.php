<!DOCTYPE html>
<html lang="ar" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>
    @isset($title)
    @else
        {{ config('app.name') }}
    @endisset
    </title>
    
    @include('student.includes.assets.styles')
</head>
<body class="layout-default layout-login-centered-boxed">

    <div class="layout-login-centered-boxed__form card">
        <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-5 navbar-light">
            <a href="{{ route('index') }}" class="navbar-brand flex-column mb-2 align-items-center mr-0" style="min-width: 0">
                <span class="avatar avatar-sm navbar-brand-icon mr-0">
                    {{-- <span class="avatar-title rounded bg-primary"><img src="{{ asset('assets/dashboard/images/illustration/student/128/white.svg') }}" alt="logo" class="img-fluid" /></span> --}}
                </span>
                {{ config('app.name') }}
            </a>
        </div>

        <main dir="rtl">
            @yield('content')
        </main>
    </div>

    @include('student.includes.assets.scripts')
</body>
</html>