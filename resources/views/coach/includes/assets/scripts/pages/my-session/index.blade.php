<script src="{{ asset('assets/dashboard/js/jquery.repeater.min.js') }}"></script>
<script>
$(document).ready(function(){
    $("#resModal").appendTo("body");
    $("#loading").appendTo("body");
    $("#deleteMySessionModal").appendTo("body");

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

	// create new session
	$("#createNewSession").on('submit', function(e){
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
            url : "{{ route('coach.ajax.my-session.create') }}",
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

	// delete session
	$('.deleteMySession').on('click', function(e){
        e.preventDefault();
        
        var my_session_id = $(this).data("my-session-id");

        $("#deleteMySessionModal").modal('show');

        $("#confirmDeleteMySessionID").val(my_session_id);
    });

	// confirm to delete my session with all it's appointments & dates
	$("#confirmDeleteMySession").on('click', function(e){
        e.preventDefault();

        var my_session_id = $("#confirmDeleteMySessionID").val();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        $("#deleteMySessionModal").hide();
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('coach.ajax.my-session.delete') }}",
            type : "POST",
            data : {
				"_token" : "{{ csrf_token() }}",
				"my_session_id" : my_session_id,
			},
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                    $("#deleteMySessionModal").show();
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