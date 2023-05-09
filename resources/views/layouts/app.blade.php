<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    @include('includes.assets.styles')

    <title>
    @isset($title)
        {{ $title }}
    @else
        Your Profile
    @endisset
    </title>
  </head>
  <body class="vertical-layout vertical-content-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-content-menu" data-col="2-columns">

    <!-- fixed-top-->
    @include('includes.navs.navbar')

    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                @isset($breadcrumb)
                    <h3 class="content-header-title">
                        {{ isset($breadcrumb['title']) ? $breadcrumb['title'] : '' }}
                    </h3>
                    
                    @isset($breadcrumb['map'])
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                            @foreach($breadcrumb['map'] as $title => $route)
                                <li class="breadcrumb-item {{ $route == 'active' ? 'active' : ''}}">
                                    @if(is_array($route))
                                    {!! $route == 'active' ? $title : '<a href="'.route($route['route'], $route['slug']).'">'.$title.'</a>' !!}
                                    @else
                                    {!! $route == 'active' ? $title : '<a href="'.route($route).'">'.$title.'</a>' !!}
                                    @endif
                                </li>
                            @endforeach
                            </ol>
                        </div>
                    </div>
                    @endisset
                @endisset
                </div>
                @isset($header_right)
                <div class="content-header-right col-md-6 col-12">
                    <div class="media width-250 float-right">
                        <div class="media-body media-right text-right">
                        @if(isset($header_right['href']))
                            <a href="{{ isset($header_right['href']['route']) && is_array($header_right['href']['route']) ? route($header_right['href']['route']['route'], $header_right['href']['route']['slugs']) : route($header_right['href']['route']) }}" 
                               class="btn btn-{{ isset($header_right['href']['color']) ? $header_right['href']['color'] : 'success' }} {{ isset($header_right['href']['bold']) && $header_right['href']['bold'] == true ? 'font-weight-bold' : '' }}"
                            >
                                {{ isset($header_right['href']['text']) ? $header_right['href']['text'] : '' }}
                            </a>
                        @elseif(isset($header_right['btn']))
                            <button class="btn btn-{{ isset($header_right['btn']['color']) ? $header_right['btn']['color'] : '' }} text-{{ isset($header_right['btn']['text-color']) ? $header_right['btn']['text-color'] : '' }} {{ isset($header_right['btn']['bold']) && $header_right['btn']['bold'] == true ? 'font-weight-bold' : '' }}" {{ isset($header_right['btn']['id']) ? 'id='.$header_right['btn']['id'] : '' }} {{ isset($header_right['btn']['data']) ? 'data-'.key($header_right['btn']['data']).'='.reset($header_right['btn']['data']) : '' }}>{{ isset($header_right['btn']['text']) ? $header_right['btn']['text'] : '' }}</button>
                        @endif
                        </div>
                    </div>
                </div>
                @endisset
            </div>

            @include('includes.navs.sidebar')

            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    @include('includes.footer')

    @include('includes.assets.scripts')
  </body>
</html>