@extends('coach.layouts.app',[
    'title' => 'انشاء دورة جديدة',
    'scripts' => 'pages.my-course.create'
])

@section('content')
<div class="page-section border-bottom-2">
    <div class="container page__container">
        <form id="createNewCourse">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-8">
    
                    <div class="page-separator">
                        <div class="page-separator__text">معلومات عامة</div>
                    </div>
    
                    <div class="form-group mb-24pt">
                        <label class="form-label">اسم الدورة</label>
                        <input type="text" class="form-control form-control-lg" name="online_course_name" required>
                    </div>

    
                    <div class="form-group mb-24pt">
                        <label class="form-label">شرح الدورة</label>
                        <textarea name="description" id="description" cols="30" rows="10"></textarea>
                    </div>
                    
                </div>
                <div class="col-md-4">
    
                    <div class="card">
                        <div class="card-header text-center">
                            <button class="btn btn-primary">انشاء الدورة</button>
                        </div>
                    </div>
    
                    <div class="page-separator">
                        <div class="page-separator__text">المقدمة</div>
                    </div>
    
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="my-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="image" value="image" checked>
                                    <label class="form-check-label" for="image">صورة</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="video" value="video">
                                    <label class="form-check-label" for="video">رابط يوتيوب</label>
                                </div>
                            </div>

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
                                <input type="file" id="thumbnail" class="form-control" name="thumbnail" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    صورة بانر للدورة
                                    <b>( اختياري )</b>
                                </label>
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
                                <input type="text" id="duration" class="form-control" name="duration" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">المستوي</label>
                                <select name="level" class="form-control" id="level">
                                    <option value="Basic">مبتدئ</option>
                                    <option value="Intermediate">متوسط</option>
                                    <option value="Adavanced">متقدم</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">اللغة</label>
                                <input type="text" id="language" class="form-control" name="language" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">اختر فئة</label>
                                <select name="online_course_category_id" class="form-control custom-select">
                                @foreach($courseCategories as $courseCategory)
                                    <option value="{{ $courseCategory->id }}">{{ $courseCategory->category_name }}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">سعر الكورس</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group form-inline">
                                            <span class="input-group-prepend"><span class="input-group-text">$</span></span>
                                            <input type="text" class="form-control" name="price" required>
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
@endsection
