<script src="https://unpkg.com/survey-jquery@1.9.34/survey.jquery.min.js"></script>
<script>
Survey.StylesManager.applyTheme("defaultV2");

window.survey = new Survey.Model({!! $exersice_json_file !!});

$("#surveyElement").Survey({model: survey});

// Use onComplete to get survey.data to pass it to the server.
survey.onComplete.add(function (sender) {
    var mySurvey = sender;
    var surveyData = sender.data;

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
        url : "{{ route('ajax.submit-session-exersice') }}",
        type :'POST',
        data : {
            "_token" : "{{ csrf_token() }}",
            "live_course_user_id" : "{{ Auth::guard('live_course_user')->user()->id }}",
            "exercise_id" : "{{ $myZoomCourseSession->exersice->id }}",
            "surveyData" : surveyData,
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
});

$("#start-exercise").on('click', function(e){
    e.preventDefault();
    
    var live_course_user_id = $(this).data('live-course-user-id');
    var zoom_course_session_id = $(this).data('zoom-course-session-id');

    $.ajax({
        type : "POST",
        url : "{{ route('ajax.start-session-exersice') }}",
        data : {
            "_token" : "{{ csrf_token() }}",
            "live_course_user_id" : live_course_user_id,
            "exersice_id" : "{{ $myZoomCourseSession->exersice->id }}",
        },
        success : function(data)
        {
            $("#hint").html(data);
        }
    });
});
</script>