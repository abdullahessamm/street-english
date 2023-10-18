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
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Video Column -->
                <div class="video-column col-lg-4 col-md-12 col-sm-12">
                    <div class="inner-column sticky-top">
                        @if($zoomCourse->video)
                            <iframe src="{{ $zoomCourse->video }}" allowfullscreen style="height: 15rem; width: 100%"></iframe>
                        @endif
                        <h3 class="my-3" style="color: #18a674;">{{ $zoomCourse->title }}</h3>

                        <table class="table table-borderless my-2">
                            <tbody class="text-left">
                                <tr>
                                    <td>
                                        <h6 class="text-left font-weight-bold" style="color: #1E284B;">Private fees</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="font-size: 13px">
                                        <span style="background-color: #18a674; color: #fff; border-radius: 5px" class="px-2 py-1">
                                            {{ $zoomCourse->private_price_per_level }} EGP / level
                                        </span>
                                    </td>
                                    @if($zoomCourse->has_offer_for_private)
                                    <td class="font-weight-bold" style="font-size: 13px">
                                        <span style="background-color: #18a674; color: #fff; border-radius: 5px" class="px-2 py-1">
                                            {{ $zoomCourse->private_offer_price }} EGP / {{ $zoomCourse->private_offer_levels }} levels
                                        </span>
                                    </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>
                                        <h6 class="text-left font-weight-bold" style="color: #1E284B;">Group fees</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="font-size: 13px">
                                        <span style="background-color: #18a674; color: #fff; border-radius: 5px" class="px-2 py-1">
                                            {{ $zoomCourse->group_price_per_level }} EGP / level
                                        </span>
                                    </td>
                                    @if($zoomCourse->has_offer_for_group)
                                        <td class="font-weight-bold" style="font-size: 13px">
                                        <span style="background-color: #18a674; color: #fff; border-radius: 5px" class="px-2 py-1">
                                            {{ $zoomCourse->group_offer_price }} EGP / {{ $zoomCourse->group_offer_levels }} levels
                                        </span>
                                        </td>
                                    @endif
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
