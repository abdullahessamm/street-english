<script src="{{ asset('public/assets/js/jquery.steps.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.validate.min.js') }}"></script>
<script>
$(document).ready(function(){

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
                    "placement_test_user_id" : "{{ $placementTestUser->id }}",
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

});
</script>