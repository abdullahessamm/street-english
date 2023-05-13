@extends('layouts.app', [
    'title' => 'المحتويات الخاصة بدورة : '.$lesson->title,
	'active' => 'ietls-courses',
    'breadcrumb' => [
        'title' => $lesson->title,
        'map' => [
			'الرئيسية' => 'home',
            'الدورات التدريبية' => 'courses',
			$lesson->belongsToContent->belongsToCourse->name => [
				'route' => 'ietls-course.show',
				'slug' => $lesson->belongsToContent->belongsToCourse->slug,
			],
            'محتويات الدورة' => [
				'route' => 'ietls-course.contents',
				'slug' => $lesson->belongsToContent->belongsToCourse->slug,
			],
			$lesson->title => 'active'
        ]
    ],
	'header_right' => [
		'btn' => [
			'text' => 'مسح الدرس',
			'id' => 'openDeleteLessonModalForm',
			'color' => 'danger',
			'bold' => true,
			'data' => [
				'lesson-id' => $lesson->id
			]
		],
    ],
    'assets' => 'pages.courses.lesson'
])

@section('content')
<section id="striped-label-form-layouts">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-content collapse show">
					<div class="card-body">
						<form class="form form-horizontal striped-labels form-bordered">
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="fa fa-cogs"></i> الاعدادات الخاصة بدرس : <b>{{ $lesson->title }}</b></h4>
								
								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="lesson_type">نوع الدرس</label>
									@if($lesson->type == null)
		                            <div class="col-md-7">
										<select name="lesson_type" class="form-control" id="lesson_type">
											<option value="video">فيديو</option>
											<option value="doc">ملف</option>
											<option value="frame">إطار</option>
											<option value="exercise">اسئلة تدريبية</option>
										</select>
		                            </div>
									<div class="col-2">
										<button type="button" class="btn btn-primary" id="createLessonType" data-lesson-id="{{ $lesson->id }}">حفظ</button>
									</div>
									@else
		                            <div class="col-md-9">
										@switch($lesson->type)
											@case('video')
												<input type="text" class="form-control" value="فيديو"  disabled>
											@break
										
											@case('doc')
												<input type="text" class="form-control" value="ملف"  disabled>
											@break

											@case('frame')
												<input type="text" class="form-control" value="إطار"  disabled>
											@break

											@case('exercise')
												<input type="text" class="form-control" value="اسئلة تدريبية"  disabled>
											@break
										@endswitch
									</div>
									@endif
		                        </div>

								@if($lesson->type != null)
								{{-- <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="isLocked">اخفاء الدرس عن العامة</label>
		                            <div class="col-md-9">
										<input type="checkbox" id="isLocked" class="switchery isLocked" data-lesson-id="{{ $lesson->id }}" {{ $lesson->info->isLocked == 1 ? 'checked' : '' }}/>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="isContinueable">هل يمكن متابعة الدرس القادم</label>
		                            <div class="col-md-9">
										<input type="checkbox" id="isContinueable" class="switchery isContinueable" data-lesson-id="{{ $lesson->id }}" {{ $lesson->info->isContinueable == 1 ? 'checked' : '' }}/>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="isAchievable">هل يوجد مكافاءة</label>
		                            <div class="col-md-9">
										<input type="checkbox" id="isAchievable" class="switchery isAchievable" data-lesson-id="{{ $lesson->id }}" {{ $lesson->info->isAchievable == 1 ? 'checked' : '' }}/>
		                            </div>
		                        </div> --}}

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="isPublished">نشر الدرس</label>
		                            <div class="col-md-9">
										<input type="checkbox" id="isPublished" class="switchery isPublished" data-lesson-info-id="{{ $lesson->info->id }}" {{ $lesson->info->isPublished == 1 ? 'checked' : '' }}/>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="isPublished">اختر محاضر لهذا الدرس</label>
		                            <div class="col-md-9">
										@foreach ($instructors as $eachInstructor)
										<div class="form-check">
											<input class="form-check-input chooseInstructor" data-lesson-id="{{ $lesson->id }}" data-instructor-id="{{ $eachInstructor->coach_id }}" type="radio" name="instructor" id="{{ $eachInstructor->id }}" {{ isset($lesson->instructor->coach_id) && $eachInstructor->coach_id == $lesson->instructor->coach_id ? 'checked' : null }}>
											<label class="form-check-label" for="{{ $eachInstructor->id }}">
												{{ $eachInstructor->belongsToInstructor->name }}
											</label>
										</div>
										@endforeach
		                            </div>
		                        </div>

								@if($lesson->type != 'frame')
								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="lesson_description">شرح الدرس</label>
		                            <div class="col-md-7">
										<textarea name="lesson_description" class="form-control" id="lesson_description" cols="30" rows="10">{{$lesson->description}}</textarea>
		                            </div>
									<div class="col-md-2">
										<button type="button" class="btn btn-primary" id="updateLessonDescription" data-lesson-id="{{ $lesson->id }}">تحديث شرح الدرس</button>
									</div>
		                        </div>
								@endif
								@endif
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section> 

@switch($lesson->type)
	@case('video')
		@include('pages.courses.lesson-type.video',[
			'lesson' => $lesson
		])
	@break
		
	@case('audio')
		@include('pages.courses.lesson-type.audio',[
			'lesson' => $lesson
		])
	@break

	@case('doc')
		@include('pages.courses.lesson-type.pdf',[
			'lesson' => $lesson
		])
	@break
	
	@break

	@case('frame')
		@include('pages.courses.lesson-type.frame')
	@break

	@case('exercise')
		@include('pages.courses.lesson-type.exercise')
	@break
@endswitch

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

<!-- Delete Content Confirmation Modal -->
<div class="modal" id="deleteLessonModal" tabindex="-1" role="dialog" aria-labelledby="deleteLessonLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
				<input type="hidden" id="confirmDeleteLessonID">
				<h2>هل أنت متأكد أنك تريد حذف هذا الدرس ؟</h2>
				<hr>
				<button type="button" class="btn btn-danger" id="confirmDeleteLesson" data-lesson-id="{{ $lesson->id }}">نعم</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal">لا</button>
            </div>
        </div>
    </div>
</div>
@endsection