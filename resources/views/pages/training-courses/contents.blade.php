@extends('layouts.app', [
    'title' => 'Training Course : '.$trainingCourse->name,
	'active' => 'training-courses',
    'breadcrumb' => [
        'title' => $trainingCourse->name,
        'map' => [
            'Dashboard' => 'home',
            'Training Courses' => 'training-courses',
            $trainingCourse->name => [
				'route' => 'training-course.show',
				'slug' => $trainingCourse->slug,
			],
			'Contents' => 'active'
        ]
    ],
	'header_right' => [
		'btn' => [
			'text' => 'Create new Content',
			'id' => 'openNewContentModalForm',
			'color' => 'info',
			'bold' => true,
		],
    ],
    'assets' => 'pages.training-courses.contents'
])

@section('content')
<!-- Update course section start -->
@if($trainingCourse->contents->count() > 0)
	@foreach($trainingCourse->contents as $content)
	<section id="striped-label-form-layouts">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title" id="striped-label-layout-basic">Content of : <b contenteditable="true" class="updateContentTitle" data-content-id="{{ $content->id }}" data-content-title="{{ $content->title }}">{{ $content->title }}</b></h4>
						<a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
						<div class="heading-elements">
							<ul class="list-inline mb-0">
								<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
								<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
								<li><a href="javascript:void(0);" class="deleteContent text-danger" data-content-id="{{ $content->id }}"><i class="ft-trash"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="card-content collapse show">
						<div class="card-body">
							<div class="form-group updateContentDescription" data-content-id="{{ $content->id }}" contenteditable="true">
								{{ $content->description }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@endforeach					
@else
	<section id="striped-label-form-layouts">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title" id="striped-label-layout-basic">Course : <b>{{ $trainingCourse->name }}</b> Content</h4>
						<a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
						<div class="heading-elements">
							<ul class="list-inline mb-0">
								<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="card-content collapse show">
						<div class="card-body">
							<div class="jumbotron text-center">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createNewContentModal">
									Create New Content
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endif
<!-- // Update course section end -->

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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
                <div id="res"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> Close Window </button>
            </div>
        </div>
    </div>
</div>

<!-- Create New Content Modal -->
<div class="modal fade" id="createNewContentModal" tabindex="-1" role="dialog" aria-labelledby="createNewContentModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="createNewContentModalLabel">Create New Content</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<form id="createNewContent">
			{{ csrf_field() }}
			<input type="hidden" name="training_course_id" value="{{ $trainingCourse->id }}">
			<div class="modal-body">
				<div class="form-group">
					<label for="content_name">Content Name</label>
					<input type="text" class="form-control" name="content_name" id="content_name" required>
				</div>
				
				<div class="form-group">
					<label for="description">Description</label>
					<textarea name="description" class="form-control" id="description" cols="30" rows="3" required></textarea>
				</div>
			</div>

			
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
		</form>
	</div>
	</div>
</div>

<!-- Delete Content Confirmation Modal -->
<div class="modal" id="deleteContentModal" tabindex="-1" role="dialog" aria-labelledby="deleteContentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
				<input type="hidden" id="confirmDeleteContentID">
				<h2>Are you sure you want to delete this content ?</h2>
				<h6><b class="text-warning">WARNING:</b> If you delete this content all the lesson will be removed</h6>
				<hr>
				<button type="button" class="btn btn-danger" id="confirmDeleteContent">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal">No</button>
            </div>
        </div>
    </div>
</div>
@endsection