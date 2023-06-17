@extends('layouts.app', [
    'active' => 'courses',
	'title' => $trainingCourse->name ,
    'breadcrumb' => [
        'Home' => 'index',
        'Training Courses' => 'training-courses',
        $trainingCourse->name => 'active'
    ],
    'scripts' => 'pages.training-course.show'
])

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="my-3 text-center">
                        @if(Auth::check())
                        <button class="btn btn-info">Join this training course</button>
                        @else
                        <button class="btn btn-info" data-toggle="modal" data-target="#joinEventForPublicUserModal">Join this training course</button>
                        @endif

                        <h5 class="my-3" id="demo"></h5>
                    </div>
                    
                    <table class="table">
                        <tr>
                            <td>Course Name</td>
                            <td>{{ $trainingCourse->name }}</td>
                        </tr>

                        @if(!Auth::check() || Auth::user()->course($trainingCourse->id) == null)
                        <tr>
                            <td>Price</td>
                            <td>${{ $trainingCourse->price }}</td>
                        </tr>
                        @endif

                        <tr>
                            <td>Duration</td>
                            <td>{{ $trainingCourse->duration }}</td>
                        </tr>

                        <tr>
                            <td>Language</td>
                            <td>{{ $trainingCourse->language }}</td>
                        </tr>

                        <tr>
                            <td>Date</td>
                            <td>{{ $trainingCourse->date }}</td>
                        </tr>

                        <tr>
                            <td>Start time</td>
                            <td>{{ date("h:i a", strtotime($trainingCourse->start_time)) }}</td>
                        </tr>

                        <tr>
                            <td>End time</td>
                            <td>{{ date("h:i a", strtotime($trainingCourse->end_time)) }}</td>
                        </tr>

                        <tr>
                            <td>Attened Users</td>
                            <td>{{ $trainingCourse->enrolledStudents->count() }}</td>
                        </tr>
                    </table>

                    @if($trainingCourse->map != null)
                    
                    <h4 class="my-3">Map</h4>

                    <div class="embed-responsive embed-responsive-16by9">
                        {!! $trainingCourse->map !!}
                    </div>
                    @endif
                </div>
            </div>
            
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4>{{ $trainingCourse->name }}</h4>

                    @if($trainingCourse->media_intro == 'image')
                    <img src="{{ asset('images/training-courses/'.$trainingCourse->id.'/'.$trainingCourse->image) }}" alt="">
                    @else
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $trainingCourse->video_url }}?rel=0" allowfullscreen></iframe>
                    </div>
                    @endif

                    <hr>
                    
                    <div id="accordion">
                        @for ($i = 0; $i < $trainingCourse->contents->count(); $i++)
                        <div class="card">
                            <div class="card-header" id="heading_{{$i}}">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_{{$i}}" aria-expanded="true" aria-controls="collapse_{{$i}}">
                                    {{ $trainingCourse->contents[$i]->title }}
                                    </button>
                                </h5>
                            </div>
                        
                            <div id="collapse_{{$i}}" class="collapse {{$i == 0 ? "show" : null }}" aria-labelledby="heading_{{$i}}" data-parent="#accordion">
                                <div class="card-body">
                                    {{ $trainingCourse->contents[$i]->description }}
                                </div>
                            </div>
                        </div>
                        @endfor
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="joinEventForPublicUserModal" tabindex="-1" role="dialog" aria-labelledby="joinEventForPublicUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="joinEventForPublicUserModalLabel">Join Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="joinEventForPublicUser">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="training_course_id" value="{{ $trainingCourse->id }}">

                    <div class="form-group row">
                        <div class="col-6">
                            <label for="name">Your Name</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="col-6">
                            <label for="email">Your Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Your Whatsapp Number</label>
                        <input type="text" class="form-control" name="phone" id="phone" pattern="[0-9]+" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Join</button>
                </div>
            </form>
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