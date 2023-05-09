@extends('layouts.app', [
    'title' => 'دورة IELTS : '.$course->name,
	'active' => 'courses',
    'breadcrumb' => [
        'title' => $course->name,
        'map' => [
			'الرئيسية' => 'home',
            'دورات IELTS' => 'ietls-courses',
            $course->name => 'active'
        ]
    ],
	'header_right' => [
		'href' => [
			'text' => 'اضافة محتوي لهذة الدورة',
			'route' => [
				'route' => 'ietls-course.contents',
				'slugs' => $course->slug
			],
			'color' => 'info',
			'bold' => true,
		],
    ],
    'assets' => 'pages.ietls-courses.show'
])

@section('content')
<!-- Update course section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">Update Course {{ $course->name }}</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <form id="updateCourse" class="form form-horizontal striped-labels form-bordered">
                            {{ csrf_field() }}
							<input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="icon-notebook"></i> Course Info</h4>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="course_name">اسم دورة IELTS</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="course_name" class="form-control" name="course_name" value="{{ $course->name }}" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="duration">المدة الزمنية</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="duration" class="form-control" name="duration" value="{{ $course->duration }}" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="level">المستوي</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="level" class="form-control" name="level" value="{{ $course->level }}" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="language">اللغة</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="language" class="form-control" name="language" value="{{ $course->language }}" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="course_category_id">الفئة التي تنتمي لها هذة الدورة</label>
		                            <div class="col-md-9">
										<select class="select2 form-control" id="course_category_id" name="course_category_id">
											@foreach($courseCategories as $courseCategory)
											<option value="{{ $courseCategory->id }}" {{ $courseCategory->id == $course->course_category_id ? "selected" : null }}>{{ $courseCategory->category_name }}</option>
											@endforeach
										</select>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="duration">سعر الدورة</label>
		                            <div class="col-md-9">
		                            	<input type="number" min="0" id="price" class="form-control" name="price" value="{{ $course->price }}" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="discount">خصم <b>(OPTIONAL)</b></label>
		                            <div class="col-md-9">
		                            	<input type="number" min="0" id="discount" class="form-control" value="{{ $course->discount }}" name="discount">
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="description">شرح</label>
		                            <div class="col-md-9">
                                        <textarea name="description" id="description" required>{{ $course->description }}</textarea>
		                            </div>
		                        </div>

	                    		<h4 class="form-section"><i class="icon-picture"></i> الميديا</h4>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="thumbnail">
										صورة مصغرة
										<br>
										<small><b>recommended size : 383w x 238h</b></small>
									</label>
									<div class="col-md-9">
										<input type="file" id="thumbnail" class="form-control" name="thumbnail">
										<img src="{{ config('app.main_url').'/images/ielts-courses/'.$course->id.'/'.$course->thumbnail }}" class="img-fluid" alt="{{ $course->name }}">
									</div>
								</div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="image"> مقدمة الدورة </label>
                                    <div class="col-md-9">
										<div class="form-check form-check-inline">
                                            <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="none" value="none" checked>
                                            <label class="form-check-label" for="none">
												{{ $course->media_intro == 'image' ? 'الابقاء علي الصورة الحالية' : 'الابقاء علي رابط اليوتيوب الحالي' }}
											</label>
                                        </div>
										<div class="form-check form-check-inline">
                                            <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="image" value="image">
                                            <label class="form-check-label" for="image">تحديث الصورة</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="video" value="video">
                                            <label class="form-check-label" for="video">تحديث رابط اليوتيوب</label>
                                        </div>

										<div class="my-2">
										@if($course->media_intro == 'image')
											<img src="{{ config('app.main_url').'/images/ielts-courses/'.$course->id.'/'.$course->image }}" class="img-fluid" alt="{{ $course->name }}">
										@else
											<div class="embed-responsive embed-responsive-16by9">
												<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$course->video_url}}?rel=0" allowfullscreen></iframe>
											</div>
										@endif
										</div>
		                            </div>
		                        </div>

								<div id="media_res"></div>
							</div>

	                        <div class="form-actions">
	                            <button type="submit" class="btn btn-info mr-1">
	                                <i class="fa fa-check"></i> تحديث
	                            </button>
								<button type="button" class="btn btn-danger" id="deleteCourse" data-course-id="{{ $course->id }}">
	                                <i class="fa fa-trash"></i> مسح هذة الدورة
	                            </button>
								@if($course->isPublished == 0)
								<button type="button" class="btn btn-success" id="publishCourse" data-course-id="{{ $course->id }}">
	                                <i class="fa fa-eye"></i> قم بنشر هذة الدورة
	                            </button>
								@else
								<button type="button" class="btn btn-warning text-dark" id="unPublishCourse" data-course-id="{{ $course->id }}">
	                                <i class="fa fa-eye-slash"></i> قم باخفاء هذة الدورة
	                            </button>
								@endif
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>
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
    <div class="modal-dialog" role="document">
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

<!-- Delete Content Confirmation Modal -->
<div class="modal" id="deleteCourseModal" tabindex="-1" role="dialog" aria-labelledby="deleteCourseLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
				<input type="hidden" id="confirmdeleteCourseID">
				<h2>هل أنت متأكد أنك تريد حذف هذه الدورة ؟</h2>
				<h6><b class="text-warning">تحذير:</b> إذا قمت بحذف هذه دورة IELTS ، فستتم إزالة جميع محتويات بدروسها.</h6>
				<hr>
				<button type="button" class="btn btn-danger" id="confirmdeleteCourse">نعم</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal">لا</button>
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
@endsection