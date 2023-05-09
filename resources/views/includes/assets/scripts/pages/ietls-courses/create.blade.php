<script src="{{ asset('app-assets/vendors/js/forms/listbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script>
$(document).ready(function(){

    function callAjax(route, type)
	{
		$.ajax({
			url : route,
			type : "POST",
			data : {
				"_token" : "{{ csrf_token() }}",
				"type" : type
			},
			beforeSend : function()
			{
				$("#media_res").html('<div class="text-center"><h4>يتم عرض نوع الوسائط برجاء الانتظار</h4></div>');
			},
			success : function(data)
			{
				$("#media_res").html(data);
			}
		});
	}

    var media_type = $(".chooseMedia").val();

	callAjax("{{ route('ajax.ietls-courses.preview.media-intro-type') }}", media_type);

    $(".chooseMedia").on('change', function(e){
		e.preventDefault();

		var media_type = $(this).val();

		callAjax("{{ route('ajax.ietls-courses.preview.media-intro-type') }}", media_type);
	});
    
    $('.duallistbox').bootstrapDualListbox();

    $(".select2").select2();

    CKEDITOR.replace( 'description' );

    $("#createNewCourse").on('submit', function(e){
        e.preventDefault();

        for ( instance in CKEDITOR.instances )
        {
            CKEDITOR.instances[instance].updateElement();
        }

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
            url : "{{ route('ajax.ietls-course.create') }}",
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
			error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#error").modal('show');
			}
        });
    });
});
</script>