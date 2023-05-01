<script src="{{ asset('assets/dashboard/js/forms/toggle/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/forms/toggle/bootstrap-checkbox.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/forms/toggle/switchery.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/jquery.repeater.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script>
$(document).ready(function(){

    $("#resModal").appendTo("body");
    $("#loading").appendTo("body");
    $("#createNewContentModal").appendTo("body");
    $("#deleteCourseModal").appendTo("body");
    $("#deleteContentModal").appendTo("body");
    $("#createNewLessonModal").appendTo("body");
    $("#previewLessonModal").appendTo("body");

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
    
    // calling via ajax with progress bar
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
            error: function (xhr, ajaxOptions, thrownError) {
                $("#loading").modal('hide');
                $("#error").modal({backdrop: 'static', keyboard: false});
                $("#error").modal('show');
            }
        });
	}

    // calling via ajax with result
    function callAjaxWithRes(route, data, res)
	{
		$.ajax({
			url : route,
			type : "POST",
			data : {
				"_token" : "{{ csrf_token() }}",
				data
			},
			beforeSend : function()
			{
				$(res).html('<div class="text-center"><h6>يتم عرض الحقل برجاء الانتظار</h6></div>');
			},
			success : function(data)
			{
				$(res).html(data);
			}
		});
	}

    var media_type = $(".chooseMedia").val();

	callAjaxWithRes("{{ route('coach.ajax.my-courses.preview.media-intro-type') }}", {
        "media_type" : media_type,
    }, '#media_res');

    $(".chooseMedia").on('change', function(e){
		e.preventDefault();

		var media_type = $(this).val();

		callAjaxWithRes("{{ route('coach.ajax.my-courses.preview.media-intro-type') }}", {
            "media_type" : media_type,
        }, '#media_res');
	});

    var my_course_id = $("#preview_current_intro_media").data("my-course-id");

    callAjaxWithRes("{{ route('coach.ajax.my-courses.preview.current-media-intro') }}", {
        "my_course_id" : my_course_id,
    }, '#preview_current_intro_media');

    CKEDITOR.replace( 'description' );

    // update my course
    $("#updateCourse").on('submit', function(e){
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
            url : "{{ route('coach.ajax.my-course.update') }}",
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
            error: function (xhr, ajaxOptions, thrownError) {
                $("#loading").modal('hide');
                $("#error").modal({backdrop: 'static', keyboard: false});
                $("#error").modal('show');
            }
        });
    });

    // delete my course
    $('#deleteCourse').on('click', function(e){
        e.preventDefault();
        
        var my_course_id = $(this).data("my-course-id");

        $("#deleteCourseModal").modal('show');

        $("#confirmdeleteCourseID").val(my_course_id);
    });

    // confirm to delete my course
    $("#confirmdeleteCourse").on('click', function(e){
        e.preventDefault();

        var my_course_id = $("#confirmdeleteCourseID").val();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        $("#deleteCourseModal").hide();
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('coach.ajax.my-course.delete') }}",
            type : "POST",
            data : {
				"_token" : "{{ csrf_token() }}",
				"my_course_id" : my_course_id,
			},
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                    $("#deleteCourseModal").show();
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#loading").modal('hide');
                $("#error").modal({backdrop: 'static', keyboard: false});
                $("#error").modal('show');
            }
        });
    });

    // create content for my course
    $("#createNewContent").on('submit', function(e){
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
                        $("#createNewContentModal").hide();
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('coach.ajax.my-course.content.create') }}",
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
                    $("#createNewContentModal").show();
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#loading").modal('hide');
                $("#error").modal({backdrop: 'static', keyboard: false});
                $("#error").modal('show');
            }
        });
    });

    // upddate content title
    $(".updateContentTitle").on('keyup', function(e){
        e.preventDefault();

        var content_id = $(this).data("content-id");
        var content_title = $(this).text();

        $.ajax({
            url : "{{ route('coach.ajax.my-course.content.title.update') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "content_id" : content_id,
                "content_title" : content_title,
            }
        });
    });

    // update content description
    $(".updateContentDescription").on('keyup', function(e){
        e.preventDefault();

        var content_id = $(this).data("content-id");
        var content_description = $(this).text();

        $.ajax({
            url : "{{ route('coach.ajax.my-course.content.title.description') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "content_id" : content_id,
                "content_description" : content_description,
            }
        });
    });

    // delete my course content
    $('.deleteContent').on('click', function(e){
        e.preventDefault();
        
        var content_id = $(this).data("content-id");

        $("#deleteContentModal").modal('show');

        $("#confirmDeleteContentID").val(content_id);
    });

    // confirm delete my course content
    $("#confirmDeleteContent").on('click', function(e){
        e.preventDefault();

        var content_id = $("#confirmDeleteContentID").val();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        $("#deleteContentModal").hide();
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('coach.ajax.my-course.content.title.delete') }}",
            type : "POST",
            data : {
				"_token" : "{{ csrf_token() }}",
				"content_id" : content_id,
			},
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                    $("#deleteContentModal").show();
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#loading").modal('hide');
                $("#error").modal({backdrop: 'static', keyboard: false});
                $("#error").modal('show');
            }
        });
    });

    // open modal to add new lesson
    $('.addNewLessonBtn').on('click', function(e){
        e.preventDefault();
        
        var content_id = $(this).data("content-id");

        $("#createNewLessonModal").modal('show');

        $("#content_id").val(content_id);
    });

    $('.repeater-default').repeater({
		show: function () {
			$(this).slideDown();
		},
		hide: function(remove) {
			if (confirm('هل تريد ازاله هذا الحقل ؟')) {
				$(this).slideUp(remove);
			}
		},
        isFirstItemUndeletable: true,
	});

    // upload new lessons
    $(".addNewLessons").on('submit', function(e){
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
                        $("#createNewLessonModal").modal('hide');
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('coach.ajax.my-course.content.lesson.create') }}",
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
            error: function (xhr, ajaxOptions, thrownError) {
                $("#loading").modal('hide');
                $("#error").modal({backdrop: 'static', keyboard: false});
                $("#error").modal('show');
            }
        });
    });

    // update lesson title
    $(document).on('keyup', '.updateLessonTitle', function(e){
        e.preventDefault();

        var lesson_id = $(this).data("lesson-id");
        var lesson_title = $(this).text();

        $.ajax({
            url : "{{ route('coach.ajax.my-course.content.lesson.title.update') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "lesson_id" : lesson_id,
                "lesson_title" : lesson_title,
            }
        });
    });

    // update video details
    $(document).on('submit', '#updateVideo', function(e){
        e.preventDefault();

        $.ajax({
            url : "{{ route('coach.ajax.my-course.content.lesson.video.update') }}",
            type : "POST",
            data : new FormData(this),
            contentType : false,
            processData : false,
            cache : false,
            beforeSend : function()
            {
                $("#update_video_res").html('يتم تحديث بيانات الفيديو ... برجاء الانتظار');
                $("#updateVideoBtn").prop("disabled", true);
                $("#updateVideoBtn").text("Uploading...");
            },
            success : function(data)
            {
                $("#update_video_res").html(data);
                $("#updateVideoBtn").prop("disabled", false);
                $("#updateVideoBtn").text("Update");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#loading").modal('hide');
                $("#error").modal({backdrop: 'static', keyboard: false});
                $("#error").modal('show');
            }
        });
    });

    // open modal to preview lesson
    $('.previewLesson').on('click', function(e){
        e.preventDefault();
        
        $("#previewLessonModal").modal('show');

        var lesson_id = $(this).data("lesson-id");

        callAjaxWithRes("{{ route('coach.ajax.my-course.content.lesson.preview') }}", {
            "lesson_id" : lesson_id,
        }, '#preview_lesson');
    });

    // Switch to lock or unlock lesson
    $(".lockOrUnlockLesson").on('change', function(){

        var lesson_id = $(this).data("lesson-id");

        var route = "{{ route('coach.ajax.my-course.content.lesson.lock-or-unlock') }}";

        $(this).is(':checked') ? callAjax(route, {'lesson_id' : lesson_id, 'isLocked' : true}) : callAjax(route, {'lesson_id' : lesson_id, 'isLocked' : false});
    });

    // delete lesson
    $(document).on('click', '.deleteLesson', function(e){
        e.preventDefault();

        var lesson_id = $(this).data("lesson-id");

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        $("#previewLessonModal").hide();
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('coach.ajax.my-course.content.lesson.delete') }}",
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
                    $("#deleteContentModal").show();
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#loading").modal('hide');
                $("#error").modal({backdrop: 'static', keyboard: false});
                $("#error").modal('show');
            }
        });
    });
});
</script>