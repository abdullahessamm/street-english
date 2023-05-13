@extends('layouts.app', [
    'title' => 'المحتويات الخاصة بدورة : '.$course->name,
	'active' => 'courses',
    'breadcrumb' => [
        'title' => $course->name,
        'map' => [
            'Online Courses' => 'courses',
			'الرئيسية' => 'home',
            'الدورات التدريبية' => 'courses',
            $course->name => [
				'route' => 'course.show',
				'slug' => $course->slug,
			],
			'المحتويات الخاصة بدورة : '.$course->name => 'active'
        ]
    ],
	'header_right' => [
		'btn' => [
			'text' => 'انشاء محتوي جديد',
			'id' => 'openNewContentModalForm',
			'color' => 'info',
			'bold' => true,
		],
    ],
    'assets' => 'pages.ietls-courses.contents'
])

@section('content')
<!-- Update course section start -->
@if($course->contents->count() > 0)
	@foreach($course->contents as $content)
	<section id="striped-label-form-layouts">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title" id="striped-label-layout-basic">عنوان المحتوي : <b contenteditable="true" class="updateContentTitle" data-content-id="{{ $content->id }}" data-content-title="{{ $content->title }}">{{ $content->title }}</b></h4>
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
							<form class="addNewLessons">
								{{ csrf_field() }}
								<input type="hidden" name="content_id" value="{{ $content->id }}">

								<div class="form-group updateContentDescription" data-content-id="{{ $content->id }}" contenteditable="true">
									{{ $content->description }}
								</div>

								<hr>

								<div class="repeater-default">
									<div data-repeater-list="lessons">
										<div data-repeater-item>
											<div class="form-group row">
												<div class="col-8">
													<label for="lesson_title">عنوان الدرس</label>
													<input type="text" class="form-control" name="lesson_title" id="lesson_title" required>
												</div>
												<div class="col-4">
													<button type="button" class="btn btn-danger mt-2" data-repeater-delete> <i class="ft-x"></i> Delete</button>
												</div>
											</div>
										</div>
									</div>

									<div class="form-group overflow-hidden">
										<div class="col-12">
											<button type="button" data-repeater-create class="btn btn-primary">
												<i class="ft-plus"></i> اضافة درس
											</button>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-success">انشاء الدروس</button>
								</div>
							</form>

							@if($content->lessons->count() > 0)
							<table class="table my-3">
								<thead>
									<tr class="text-center">
										<th>عنوان الدرس</th>
										<th>هل تم نشر الدرس</th>
										<th>نوع الدرس</th>
										{{-- <th>هل الدرس خاص</th> --}}
									</tr>
								</thead>
								<tbody>
								@foreach($content->lessons as $lesson)
									<tr>
										<td>
											<a href="{{ route('ietls-course.content.lesson', [$course->slug, $content->slug, $lesson->slug]) }}">{{ $lesson->title }}</a>
										</td>
										<td class="text-center">{!! isset($lesson->info) && $lesson->info->isPublished == 1 ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>' !!}</td>
										<td class="text-center">
										@switch($lesson->type)
											@case('video')
												<p class="font-weight-bold">فيديو</p>
											@break

											@case('audio')
												<p class="font-weight-bold">مقطع صوتي</p>
											@break

											@case('doc')
												<p class="font-weight-bold">ملف pdf</p>
											@break

											@case('context')
												<p class="font-weight-bold">محتوي كتابي</p>
											@break

											@case('frame')
												<p class="font-weight-bold">اطار</p>
											@break

											@case('exercise')
												<p class="font-weight-bold">أسئلة تدريبية</p>
											@break

											@default
												<p class="font-weight-bold text-danger">لم يتم التحديد بعد</p>
											@break
										@endswitch
										</td>
										{{-- <td class="text-center">{!! isset($lesson->info) && $lesson->info->isLocked == 1 ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>' !!}</td> --}}
									</tr>
								@endforeach
								</tbody>
							</table>
							@endif
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
						<h4 class="card-title" id="striped-label-layout-basic">المحتويات الخاصة بدورة : <b>{{ $course->name }}</b></h4>
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
									انشاء محتوي للدورة
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
				<i class="fa fa-times text-danger" style="font-size: 100px;"></i>
				<h3>Error Occured</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>

<!-- Create New Content Modal -->
<div class="modal fade" id="createNewContentModal" tabindex="-1" role="dialog" aria-labelledby="createNewContentModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="createNewContentModalLabel">انشاء محتوي جديد</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<form id="createNewContent">
			{{ csrf_field() }}
			<input type="hidden" name="ietls_course_id" value="{{ $course->id }}">
			<div class="modal-body">
				<div class="form-group">
					<label for="content_name">اسم المحتوي</label>
					<input type="text" class="form-control" name="content_name" id="content_name" required>
				</div>
				
				<div class="form-group">
					<label for="description">شرح المحتوي</label>
					<textarea name="description" class="form-control" id="description" cols="30" rows="3"></textarea>
				</div>
			</div>

			
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
				<button type="submit" class="btn btn-primary">انشاء</button>
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
				<h2>هل أنت متأكد أنك تريد حذف هذا المحتوى ؟</h2>
				<h6><b class="text-warning">تحذير:</b> إذا قمت بحذف هذا المحتوى ستتم إزالة كل الدروس</h6>
				<hr>
				<button type="button" class="btn btn-danger" id="confirmDeleteContent">نعم</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal">لا</button>
            </div>
        </div>
    </div>
</div>
@endsection