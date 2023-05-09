<script src="{{ asset('app-assets/vendors/js/forms/listbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script>
$(document).ready(function(){
    function callAjax(route, data, res)
	{
		$.ajax({
			url : route,
			type : "POST",
			data : {
				"_token" : "{{ csrf_token() }}",
				"data" : data
			},
			beforeSend : function()
			{
				$(res).html('<div class="text-center"><h4>Please wait...</h4></div>');
			},
			success : function(data)
			{
				$(res).html(data);
			}
		});
	}

    var media_type = $(".chooseMedia").val();

	callAjax("{{ route('ajax.courses.preview.media-intro-type') }}", {
        'media_type' : media_type
    }, '#media_res');

    $(".chooseMedia").on('change', function(e){
		e.preventDefault();

		var media_type = $(this).val();

		callAjax("{{ route('ajax.courses.preview.media-intro-type') }}", {
            'media_type' : media_type
        }, '#media_res');
	});

    var price_option = $(".choosePriceOption").val();

    callAjax("{{ route('ajax.courses.preview.price-option') }}", {
        'price_option' : price_option,
    }, '#price_option_res');

    $(".choosePriceOption").on('change', function(e){
		e.preventDefault();

		var price_option = $(this).val();

		callAjax("{{ route('ajax.courses.preview.price-option') }}", {
            'price_option' : price_option,
        }, '#price_option_res');
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
            url : "{{ route('ajax.course.create') }}",
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
            error: function()
            {
                $("#loading").modal('hide');
                $("#errorModal").modal('show');
            }
        });
    });
});
</script>