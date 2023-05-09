<script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/toggle/switchery.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
<script>
$(document).ready(function(){
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
            error: function()
            {
                $("#loading").modal('hide');
                $("#errorModal").modal('show');
            }
        });
	}

    $('.repeater-default').repeater({
		show: function () {
			$(this).slideDown();
		},
		hide: function(remove) {
			if (confirm('Are you sure you want to remove this item?')) {
				$(this).slideUp(remove);
			}
		},
        isFirstItemUndeletable: true,
	});

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

    $("#openNewContentModalForm").on('click', function(){
        $("#createNewContentModal").modal('show');
    });

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
            url : "{{ route('ajax.ietls-course.content.create') }}",
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
            error: function()
            {
                $("#loading").modal('hide');
                $("#errorModal").modal('show');
            }
        });
    });

    $(".updateContentTitle").on('keyup', function(e){
        e.preventDefault();

        var content_id = $(this).data("content-id");
        var content_title = $(this).text();

        $.ajax({
            url : "{{ route('ajax.ietls-course.content.title.update') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "content_id" : content_id,
                "content_title" : content_title,
            }
        });
    });
    
    $(".updateContentDescription").on('keyup', function(e){
        e.preventDefault();

        var content_id = $(this).data("content-id");
        var content_description = $(this).text();

        $.ajax({
            url : "{{ route('ajax.ietls-course.content.description.update') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "content_id" : content_id,
                "content_description" : content_description,
            }
        });
    });

    $('.deleteContent').on('click', function(e){
        e.preventDefault();
        
        var content_id = $(this).data("content-id");

        $("#deleteContentModal").modal('show');

        $("#confirmDeleteContentID").val(content_id);
    });

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
            url : "{{ route('ajax.ietls-course.content.delete') }}",
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
            error: function()
            {
                $("#loading").modal('hide');
                $("#errorModal").modal('show');
            }
        });
    });

    
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
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.ietls-course.content.lesson.create') }}",
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
            error: function()
            {
                $("#loading").modal('hide');
                $("#errorModal").modal('show');
            }
        });
    });

    $(".updateLessonTitle").on('keyup', function(e){
        e.preventDefault();

        var lesson_id = $(this).data("lesson-id");
        var lesson_title = $(this).text();

        $.ajax({
            url : "{{ route('ajax.ietls-course.content.lesson.title.update') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "lesson_id" : lesson_id,
                "lesson_title" : lesson_title,
            }
        });
    });
    
    $(".deleteLesson").on('click', function(e){
        e.preventDefault();

        var lesson_id = $(this).data("lesson-id");

        $.ajax({
            url : "{{ route('ajax.ietls-course.content.lesson.delete') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "lesson_id" : lesson_id,
            },
            beforeSend: function(){
                $(this).prop("disabled", true);
                $(this).text("Deleting this lesson, please wait...");
            },
            success: function(data)
            {
                $("#tr_lesson_"+lesson_id).remove();
            },
            error: function()
            {
                $("#loading").modal('hide');
                $("#errorModal").modal('show');
            }
        });
    });

    $(".previewLessonVideo").on('click', function(){
        var lesson_id = $(this).data("lesson-id");

        callAjax("{{ route('ajax.ietls-course.content.lesson.preview-video') }}", {'lesson_id' : lesson_id}) 
    });

    $(document).on('submit', '#updateVideo', function(e){
        e.preventDefault();

        $.ajax({
            url : "{{ route('ajax.ietls-course.content.lesson.video.update') }}",
            type : "POST",
            data : new FormData(this),
            contentType : false,
            processData : false,
            cache : false,
            beforeSend : function()
            {
                $("#update_video_res").html('Uploading video... please wait');
                $("#updateVideoBtn").prop("disabled", true);
                $("#updateVideoBtn").text("Uploading...");
            },
            success : function(data)
            {
                $("#update_video_res").html(data);
                $("#updateVideoBtn").prop("disabled", false);
                $("#updateVideoBtn").text("Update");
            },
            error: function()
            {
                $("#loading").modal('hide');
                $("#errorModal").modal('show');
            }
        });
    });

    $(".lockOrUnlockLesson").on('change', function(){

        var lesson_id = $(this).data("lesson-id");

        var route = "{{ route('ajax.ietls-course.content.lesson.lock-or-unlock-lesson') }}";

        $(this).is(':checked') ? callAjax(route, {'lesson_id' : lesson_id, 'isLocked' : true}) : callAjax(route, {'lesson_id' : lesson_id, 'isLocked' : false});
    });
});
</script>