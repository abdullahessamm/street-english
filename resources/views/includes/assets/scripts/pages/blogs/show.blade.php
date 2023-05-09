<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
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
				$("#media_res").html('<div class="text-center"><h4>Previewing media type, Please wait...</h4></div>');
			},
			success : function(data)
			{
				$("#media_res").html(data);
			}
		});
	}

	$(".select2").select2();

    CKEDITOR.replace( 'content' );

	var media_type = $(".chooseMedia").val();

	callAjax("{{ route('ajax.blogs.preview.media-type') }}", media_type);
	
	$(".chooseMedia").on('change', function(e){
		e.preventDefault();

		var media_type = $(this).val();

		callAjax("{{ route('ajax.blogs.preview.media-type') }}", media_type);
	});

    $("#updatePost").on('submit', function(e){
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
			url : "{{ route('ajax.blog.update') }}",
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

	$("#deletePost").on('click', function(e){
		e.preventDefault();

		var post_id = $(this).attr("data-post-id");

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
			url : "{{ route('ajax.blog.delete') }}",
			type : "POST",
			data : {
				"_token" : "{{ csrf_token() }}",
				"post_id" : post_id,
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

});
</script>
