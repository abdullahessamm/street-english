<script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/toggle/switchery.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script>
$(document).ready(function(){
    $(".select2").select2();

    // Switchery
    var i = 0;
    
    if (Array.prototype.forEach) 
    {
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
    } 
    else
    {
        var elems1 = document.querySelectorAll('.switchery');

        for (i = 0; i < elems1.length; i++) {
            var $size = elems1[i].data('size');
            var $color = elems1[i].data('color');
            var switchery = new Switchery(elems1[i], { color: '#37BC9B' });
        }
    }
    /*  Toggle Ends   */

    function sendAjax(route, exam_id)
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
                "exam_id" : exam_id,
            },
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            }
        });
    }

    // Set exam public or private
    $("#for_anyone").on('change', function(e){
        e.preventDefault();

        var exam_id = $(this).attr("data-exam-id");

        if($(this).is(":checked"))
        {
            sendAjax("{{ route('ajax.exam.public') }}", exam_id);
        }
        else
        {
            sendAjax("{{ route('ajax.exam.private') }}", exam_id);
        }
    });

    // Publis or Un-Publish Exam
    $("#publish").on('change', function(e){
        e.preventDefault();

        var exam_id = $(this).attr("data-exam-id");

        if($(this).is(":checked"))
        {
            sendAjax("{{ route('ajax.exam.publish') }}", exam_id);
        }
        else
        {
            sendAjax("{{ route('ajax.exam.un-publish') }}", exam_id);
        }
    });

    /*------------------------------------------ Start Update & Delete Exams ------------------------------------------*/
    $("#updateExam").on('submit', function(e){
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
            url : "{{ route('ajax.exam.update') }}",
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
            }
        });
    });

    $("#deleteExam").on('click', function(e){
		e.preventDefault();

        var exam_id = $(this).attr("data-exam-id");

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
			url : "{{ route('ajax.exam.delete') }}",
			type : "POST",
			data : {
                "_token" : "{{ csrf_token() }}",
                "exam_id" : exam_id, 
            },
			success : function(data)
			{
				$("#loading").modal('hide');
				$("#resModal").modal({backdrop: 'static', keyboard: false});
				$("#res").html(data);
				$("#onCloseModal").click(function(){
					$("#resModal").modal('hide');
				});
			}
		});
	});
    /*------------------------------------------ End Update & Delete Exams ------------------------------------------*/


    /*------------------------------------------ CRUD Exam Sections ------------------------------------------*/
    $("#createSectionBtn").on('click', function(){
        $("#createSectionModal").modal('show');
    });

    $("#createNewSection").on('submit', function(e){
        e.preventDefault();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#createSectionModal").modal('hide');
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.exam.section.create') }}",
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
            }
        });
    });
    
    $(".updateSection").on('click', function(e){
        e.preventDefault();

        var section_id = $(this).attr('data-section-id');
        var section_name = $("#section-name-"+section_id).text();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#createSectionModal").modal('hide');
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.exam.section.update') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "section_id" : section_id,
                "section_name" : section_name,
            },
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            }
        });
    });

    $(".deleteSection").on('click', function(e){
        e.preventDefault();

        var section_id = $(this).attr('data-section-id');

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#createSectionModal").modal('hide');
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.exam.section.delete') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "section_id" : section_id,
            },
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                    $("#section-"+section_id).remove();
                });
            }
        });
    });
    /*------------------------------------------ End CRUD Exam Sections ------------------------------------------*/


    /*------------------------------------------ CRUD Exam Questions & Answer ------------------------------------------*/
    var wrapper = $(".input_wrap");
    var add_button = $(".add_field_button");

    $(add_button).click(function (e) {
        e.preventDefault();
        var section_id = $(this).attr("data-section-id");

        $('.input_wrap_'+section_id).after('<div class="form-check mb-2"><label class="form-check-label"><input class="form-check-input chooseAnswer" type="radio" name="answers" required><span class="text-success">Write your answer : <br> </span> <span class="answer_'+section_id+'" contenteditable="true">Write your answer here</span></label><button class="float-right btn btn-danger btn-sm ml-1 remove_field">Remove</button></div>');
    });

    $(document).on("click",".remove_field",function(){
        $(this).parent().remove();
    });

    // create question
    $(".createQuestionAndAnswers").on('submit', function(e){
        e.preventDefault();

        var exam_id = $("#exam_id").val();
        
        var question = {};

        question.sectionID = $(this).find(".section_id").val();
        question.score = $(this).find(".score").val();
        question.question = $(this).find(".question").val();
        
        var answers = [];

        $('.answer_'+$(this).find(".section_id").val()).each(function(){
            var answer = $(this).text();

            answers.push(answer);
        });


        question.answers = answers;

        var correct_answer = $('.chooseAnswer:checked').closest('label').find('.answer_'+$(this).find(".section_id").val()).text();

        question.correct_answer = correct_answer;

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#createSectionModal").modal('hide');
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.exam.section.question.create') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "exam_id" : exam_id,
                "question" : question,
            },
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            }
        });
    });

    // delete question
    $(document).on('click', '.deleteQuestion', function(e){
        e.preventDefault();

        var exam_id = $(this).attr("data-exam-id");
        var section_id = $(this).attr("data-section-id");
        var question_id = $(this).attr("data-question-id");

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#createSectionModal").modal('hide');
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.exam.section.question.delete') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "exam_id" : exam_id,
                "section_id" : section_id,
                "question_id" : question_id,
            },
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                    $("#question_"+question_id).remove();
                });
            }
        });
    });

    // update score
    $(".updateScore").on('keypress', function(e){
        if (isNaN(String.fromCharCode(e.which))) e.preventDefault();
    });

    $('.updateScore').on('keyup', function(){
        var exam_id = $(this).attr("data-exam-id");
        var section_id = $(this).attr("data-section-id");
        var question_id = $(this).attr("data-question-id");
        var score = $(this).text();

        $.ajax({
            url : "{{ route('ajax.exam.question.score.update') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "exam_id" : exam_id,
                "section_id" : section_id,
                "question_id" : question_id,
                "score" : score,
            },
            success : function(data)
            {
                console.log(data);
            }
        });
    });
    
    // update question
    $('.updateQuestion').on('keyup', function(){
        var question_id = $(this).attr("data-question-id");
        var question = $(this).text();

        $.ajax({
            url : "{{ route('ajax.exam.section.question.update') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "question_id" : question_id,
                "question" : question,
            },
            success : function(data)
            {
                console.log(data);
            }
        });
    });
    
    // update answer
    $('.updateAnswer').on('keyup', function(){
        var answer_id = $(this).attr("data-answer-id");
        var answer = $("#answer_"+answer_id).text();

        $.ajax({
            url : "{{ route('ajax.exam.answer.update') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "answer_id" : answer_id,
                "answer" : answer,
            },
            success : function(data)
            {
                console.log(data);
            }
        });
    });
    
    // update correct answer
    $(document).on('click', '.deleteAnswer', function(e){
        e.preventDefault();

        var answer_id = $(this).attr("data-answer-id");
        var question_id = $(this).attr("data-question-id");

        $.ajax({
            url : "{{ route('ajax.exam.answer.delete') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "answer_id" : answer_id,
                "question_id" : question_id,
            },
            success : function(data)
            {
                $("#answer_"+answer_id+"_hint").html(data);
            }
        });
    });
    
    $(document).on('change', '.updateCorrectAnswer', function(e){
        e.preventDefault();

        var correct_answer_id = $(this).attr("data-correct-answer-id");
        var correct_answer = $(this).val();

        if($(this).is(":checked"))
        {
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) 
                    {
                        if (evt.lengthComputable) {
                            var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                            //Do something with upload progress here
                            $("#createSectionModal").modal('hide');
                            $("#loading").modal({backdrop: 'static', keyboard: false});
                            
                            $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                        }
                }, false);
                return xhr;
                },
                url : "{{ route('ajax.exam.correct-answer.update') }}",
                type : "POST",
                data : {
                    "_token" : "{{ csrf_token() }}",
                    "correct_answer_id" : correct_answer_id,
                    "correct_answer" : correct_answer,
                },
                success : function(data)
                {
                    $("#loading").modal('hide');
                    $("#resModal").modal({backdrop: 'static', keyboard: false});
                    $("#res").html(data);
                    $("#onCloseModal").click(function(){
                        $("#resModal").modal('hide');
                    });
                }
            });
        }
    });
    /*------------------------------------------ CRUD Exam Questions & Answer ------------------------------------------*/
});
</script>
