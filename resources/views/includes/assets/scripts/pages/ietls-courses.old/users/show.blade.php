<script>
	$(document).ready(function(){
		// update ZoomCourseUser info
		$("#updateIETLSCourseUserInfo").on('submit', function(e){
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
				url : "{{ route('ajax.ietls-course.user.update-info') }}",
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
	
		// update ZoomCourseUser image
		$("#updateZoomCourseUserImage").on('submit', function(e){
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
				url : "{{ route('ajax.ietls-course.user.update-image') }}",
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
	
		// delete ZoomCourseUser info
		$("#deleteIETLSCourseUser").on('click', function(e){
			e.preventDefault();
	
			var ietls_course_user_id = $(this).data("ietls-course-user-id");
	
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
				url : "{{ route('ajax.ietls-course.user.delete') }}",
				type : "POST",
				data : {
					"_token" : "{{ csrf_token() }}",
					"ietls_course_user_id" : ietls_course_user_id,
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
		})
	});
	</script>