@extends('layouts.app', [
    'title' => $bundle->name,
])

@section('content')

<!-- Intro Courses -->
<section class="intro-section">
    <div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url({{ asset('public/assets/images/icons/icon-1.png') }})"></div>
    <div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url({{ asset('public/assets/images/icons/icon-2.png') }})"></div>
    <div class="circle-one"></div>
    <div class="auto-container">
        <div class="sec-title">
            <h2>{{ $bundle->name }}</h2>
        </div>
        
        <div class="inner-container">
            <div class="row clearfix">
                
                <!-- Content Column -->
                <div class="content-column col-lg-8 col-md-12 col-sm-12">
                    <div class="inner-column">
						<div class="row clearfix">
							@foreach($bundle->bundleCourses as $eachBundleCourse)
								<!-- Cource Block Two -->
								<div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
									<div class="inner-box">
										<div class="image">
											<a href="{{ route('course.show', $eachBundleCourse->belongsToCourse->slug) }}"><img src="{{ asset('public/images/courses/'.$eachBundleCourse->belongsToCourse->id.'/'.$eachBundleCourse->belongsToCourse->thumbnail) }}" style="width: 270px;height: 150px;" alt="" /></a>
										</div>
										<div class="lower-content">
											<h5><a href="{{ route('course.show', $eachBundleCourse->belongsToCourse->slug) }}">{{ $eachBundleCourse->belongsToCourse->name }}</a></h5>
											{{-- <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div> --}}
											<div class="clearfix">
												<div class="pull-left">
													<div class="students">{{  $eachBundleCourse->belongsToCourse->lessons->count() }} {{  $eachBundleCourse->belongsToCourse->lessons->count() == 1 ? 'lesson' : 'lessons' }}</div>
												</div>
												<div class="pull-right">
                                                    @if(Auth::check() && Auth::user()->course($bundle->id) != null)
													<div class="hours">{{ $eachBundleCourse->belongsToCourse->price }} EGP</div>
                                                    @endif
												</div>
											</div>
										</div>
									</div>
								</div>
							@endforeach
						</div>
                    </div>
                </div>
                
                <!-- Video Column -->
                <div class="video-column col-lg-4 col-md-12 col-sm-12">
                    <div class="inner-column sticky-top">
                        
						<img src="{{ asset('public/images/bundles/'.$bundle->id.'/'.$bundle->thumbnail) }}" class="img-fluid" alt="">
                        
                        @if(Auth::check() && App\Models\Students\Student::where('id', Auth::user()->id)->first()->bundle != null)
                            @php
                                $myBundle = App\Models\Students\Student::where('id', Auth::user()->id)->first()->bundle;
                            @endphp
							<a  href="{{ route('student.my-bundle.show', $myBundle->slug) }}" class="theme-btn btn-style-three mt-3"><span class="txt">Browse this bundle</span></a>
						@elseif(Auth::check() && App\Models\Students\Student::where('id', Auth::user()->id)->first()->id))
							<div class="price mb-3">{{$bundle->price}} EGP</div>
							{{-- <div class="time-left">23 hours left at this price!</div> --}}
							<a href="javascript:void(0);" class="theme-btn btn-style-two" data-toggle="modal" data-target="#buyCourseModal"><span class="txt">Buy Now <i class="fa fa-angle-right"></i></span></a>
						@else
							<div class="price mb-3">{{$bundle->price}} EGP</div>
							{{-- <div class="time-left">23 hours left at this price!</div> --}}
							<a href="javascript:void(0);" class="theme-btn btn-style-two" data-toggle="modal" data-target="#loginToBuyCourseModal"><span class="txt">Buy Now <i class="fa fa-angle-right"></i></span></a>
						@endif
                    </div>
                </div>
                
            </div>
        </div>
    
    </div>
</section>
<!-- End intro Courses -->

<!-- Login to Buy Course Modal -->
<div class="modal fade" id="loginToBuyCourseModal" tabindex="-1" role="dialog" aria-labelledby="loginToBuyCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginToBuyCourseModalLabel">Buy  - {{ $bundle->name }}</h5>
                <div class="float-right">
                    <h5><span class="font-weight-bold text-success">${{ $bundle->price }}</span></h5>
                </div>
            </div>
            <form id="loginToBuyCourse">
                {{ csrf_field() }}
                
                <input type="hidden" name="online_course_id" value="{{ $bundle->id }}">
                <div class="modal-body">
                    <div class="my-3 text-center">
                        <h5>You need to login first</h5>
                        <small>Don't have an account don't worry <a href="{{ route('register') }}">Click here to create new account</a></small>
                    </div>

                    <div class="form-group">
                        <div class="input-group input-group-merge">
                            <input id="email" type="email" class="form-control form-control-prepended @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Your Email" required autocomplete="email" autofocus>
                
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fa fa-envelope"></span>
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
                            <input id="password" type="password" class="form-control form-control-prepended @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                            
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Buy Course Modal -->
@if(Auth::check())
<div class="modal fade" id="buyCourseModal" tabindex="-1" role="dialog" aria-labelledby="buyCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buyCourseModalLabel">Buy  - {{ $bundle->name }}</h5>
                <div class="float-right">
                    <h5><span class="font-weight-bold text-success">${{ $bundle->price }}</span></h5>
                </div>
            </div>
            <form id="buyBundle">
                {{ csrf_field() }}
                <input type="hidden" name="bundle_id" value="{{ $bundle->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="modal-body">
                    <div class="jumbotron text-center">
                        <h3>By clicking <small class="bg-success text-light p-2 font-weight-bold">Buy - ${{$bundle->price}}</small> you will have this course in your dashboard</h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Buy - ${{$bundle->price}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<!-- Preview Lesson Modal -->
<div class="modal fade" id="previewLessonModal" tabindex="-1" role="dialog" aria-labelledby="previewLessonModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="preview_lessons_res"></div>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div class="modal" id="loading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body">
                <div class="progress text-right">
                    <div id="progressbar" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Result Modal -->
<div class="modal" id="resModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
                <div id="res"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body">
                {!! errorMsg('حدث خطاء ما') !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){

    $("#loginToBuyCourse").on('submit', function(e){
        e.preventDefault();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        $("#loginToBuyCourseModal").modal('hide');

                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.course.login-to-buy-course') }}",
            type :'POST',
            data : new FormData(this),
            contentType : false,
            processData : false,
            cache : false,
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#loading").modal('hide');
                $("#error").modal({backdrop: 'static', keyboard: false});
                $("#error").modal('show');
            }
        });
    });

    $("#buyBundle").on('submit', function(e){
        e.preventDefault();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        $("#buyCourseModal").modal('hide');

                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.course.buy-bundle') }}",
            type :'POST',
            data : new FormData(this),
            contentType : false,
            processData : false,
            cache : false,
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#loading").modal('hide');
                $("#error").modal({backdrop: 'static', keyboard: false});
                $("#error").modal('show');
            }
        });
    });
});
</script>
@endsection