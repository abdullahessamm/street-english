<script src="{{ asset('public/assets/js/jquery.steps.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.validate.min.js') }}"></script>
<script>
$(document).ready(function(){

    $.ajax({
        type : "POST",
        url : "{{ route('ajax.student.my-course.display-lesson') }}",
        data : {
            "_token" : "{{ csrf_token() }}",
            "lesson_id" : "{{ $lesson->id }}"
        },
        success: function(data)
        {
            $("#display_lesson").html(data);
        },
        error: function()
        {
            $("#display_lesson").html(`
            <div class="text-center">
                <i class="fa fa-times text-danger" style="font-size: 100px;"></i>
                <h3>Error in displaying course</h3>
            </div>
            `);
        }
    });

    $("#finish-lesson").on('click', function(e){
        e.preventDefault();

        var course_id = $(this).data("course-id");
        var lesson_id = $(this).data("lesson-id");
        var user_id = $(this).data("user-id");

        $.ajax({
            type : "POST",
            url : "{{ route('ajax.student.my-course.lesson.finish') }}",
            data : {
                "_token" : "{{ csrf_token() }}",
                "lesson_id" : lesson_id,
                "user_id" : user_id,
                "course_id" : course_id,
            },
            success: function(data)
            {
                $("#display_lesson").html(data);
            }
        });
    });

    $("#go-next-lesson").on('click', function(e){
        e.preventDefault();

        var course_id = $(this).data("course-id");
        var next_lesson_slug = $(this).data("next-lesson-slug");
        var user_id = $(this).data("user-id");

        $.ajax({
            type : "POST",
            url : "{{ route('ajax.student.my-course.lesson.next') }}",
            data : {
                "_token" : "{{ csrf_token() }}",
                "course_id" : course_id,
                "user_id" : user_id,
                "next_lesson_slug" : next_lesson_slug,
            },
            success: function(data)
            {
                $("#display_lesson").html(data);
            }
        });
    });

    $("#joinPlacementTest").on('submit', function(e){
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
                        $("#loginToBuyCourseModal").modal('hide');

                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.join.placement-test') }}",
            type :'POST',
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
});
</script>