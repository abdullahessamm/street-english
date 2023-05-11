<script>
$(document).ready(function(){

    $("#start-course").on('click', function(e){
        e.preventDefault();

        var course_id = $(this).data("course-id");
        var lesson_id = $(this).data("lesson-id");
        var user_id = $(this).data("user-id");

        $.ajax({
            type : "POST",
            url : "{{ route('ajax.student.my-course.start') }}",
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
});
</script>