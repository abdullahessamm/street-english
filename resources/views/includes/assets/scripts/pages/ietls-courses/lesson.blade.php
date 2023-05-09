<script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/toggle/switchery.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script>
$(document).ready(function(){

    CKEDITOR.replace( 'lesson_description' );

    function callAjax(route, data)
    {
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : route,
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                data
            },
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            },
            error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#error").modal('show');
            }
        });
    }

    /* Swtichery */
    var i = 0;
    if (Array.prototype.forEach) {

        var elems = $('.switchery');
        $.each( elems, function( key, value ) {
            var $size="", $color="",$sizeClass="", $colorCode="";
            $size = $(this).data('size');
            var $sizes ={
                'lg' : "large",
                'sm' : "small",
                'xs' : "xsmall"
            };
            if($(this).data('size')!== undefined){
                $sizeClass = "switchery switchery-"+$sizes[$size];
            }
            else{
                $sizeClass = "switchery";
            }

            $color = $(this).data('color');
            var $colors ={
                'primary' : "#967ADC",
                'success' : "#37BC9B",
                'danger' : "#DA4453",
                'warning' : "#F6BB42",
                'info' : "#3BAFDA"
            };
            if($color !== undefined){
                $colorCode = $colors[$color];
            }
            else{
                $colorCode = "#37BC9B";
            }

            var switchery = new Switchery($(this)[0], { className: $sizeClass, color: $colorCode });
        });
    } else {
        var elems1 = document.querySelectorAll('.switchery');

        for (i = 0; i < elems1.length; i++) {
            var $size = elems1[i].data('size');
            var $color = elems1[i].data('color');
            var switchery = new Switchery(elems1[i], { color: '#37BC9B' });
        }
    }
    /* End Swtichery */

	$(".select2").select2();

    // open to confirm lesson deletion
    $("#openDeleteLessonModalForm").on('click', function(){
        $("#deleteLessonModal").modal('show');

        var lesson_id = $(this).data("lesson-id");

        $("#confirmDeleteLessonID").val(lesson_id);
    });

    // confirm lesson deletion
    $('#confirmDeleteLesson').on('click', function(e){
        e.preventDefault();

        var lesson_id = $("#confirmDeleteLessonID").val();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#deleteLessonModal").modal('hide');
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.ietls-course.content.lesson.delete') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "lesson_id" : lesson_id,
            },
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            },
            error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#error").modal('show');
            }
        });
    });

    // create lesson type
    $("#createLessonType").on('click', function(e){
        e.preventDefault();
        
        var lesson_id = $(this).data("lesson-id");
        var lesson_type = $('#lesson_type').val();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.ietls-course.content.lesson.type.create') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "lesson_id" : lesson_id,
                "lesson_type" : lesson_type,
            },
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            },
            error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#error").modal('show');
            }
        });
    });

    // check if course is locked or not
    $("#isLocked").on('change', function(){
        var lesson_id = $(this).data("lesson-id");

        var route = "{{ route('ajax.ietls-course.content.lesson.is-locked') }}";

        if($(this).is(':checked'))
        {
            callAjax(route, {'lesson_id' : lesson_id, 'isLocked' : true});
        }
        else
        {
            callAjax(route, {'lesson_id' : lesson_id, 'isLocked' : false});
        }
    });

    // check if course is continueable or not
    $("#isContinueable").on('change', function(){
        var lesson_id = $(this).data("lesson-id");

        var route = "{{ route('ajax.ietls-course.content.lesson.is-continueable') }}";

        if($(this).is(':checked'))
        {
            callAjax(route, {'lesson_id' : lesson_id, 'isContinueable' : true});
        }
        else
        {
            callAjax(route, {'lesson_id' : lesson_id, 'isContinueable' : false});
        }
    });

    // check if course is achievable in order to view points div
    $("#isAchievable").on('change', function(){
        var lesson_id = $(this).data("lesson-id");

        var route = "{{ route('ajax.ietls-course.content.lesson.is-achievable') }}";

        if($(this).is(':checked'))
        {
            callAjax(route, {'lesson_id' : lesson_id, 'isAchievable' : true});
        }
        else
        {
            callAjax(route, {'lesson_id' : lesson_id, 'isAchievable' : false});
        }
    });

    // choose only one instructor for this lesson
    $(".chooseInstructor").on('change', function(){
        var lesson_id = $(this).data("lesson-id");
        var instructor_id = $(this).data("instructor-id");

        var route = "{{ route('ajax.ietls-course.content.lesson.instructor') }}";

        if($(this).is(':checked'))
        {
            callAjax(route, {'lesson_id' : lesson_id, 'instructor_id' : instructor_id});
        }
        else
        {
            callAjax(route, {'lesson_id' : lesson_id, 'instructor_id' : instructor_id});
        }
    });

    // add points for completing lesson
    $(document).on('click', '#addPoints', function(e){
        e.preventDefault();

        var lesson_id = $(this).data("lesson-id");
        var points = $("#points").val();

        callAjax("{{ route('ajax.ietls-course.content.lesson.add-points') }}", {'points': points, 'lesson_id' : lesson_id});
    });

    // update lesson description
    $("#updateLessonDescription").on('click', function(e){
        e.preventDefault();

        for ( instance in CKEDITOR.instances )
        {
            CKEDITOR.instances[instance].updateElement();
        }

        var lesson_id = $(this).data("lesson-id");
        var lesson_description = $("#lesson_description").val();

        callAjax("{{ route('ajax.ietls-course.content.lesson.description.update') }}", {'lesson_description': lesson_description, 'lesson_id' : lesson_id});
    });

    // check if course is published or not
    $("#isPublished").on('change', function(){
        var lesson_info_id = $(this).data("lesson-info-id");

        var route = "{{ route('ajax.ietls-course.content.lesson.is-published') }}";

        if($(this).is(':checked'))
        {
            callAjax(route, {'lesson_info_id' : lesson_info_id, 'isPublished' : 1});
        }
        else
        {
            callAjax(route, {'lesson_info_id' : lesson_info_id, 'isPublished' : 0});
        }
    });

    // upload video lesson
    $(document).on('submit', '#createVideoCourse', function(e){
        e.preventDefault();

        /*var file = $("#video").val();
        var ext = file.split(".");
        ext = ext[ext.length-1].toLowerCase();      
        var arrayExtensions = ["mp4"];

        if (arrayExtensions.lastIndexOf(ext) == -1) {
            $("#resModal").modal('show');
            $("#res").html('<i class="fa fa-times text-danger" style="font-size: 100px;"></i><h3>نوع الملف يجب ان يكون mp4</h3>');
            return false;
        }*/

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.ietls-course.content.lesson.video.upload') }}",
            type : "POST",
            data : new FormData(this),
            contentType : false,
            processData : false,
            cache : false,
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            },
            error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#error").modal('show');
            }
        });
    });

    // check if lesson video is downloadable or not
    $(document).on('change', '#isVideoDownloadable', function(){
        var lesson_video_id = $(this).data("lesson-video-id");

        var route = "{{ route('ajax.ietls-course.content.lesson.video.is-downloadable') }}";

        if($(this).is(':checked'))
        {
            callAjax(route, {'lesson_video_id' : lesson_video_id, 'isVideoDownloadable' : 1});
        }
        else
        {
            callAjax(route, {'lesson_video_id' : lesson_video_id, 'isVideoDownloadable' : 0});
        }
    });

    // update video cousrse
    $(document).on('submit', '#updateVideoCourse', function(e){
        e.preventDefault();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.ietls-course.content.lesson.video.update') }}",
            type : "POST",
            data : new FormData(this),
            contentType : false,
            processData : false,
            cache : false,
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            },
            error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#error").modal('show');
            }
        });
    });

    // upload audio lesson
    $(document).on('submit', '#createAudioCourse', function(e){
        e.preventDefault();

        var file = $("#audio-lesson").val();
        var ext = file.split(".");
        ext = ext[ext.length-1].toLowerCase();      
        var arrayExtensions = ["mp3"];

        if (arrayExtensions.lastIndexOf(ext) == -1) {
            $("#resModal").modal('show');
            $("#res").html('<i class="fa fa-times text-danger" style="font-size: 100px;"></i><h3>نوع الملف يجب ان يكون mp3</h3>');
            return false;
        }

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.ietls-course.content.lesson.audio.upload') }}",
            type : "POST",
            data : new FormData(this),
            contentType : false,
            processData : false,
            cache : false,
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            },
            error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#error").modal('show');
            }
        });
    });
    
    // update audio cousrse
    $(document).on('submit', '#updateAudioCourse', function(e){
        e.preventDefault();

        var file = $("#audio-lesson").val();
        var ext = file.split(".");
        ext = ext[ext.length-1].toLowerCase();      
        var arrayExtensions = ["mp3"];

        if (arrayExtensions.lastIndexOf(ext) == -1) {
            $("#resModal").modal('show');
            $("#res").html('<i class="fa fa-times text-danger" style="font-size: 100px;"></i><h3>نوع الملف يجب ان يكون mp3</h3>');
            return false;
        }

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.ietls-course.content.lesson.audio.update') }}",
            type : "POST",
            data : new FormData(this),
            contentType : false,
            processData : false,
            cache : false,
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            },
            error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#error").modal('show');
            }
        });
    });

    // check if lesson audio is downloadable or not
    $(document).on('change', '#isAudioDownloadable', function(){
        var lesson_audio_id = $(this).data("lesson-audio-id");

        var route = "{{ route('ajax.ietls-course.content.lesson.audio.is-downloadable') }}";

        if($(this).is(':checked'))
        {
            callAjax(route, {'lesson_audio_id' : lesson_audio_id, 'isAudioDownloadable' : 1});
        }
        else
        {
            callAjax(route, {'lesson_audio_id' : lesson_audio_id, 'isAudioDownloadable' : 0});
        }
    });

    // upload lesson pdf doc
    $(document).on('submit', '#createDocCourse', function(e){
        e.preventDefault();

        var file = $("#doc").val();
        var ext = file.split(".");
        ext = ext[ext.length-1].toLowerCase();      
        var arrayExtensions = ["pdf"];

        if (arrayExtensions.lastIndexOf(ext) == -1) {
            $("#resModal").modal('show');
            $("#res").html('<i class="fa fa-times text-danger" style="font-size: 100px;"></i><h3>نوع الملف يجب ان يكون pdf</h3>');
            return false;
        }

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.ietls-course.content.lesson.doc.upload') }}",
            type : "POST",
            data : new FormData(this),
            contentType : false,
            processData : false,
            cache : false,
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            },
            error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#error").modal('show');
            }
        });
    });

    // check if lesson audio is downloadable or not
    $(document).on('change', '#isDocDownloadable', function(){
        var lesson_doc_id = $(this).data("lesson-doc-id");

        var route = "{{ route('ajax.ietls-course.content.lesson.doc.is-downloadable') }}";

        if($(this).is(':checked'))
        {
            callAjax(route, {'lesson_doc_id' : lesson_doc_id, 'isDocDownloadable' : 1});
        }
        else
        {
            callAjax(route, {'lesson_doc_id' : lesson_doc_id, 'isDocDownloadable' : 0});
        }
    });

    // update lesson doc
    $(document).on('submit', '#updateDocCourse', function(e){
        var file = $("#doc").val();
        var ext = file.split(".");
        ext = ext[ext.length-1].toLowerCase();      
        var arrayExtensions = ["pdf"];

        if (arrayExtensions.lastIndexOf(ext) == -1) {
            $("#resModal").modal('show');
            $("#res").html('<i class="fa fa-times text-danger" style="font-size: 100px;"></i><h3>نوع الملف يجب ان يكون pdf</h3>');
            return false;
        }

        e.preventDefault();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.ietls-course.content.lesson.doc.update') }}",
            type : "POST",
            data : new FormData(this),
            contentType : false,
            processData : false,
            cache : false,
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            },
            error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#error").modal('show');
            }
        });
    });

    // update lesson doc pages
    $(document).on('click', '#updateDocPages', function(e){
        e.preventDefault();

        var lesson_doc_id = $(this).data("lesson-doc-id");
        var pages = $("#pages").val();

        callAjax("{{ route('ajax.ietls-course.content.lesson.doc.pages.update') }}", {'pages': pages, 'lesson_doc_id' : lesson_doc_id});
    });

    // create lesson context
    $(document).on('submit', '#createCourseContext', function(e){
        e.preventDefault();

        for ( instance in CKEDITOR.instances )
        {
            CKEDITOR.instances[instance].updateElement();
        }

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.ietls-course.content.lesson.context.create') }}",
            type : "POST",
            data : new FormData(this),
            contentType : false,
            processData : false,
            cache : false,
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            },
            error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#error").modal('show');
            }
        });
    });
    
    // update lesson context
    $(document).on('submit', '#updateCourseContext', function(e){
        e.preventDefault();

        for ( instance in CKEDITOR.instances )
        {
            CKEDITOR.instances[instance].updateElement();
        }

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.ietls-course.content.lesson.context.update') }}",
            type : "POST",
            data : new FormData(this),
            contentType : false,
            processData : false,
            cache : false,
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            },
            error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#error").modal('show');
            }
        });
    });

    // create lesson url frame
    $(document).on('submit', '#createCourseFrame', function(e){
        e.preventDefault();

        for ( instance in CKEDITOR.instances )
        {
            CKEDITOR.instances[instance].updateElement();
        }

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.ietls-course.content.lesson.iframe.create') }}",
            type : "POST",
            data : new FormData(this),
            contentType : false,
            processData : false,
            cache : false,
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            },
            error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#error").modal('show');
            }
        });
    });
    
    // update lesson url frame
    $(document).on('submit', '#updateCourseFrame', function(e){
        e.preventDefault();

        for ( instance in CKEDITOR.instances )
        {
            CKEDITOR.instances[instance].updateElement();
        }

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.ietls-course.content.lesson.iframe.update') }}",
            type : "POST",
            data : new FormData(this),
            contentType : false,
            processData : false,
            cache : false,
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            },
            error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#error").modal('show');
            }
        });
    });

    // create exercise lesson
    $(document).on('submit', '#createCourseExercise', function(e){
        e.preventDefault();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.ietls-course.content.lesson.exercise.create') }}",
            type : "POST",
            data : new FormData(this),
            contentType : false,
            processData : false,
            cache : false,
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            },
            error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#error").modal('show');
            }
        });
    });
    
    // update exercise lesson
    $(document).on('submit', '#updateCourseExercise', function(e){
        e.preventDefault();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.ietls-course.content.lesson.exercise.update') }}",
            type : "POST",
            data : new FormData(this),
            contentType : false,
            processData : false,
            cache : false,
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            },
            error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#error").modal('show');
            }
        });
    });
});
</script>