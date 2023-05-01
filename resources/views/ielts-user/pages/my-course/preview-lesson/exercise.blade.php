@php
    $x = 0;
@endphp
@if($lesson->exercise->courseLessonExerciseUser != null && $lesson->exercise->courseLessonExerciseUser->user_id == Auth::guard('ielts_user')->user()->id)

@php
$x = 0;
@endphp

@foreach($lesson->exercise->courseLessonExerciseUser->exerciseAnswers as $eachQuestionAndAnswer)
{{ $eachQuestionAndAnswer->id }}
<div class="row">
    <div class="col-6">
        <h3 class="float-left" style="color: #18a674;font-weight: bold;">Question {{ $x++ + 1 }} </h3>
    </div>
    <div class="col-6 text-right">
        <h3>Score {!! $eachQuestionAndAnswer->score == 0 ? '<span class="text-danger" style="font-weight: bold;">0 / '.$eachQuestionAndAnswer->belongsToExamQuestion->score.'</span>' : '<span style="color: #18a674;font-weight: bold;">'.$eachQuestionAndAnswer->score.' / '.$eachQuestionAndAnswer->belongsToExamQuestion->score.'</span>' !!}</h3>
    </div>
</div>
<h4 style="color: #1E284B;" class="mt-1">{{ $eachQuestionAndAnswer->belongsToExamQuestion->question }}</h4>
{{-- <h4 style="color: #1E284B;" class="mt-1">
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
</h4> --}}
<div class="mt-3">
<h4>Your answer : {!! $eachQuestionAndAnswer->belongsToExamAnswer != null ? '<span style="color: #18a674;font-weight: bold;">'.$eachQuestionAndAnswer->belongsToExamAnswer->answer.'</span>' : '<span class="text-danger">No Answer</span>' !!}</h4>
<h4 style="color: #18a674;font-weight: bold;">
    The Correct Answer : {{ $eachQuestionAndAnswer->belongsToCorrectAnswer->belongsToExamAnswer->answer }}
</h4>
</div>
<hr style="border: 1px solid #1E284B;">
@endforeach


@else

<form action="#" class="steps-validation wizard-circle" id="createNewExamForm">
@foreach($lesson->exercise->belongsToExam->sections as $section)
    @foreach ($section->questions as $eachQuestion)
    <h4></h4>
    <fieldset>
        <h3 class="my-1 font-weight-bold" style="color: #1E284B;">{{ $section->section_name }}</h3>
        <div class="row p-1">
            <div class="col-12">
                <h3 class="questions" data-question-id="{{ $eachQuestion->id }}">
                    <span class="font-weight-bold" style="color: #18a674;">Question {{ ++$x }} :</span> <span style="color: #1E284B;">{{ $eachQuestion->question }}</span>
                </h3>
            </div>
            <div class="col-12 px-3">
                @foreach($eachQuestion->answers as $answer)
                <div class="form-check my-1">
                    <input class="form-check-input questions-and-answers question_{{$eachQuestion->id }}" type="radio" name="{{ $eachQuestion->id }}" id="{{ $answer->id }}" value="{{ $answer->id }}" data-question-id="{{ $eachQuestion->id }}">
                    <label class="form-check-label font-weight-bold" for="{{ $answer->id }}" style="color: #18a674;font-size: 20px;">
                        {{ $answer->answer }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>
    </fieldset>
    @endforeach
@endforeach
<div id="hint"></div>
</form>

<script src="{{ asset('public/assets/js/jquery.steps.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.validate.min.js') }}"></script>
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

        /*$(".questions-and-answers").each(function(){

            if($(this).is(':checked')){

                var answer = $(this).val();
                var question = $(this).data('question-id');
            
                question_and_answers = {
                    "question" : question,
                    "answer" : answer,
                }

                my_answers.push(question_and_answers);

            }
        });


        if(my_answers.length == 0){

            $("#answerAtLeastOneQuestionModal").modal('show');

        }else{

        }*/

        $.ajax({
            type : "POST",
            url : "{{ route('ajax.placement-test.submit-answers') }}",
            data : {
                "_token" : "{{ csrf_token() }}",
                "user_id" : "{{ Auth::guard('ielts_user')->user()->id }}",
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