@extends('layouts.app', [
    'title' => config('app.links.courses.training-courses.page'),
    'breadcrumb' => [
        'Home' => 'index',
        'Training Courses' => 'active',
    ]
])

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="row">
            @if($trainingCourses->count() > 0)
                @foreach ($trainingCourses as $trainingCourse)
                @if($trainingCourse->contents->count() > 0)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('training-course.show', $trainingCourse->slug) }}">{{ $trainingCourse->name }}</a>
                        </div>
                        <div class="card-body p-0 m-0">
                            <img src="{{ asset('images/training-courses/'.$trainingCourse->id.'/'.$trainingCourse->thumbnail) }}" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            @else
                <div class="col-md-12">
                    <div class="jumbotron text-center">
                        <h1>No Training Courses found</h1>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection