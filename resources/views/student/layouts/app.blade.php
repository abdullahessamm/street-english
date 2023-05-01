<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
    @isset($title)
        {{ $title }}
    @else
        صفحتي الشخصية
    @endisset
    </title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    @include('student.includes.assets.styles')
</head>

<body class="layout-sticky-subnav layout-learnly ">

    <div class="preloader">
        <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>

        <!-- More spinner examples at https://github.com/tobiasahlin/SpinKit/blob/master/examples.html -->
    </div>

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">

        <!-- Header -->
        @include('student.includes.navs.navbar')
        <!-- // END Header -->

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content ">
            <div class="page-section bg-alt border-bottom-2">
                <div class="container page__container">
            
                    <div class="d-flex flex-column flex-lg-row align-items-center">
                        <div class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                            <h1 class="h2 mb-8pt">
                            @if(isset($title))
                                {{ $title }}
                            @else
                                صفحتي الشخصية
                            @endif
                            </h1>
                        </div>
                    </div>
            
                </div>
            </div>

            @yield('content')
        </div>
        <!-- // END Header Layout Content -->

        <!-- Footer -->
        @include('student.includes.footer')
        <!-- // END Footer -->

    </div>
    <!-- // END Header Layout -->

    <!-- Drawer -->
    @include('student.includes.navs.sidebar')
    <!-- // END Drawer -->

    @include('student.includes.assets.scripts')
</body>

</html>