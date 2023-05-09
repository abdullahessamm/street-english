<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script>
$(document).ready(function(){

	function callAjax(route, exam_time_type)
	{
		$.ajax({
			url : route,
			type : "POST",
			data : {
				"_token" : "{{ csrf_token() }}",
				"exam_time_type" : exam_time_type
			},
			beforeSend : function()
			{
				$("#choose_time_res").html('<div class="text-center"><h4>Previewing media type, Please wait...</h4></div>');
			},
			success : function(data)
			{
				$("#choose_time_res").html(data);
			}
		});
	}

	callAjax("{{ route('exam.choose-time-type') }}", 'specific_date_and_time');
	
	$(".chooseExamTimeType").on('change', function(){
		
		var exam_time_type = $(this).val();

		callAjax("{{ route('exam.choose-time-type') }}", exam_time_type);
	});


	$("#createNewWExam").on('submit', function(e){
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
			url : "{{ route('ajax.exam.create') }}",
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
});
</script>