@extends('layouts.app', [
    'title' => 'انشاء دورة ielts',
	'active' => 'courses',
    'breadcrumb' => [
        'title' => 'انشاء دورة ielts',
        'map' => [
            'الصفحة الرئيسية' => 'home',
            'الدورات التدريبية' => 'courses',
            'انشاء دورة ielts' => 'active'
        ]
    ],
    'assets' => 'pages.ietls-courses.create'
])

@section('content')
<!-- Create course section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">تفاصيل الدورة</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <form id="createNewCourse" class="form form-horizontal striped-labels form-bordered">
                            {{ csrf_field() }}
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="icon-notebook"></i> معومات عن الدورة</h4>

			                    <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="ietls_course_name">اسم الدورة</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="ietls_course_name" class="form-control" name="ietls_course_name" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="duration">المدة الزمنية</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="duration" class="form-control" name="duration" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="level">المستوي</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="level" class="form-control" name="level" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="language">اللغة</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="language" class="form-control" name="language" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="ietls_course_category_id">الفئة التي تنتمي لها هذة الدورة</label>
		                            <div class="col-md-9">
										<select class="select2 form-control" id="ietls_course_category_id" name="ietls_course_category_id">
											@foreach($courseCategories as $courseCategory)
											<option value="{{ $courseCategory->id }}">{{ $courseCategory->category_name }}</option>
											@endforeach
										</select>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="duration">سعر الدورة</label>
		                            <div class="col-md-9">
		                            	<input type="number" min="0" id="price" class="form-control" name="price" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="discount">خصم <b>(اختياري)</b></label>
		                            <div class="col-md-9">
		                            	<input type="number" min="0" max="100" id="discount" class="form-control" name="discount">
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="description">شرح الدورة</label>
		                            <div class="col-md-9">
                                        <textarea name="description" id="description" required></textarea>
		                            </div>
		                        </div>

	                    		<h4 class="form-section"><i class="icon-picture"></i> الميديا</h4>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="thumbnail">
										صورة مصغرة
										<br>
										<small><b>recommended size : 370w x 230h</b></small>
									</label>
									<div class="col-md-9">
										<input type="file" id="thumbnail" class="form-control" name="thumbnail" required>
									</div>
								</div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="image"> مقدمة الدورة </label>
                                    <div class="col-md-9">
										<div class="form-check form-check-inline">
                                            <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="image" value="image" checked>
                                            <label class="form-check-label" for="image">صورة</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="video" value="video">
                                            <label class="form-check-label" for="video">رابط يوتيوب</label>
                                        </div>
		                            </div>
		                        </div>

								<div id="media_res"></div>

	                    		<h4 class="form-section"><i class="icon-user"></i> المحاضرين لهذة الدورة</h4>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="image">Choose coach(es)</label>
                                    <div class="col-md-9">
										<select multiple="multiple" name="coaches[]" size="10" class="duallistbox">
										@foreach($coaches as $coach)
											<option value="{{ $coach->id }}">{{ $coach->name }}</option>
										@endforeach
										</select>
		                            </div>
		                        </div>
							</div>

	                        <div class="form-actions">
	                            <button type="reset" class="btn btn-warning mr-1">
	                            	<i class="fa fa-remove"></i> الغاء
	                            </button>
	                            <button type="submit" class="btn btn-primary">
	                                <i class="fa fa-check"></i> انشاء
	                            </button>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>
<!-- // Create course section end -->

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
@endsection