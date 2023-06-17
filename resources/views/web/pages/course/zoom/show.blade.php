@extends('web.layouts.app', [
	'title' => $zoomCourse->title,
])

@section('content')
<!-- Intro Courses -->
<section class="intro-section">
    <div class="auto-container mt-5">
        <div class="sec-title">
            <h2>{{ $zoomCourse->title }}</h2>
        </div>
        
        <div class="inner-container">
            <div class="row clearfix">
                
                <!-- Content Column -->
                <div class="content-column col-lg-8 col-md-12 col-sm-12">
                    <div class="inner-column">
                        
                        <!-- Intro Info Tabs-->
                        <div class="intro-info-tabs">
                            <!-- Intro Tabs-->
                            <div class="intro-tabs tabs-box">
                            
                                <!--Tab Btns-->
                                <ul class="tab-btns tab-buttons clearfix">
                                    <li data-tab="#prod-overview" class="tab-btn active-btn">Overview</li>
                                    <li data-tab="#prod-levels" class="tab-btn">Levels</li>
                                </ul>
                                
                                <!--Tabs Container-->
                                <div class="tabs-content">
                                    <!--Tab / Active Tab-->
                                    <div class="tab active-tab" id="prod-overview">
                                        <div class="content">
                                            <!-- Cource Overview -->
                                            <div class="course-overview">
                                                <div class="inner-box">
                                                    {!! $zoomCourse->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Tab -->
                                    <div class="tab" id="prod-levels">
                                        <div class="content">
                                            <!-- Accordion Box -->
                                            <ul class="accordion-box">
                                            @for ($i = 0; $i < $zoomCourse->levels->count(); $i++)
                                                <!-- Block -->
                                                <li class="accordion block">
                                                    <div class="acc-btn {{ $i == 0 ? 'active' : null }}">
                                                        <div class="icon-outer">
                                                            <span class="icon icon-plus flaticon-angle-arrow-down"></span>
                                                        </div> 
                                                        {{ $zoomCourse->levels[$i]->title }}
                                                    </div>
                                                    <div class="acc-content {{ $i == 0 ? 'current' : null }}">
                                                        @foreach($zoomCourse->levels[$i]->sessions as $eachSession)
                                                        <div class="content">
                                                            <div class="clearfix">
                                                                <div class="pull-left">
                                                                    <h6>{{ $eachSession->title }}</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        {{-- <div class="content">
                                                            <div class="clearfix">
                                                                <div class="pull-left">
                                                                    <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="lightbox-image play-icon"><span class="fa fa-play"><i class="ripple"></i></span>What is UI/ UX Design?</a>
                                                                </div>
                                                                <div class="pull-right">
                                                                    <div class="minutes">35 Minutes</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="content">
                                                            <div class="clearfix">
                                                                <div class="pull-left">
                                                                    <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="lightbox-image play-icon"><span class="fa fa-play"></span>What is UI/ UX Design?</a>
                                                                </div>
                                                                <div class="pull-right">
                                                                    <div class="minutes">35 Minutes</div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </li>
                                            @endfor
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <!-- Video Column -->
                <div class="video-column col-lg-4 col-md-12 col-sm-12">
                    <div class="inner-column sticky-top">
                        <img src="{{ asset('public/images/zoom-courses/'.$zoomCourse->id.'/'.$zoomCourse->image) }}" class="img-fluid" alt="">
                        <h3 class="my-3" style="color: #18a674;">{{ $zoomCourse->title }}</h3>
                        
                        <h5 class="text-left font-weight-bold px-3" style="color: #1E284B;">Fees Per Level</h5>
                        <table class="table table-borderless my-2">
                            <tbody class="text-left">
                                <tr>
                                    <td style="color: #18a674;" class="font-weight-bold">Private Per Level</td>
                                    <td style="color: #1E284B;" class="font-weight-bold">{{ $zoomCourse->private_price }} EGP</td>
                                </tr>
                                <tr>
                                    <td style="color: #18a674;" class="font-weight-bold">Group Per Level</td>
                                    <td style="color: #1E284B;" class="font-weight-bold">{{ $zoomCourse->group_price }} EGP</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                
            </div>
        </div>
    
    </div>
</section>
<!-- End intro Courses -->
@endsection