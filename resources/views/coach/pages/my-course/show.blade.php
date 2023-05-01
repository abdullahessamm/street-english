@extends('coach.layouts.app',[
    'title' => 'كورس : '.$myCourse->name,
    'assets' => 'pages.my-course.show'
])

@section('content')
<div class="page-section border-bottom-2">
    <div class="container page__container">
        <form id="updateCourse">
            {{ csrf_field() }}
            <input type="hidden" name="online_course_id" value="{{ $myCourse->id }}">
            <div class="row">
                <div class="col-md-8">

                    <div class="page-separator">
                        <div class="page-separator__text">معلومات عامة</div>
                    </div>

                    <div class="form-group mb-24pt">
                        <label class="form-label">اسم الدورة</label>
                        <input type="text" class="form-control form-control-lg" name="online_course_name" value="{{ $myCourse->name }}" required>
                    </div>


                    <div class="form-group mb-24pt">
                        <label class="form-label">شرح الدورة</label>
                        <textarea name="description" id="description" cols="30" rows="10">{!! $myCourse->description !!}</textarea>
                    </div>

                    <div class="page-separator">
                        <div class="page-separator__text">المحتوي التدريبي</div>
                    </div>

                    @if($myCourse->contents->count() > 0)
                    <div class="accordion js-accordion accordion--boxed mb-24pt" id="parent">
                        @for($i = 0; $i < $myCourse->contents->count(); $i++)
                        <div class="d-flex align-items-center page-num-container">
                            <div class="page-num">
                                <button type="button" class="btn btn-danger btn-sm deleteContent" data-content-id="{{ $myCourse->contents[$i]->id }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                            <h4 class="updateContentTitle" contenteditable="true" data-content-id="{{ $myCourse->contents[$i]->id }}" data-content-title="{{ $myCourse->contents[$i]->title }}">
                                {{ $myCourse->contents[$i]->title }}
                                
                            </h4>
                        </div>

                        <p class="text-70 measure-paragraph-max mb-24pt updateContentDescription" data-content-id="{{ $myCourse->contents[$i]->id }}" contenteditable="true">
                            {{ $myCourse->contents[$i]->description }}
                        </p>

                        <ul class="accordion accordion--boxed js-accordion measure-paragraph-max mb-32pt mb-lg-64pt"
                            id="toc-1">
                            <li class="accordion__item open">
                                <a class="accordion__toggle"
                                   data-toggle="collapse"
                                   data-parent="#toc-1"
                                   href="#toc-content-{{$i}}">
                                    <span class="flex">
                                        {{$myCourse->contents[$i]->lessons->count()}} {{ $myCourse->contents[$i]->lessons->count() > 1 ? 'دروس' : 'درس' }}
                                    </span>
                                    <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                                </a>
                                <div class="accordion__menu">
                                    <ul class="list-unstyled collapse show" id="toc-content-{{$i}}">
                                        <li class="accordion__menu-link">
                                            <button class="btn btn-success btn-sm addNewLessonBtn" data-content-id="{{ $myCourse->contents[$i]->id }}">اضافة درس جديد</button>
                                        </li>
                                        @foreach($myCourse->contents[$i]->lessons as $lesson)
                                        <li class="accordion__menu-link">
                                            <span class="material-icons icon-16pt icon--left text-body">check_circle</span>
                                            <a class="flex previewLesson" data-lesson-id="{{ $lesson->id }}" href="javascript:void(0);">{{ $lesson->title }}</a>
                                            <input type="checkbox" id="switchery" class="switchery lockOrUnlockLesson" data-lesson-id="{{ $lesson->id }}" {{ $lesson->isLocked == 1 ? 'checked' : '' }} />
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        @endfor
                    </div>

                    <div class="jumbotron text-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createNewContentModal">
                            انشاء محتوي جديد
                        </button>
                    </div>
                    @else
                    <div class="jumbotron text-center">
                        <h2>ليس لديك اي محتوي تدريبي</h2>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createNewContentModal">
                            انشاء محتوي جديد
                        </button>
                    </div>
                    @endif
                </div>

                <div class="col-md-4">

                    <div class="card">
                        <div class="card-header text-center">
                            {!! $approved == 1 ? '<i class="fa fa-check text-success" style="font-size:100px"></i> <h3>تم نشر دورتك التدريبية</h3>' : '<i class="fa fa-question text-danger" style="font-size:100px"></i> <h3>دورتك التدريبية تخضع لمعاينة من الادارة</h3>' !!}
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header text-center">
                            <button class="btn btn-success">تحديث الدورة</button>
                            <button type="button" class="btn btn-danger" id="deleteCourse" data-my-course-id="{{ $myCourse->id }}">مسح الدورة</button>
                        </div>
                    </div>

                    <div class="page-separator">
                        <div class="page-separator__text">المقدمة</div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            
                            <div class="my-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="none" value="none" checked>
                                    <label class="form-check-label" for="none">
                                        {{ $myCourse->media_intro == 'image' ? 'الابقاء علي الصورة الحالية' : 'الابقاء علي الفيديو الحالي' }}
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="image" value="image">
                                    <label class="form-check-label" for="image">صورة</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="video" value="video">
                                    <label class="form-check-label" for="video">رابط يوتيوب</label>
                                </div>
                            </div>

                            <div id="preview_current_intro_media" data-media-intro="{{ $myCourse->media_intro }}" data-my-course-id="{{ $myCourse->id }}"></div>


                            <div id="media_res"></div>
                        </div>
                    </div>

                    <div class="page-separator">
                        <div class="page-separator__text">الميديا</div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">صورة مصغرة للدورة</label>
                                <img src="{{ asset('images/online-courses/'.$myCourse->id.'/'.$myCourse->thumbnail) }}" class="img-fluid" alt="">
                                <input type="file" id="thumbnail" class="form-control" name="thumbnail">
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    صورة بانر للدورة
                                    <b>( اختياري )</b>
                                </label>
                                <img src="{{ asset('images/online-courses/'.$myCourse->id.'/'.$myCourse->banner) }}" class="img-fluid" alt="">
                                <input type="file" id="banner" class="form-control" name="banner">
                            </div>
                        </div>
                    </div>

                    <div class="page-separator">
                        <div class="page-separator__text">معلومات اخري</div>
                    </div>

                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label class="form-label">المدة الزمنية</label>
                                <input type="text" id="duration" class="form-control" name="duration" value="{{ $myCourse->duration }}" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">المستوي</label>
                                <select name="level" class="form-control" id="level">
                                    <option value="Basic" {{ $myCourse->level == 'Basic' ? 'selected' : '' }}>مبتدئ</option>
                                    <option value="Intermediate" {{ $myCourse->level == 'Intermediate' ? 'selected' : '' }}>متوسط</option>
                                    <option value="Adavanced" {{ $myCourse->level == 'Adavanced' ? 'selected' : '' }}>متقدم</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">اللغة</label>
                                <input type="text" id="language" class="form-control" name="language" value="{{ $myCourse->language }}" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">اختر فئة</label>
                                <select name="online_course_category_id" class="form-control">
                                @foreach($courseCategories as $courseCategory)
                                    <option value="{{ $courseCategory->id }}" {{ $myCourse->online_course_category_id == $courseCategory->id ? 'selected' : null }}>{{ $courseCategory->category_name }}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">سعر الكورس</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group form-inline">
                                            <span class="input-group-prepend"><span class="input-group-text">$</span></span>
                                            <input type="text" class="form-control" name="price" value="{{ $myCourse->price }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">هل يوجد خصم</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group form-inline">
                                            <span class="input-group-prepend"><span class="input-group-text">%</span></span>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </form>
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

<!-- Create New Content Modal -->
<div class="modal fade" id="createNewContentModal" tabindex="-1" role="dialog" aria-labelledby="createNewContentModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="createNewContentModalLabel">انشاء محتوي جديدة</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<form id="createNewContent">
			{{ csrf_field() }}
			<input type="hidden" name="online_course_id" value="{{ $myCourse->id }}">
			<div class="modal-body">
				<div class="form-group">
					<label for="content_name">اسم المحتوي</label>
					<input type="text" class="form-control" name="content_name" id="content_name" required>
				</div>
				
				<div class="form-group">
					<label for="description">شرح المحتوي</label>
					<textarea name="description" class="form-control" id="description" cols="30" rows="3" required></textarea>
				</div>
			</div>

			
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
				<button type="submit" class="btn btn-primary">انشاء</button>
			</div>
		</form>
	</div>
	</div>
</div>

<!-- Delete Course Confirmation Modal -->
<div class="modal" id="deleteCourseModal" tabindex="-1" role="dialog" aria-labelledby="deleteCourseLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
				<input type="hidden" id="confirmdeleteCourseID" value="{{ $myCourse->id }}">
				<h2>هل تريد مسح هذا الكورس</h2>
				<h6><b class="text-danger">تحذير:</b> إذا قمت بحذف هذه الدورة التدريبية ، فستتم إزالة جميع محتويات دروسها</h6>
				<hr>
				<button type="button" class="btn btn-danger" id="confirmdeleteCourse">نعم</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal">لا</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Content Confirmation Modal -->
<div class="modal" id="deleteContentModal" tabindex="-1" role="dialog" aria-labelledby="deleteContentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
				<input type="hidden" id="confirmDeleteContentID">
				<h2>هل تريد مسح هذا المحتوي ؟</h2>
				<h6><b class="text-danger font-weight-bold">تحذير:</b> إذا قمت بحذف هذا المحتوى ستتم إزالة كل الدروس</h6>
				<hr>
				<button type="button" class="btn btn-danger" id="confirmDeleteContent">نعم</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal">لا</button>
            </div>
        </div>
    </div>
</div>

<!-- Create New Lesson Modal -->
<div class="modal fade" id="createNewLessonModal" tabindex="-1" role="dialog" aria-labelledby="createNewLessonModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createNewLessonModalLabel">انشاء محتوي جديدة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="addNewLessons">
                    {{ csrf_field() }}
                    <input type="hidden" name="content_id" id="content_id">
        
                    <div class="repeater-default">
                        <div data-repeater-list="lessons">
                            <div data-repeater-item>
                                <div class="form-group row">
                                    <div class="col-3">
                                        <label for="lesson_title">عنوان الدرس</label>
                                        <input type="text" class="form-control" name="lesson_title" id="lesson_title" required>
                                    </div>
                                    <div class="col-3">
                                        <label for="video_type">نوع الفيديو</label>
                                        <select name="video_type" id="video_type" class="form-control">
                                            <option value="youtube" selected>يوتيوب</option>
                                            <option value="vimeo">فيمو</option>
                                            <option value="drive">جوجل درايف</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="video_url">رابط الفيديو</label>
                                        <textarea name="video_url" id="video_url" class="form-control" cols="30" rows="3" dir="ltr"></textarea>
                                    </div>
                                    <div class="col-3">
                                        <label for="video_description">شرح الدرس</label>
                                        <textarea name="video_description" id="video_description" class="form-control" cols="30" rows="3"></textarea>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-danger mt-2" data-repeater-delete> <i class="ft-x"></i> مسح</button>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="form-group overflow-hidden">
                            <div class="col-12">
                                <button type="button" data-repeater-create class="btn btn-primary">
                                    <i class="ft-plus"></i> اضافة درس جديد
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">اضافة الدروس</button>
                    </div>
                </form>
            </div>
        </div>
	</div>
</div>

<!-- Preview Single Lesson Modal -->
<div class="modal fade" id="previewLessonModal" tabindex="-1" role="dialog" aria-labelledby="previewLessonModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            
            <div id="preview_lesson"></div>
        </div>
	</div>
</div>
@endsection