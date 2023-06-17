@extends('layouts.app', [
    'active' => 'courses',
	'title' => 'Training Course Not Found',
    'breadcrumb' => [
        'Home' => 'index',
        'Training Courses' => 'training-courses',
    ],
])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron text-center">
                <h2>The Training Course that you are looking for is may be removed or not found</h2> 
            </div>
        </div>
    </div>
</div>
@endsection