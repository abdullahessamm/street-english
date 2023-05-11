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
});
</script>

@if($lesson->exercise != null)
<script>
// Show form
var form = $(".steps-validation").show();

$(".steps-validation").steps({
    headerTag: "h4",
    bodyTag: "fieldset",
    labels: {
        finish: 'Submit'
    },
    // onInit: function (event, current) {
    //     $('ul[role="tablist"]').attr('style', 'display:none');
    // },
    onStepChanging: function (event, currentIndex, newIndex)
    {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex)
        {
            return true;
        }
        // Forbid next action on "Warning" step if the user is to young
        if (newIndex === 3 && Number($("#age-2").val()) < 18)
        {
            return false;
        }
        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex)
        {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
        var my_answers = [];

        $(".questions").each(function(){

            if($(".question_"+$(this).data('question-id')).is(':checked')){

                var question = $(this).data('question-id');
                var answer = $(".question_"+$(this).data('question-id')+":checked").val();

                question_and_answers = {
                    'question' : question,
                    'answer' : answer,
                }

            }else{
                
                var question = $(this).data('question-id');
                var answer = null;

                question_and_answers = {
                    'question' : question,
                    'answer' : answer,
                }
            }
            
            my_answers.push(question_and_answers);
        });

        console.log(my_answers);

        $.ajax({
            type : "POST",
            url : "{{ route('ajax.student.my-course.lesson.exercise.finish') }}",
            data : {
                "_token" : "{{ csrf_token() }}",
                "user_id" : "{{ Auth::user()->id }}",
                "exercise_id" : "{{ $lesson->exercise->id }}",
                "my_answers" : my_answers,
            },
            success : function(data)
            {
                $("#hint").html(data);
            }
        });
    }
});

$('ul[role="tablist"]').hide();

// Initialize validation
$(".steps-validation").validate({
    ignore: 'input[type=hidden]', // ignore hidden fields
    errorClass: 'danger',
    successClass: 'success',
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    errorPlacement: function(error, element) {
        error.insertAfter(element);
    },
    rules: {
        email: {
            email: true
        }
    }
});
</script> 
@endif