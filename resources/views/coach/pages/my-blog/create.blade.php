@extends('coach.layouts.app',[
    'title' => 'انشاء مقالة جديدة',
    'scripts' => 'pages.my-blog.create'
])

@section('content')
<div class="page-section border-bottom-2">
    <div class="container page__container">
        <form id="createNewBlog">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-8">
    
                    <div class="page-separator">
                        <div class="page-separator__text">معلومات عامة</div>
                    </div>
    
                    <div class="form-group mb-24pt">
                        <label class="form-label">عنوان البلوج</label>
                        <input type="text" class="form-control form-control-lg" name="title" required>
                    </div>

                    
                    <div class="form-group mb-24pt">
                        <label class="form-label">شرح مصغر</label>
                        <textarea name="short_description" class="form-control form-control-lg" id="short_description" cols="30" rows="3" required></textarea>
                    </div>

                    <div class="form-group mb-24pt">
                        <label class="form-label">المحتوي</label>
                        <textarea name="content" id="content" cols="30" rows="10"></textarea>
                    </div>
                    
                    <div class="form-group mb-24pt">
                        <label class="form-label">تم النشر بتاريخ</label>
                        <input type="date" class="form-control form-control-lg" name="posted_at">
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
                                <label class="form-label">
                                    صورة بانر للدورة
                                    <b>( اختياري )</b>
                                </label>
                                <input type="file" id="banner" class="form-control" name="banner">
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