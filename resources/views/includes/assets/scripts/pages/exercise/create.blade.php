<script src="https://unpkg.com/knockout@3.5.1/build/output/knockout-latest.js"></script>
<script src="https://unpkg.com/survey-core@1.9.34/survey.core.min.js"></script>
<script src="https://unpkg.com/survey-core@1.9.34/survey.i18n.min.js"></script>
<script src="https://unpkg.com/survey-knockout-ui@1.9.34/survey-knockout-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.10/ace.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.10/ext-language_tools.js" type="text/javascript" charset="utf-8"></script>
<script src="https://unpkg.com/survey-creator-core@1.9.34/survey-creator-core.min.js"></script>
<script src="https://unpkg.com/survey-creator-core@1.9.34/survey-creator-core.i18n.min.js"></script>
<script src="https://unpkg.com/survey-creator-knockout@1.9.34/survey-creator-knockout.min.js"></script>
<script src="{{ asset('assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
<script>
$(document).ready(function(){
    
    const options = {
        showLogicTab: true
    };

    var creator = new SurveyCreator.SurveyCreator(options);

    creator.render("creatorElement");

    // create new exercise
    $("#create-exercise").on('submit', function(e){
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
            url : "{{ route('ajax.exercise.create') }}",
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
});
</script>