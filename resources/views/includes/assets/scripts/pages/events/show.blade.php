<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script>
$(document).ready(function(){
    $('#event-users').DataTable({
        'iDisplayLength': 4,
        "language": {
            "emptyTable" : "There's no users for this event",
        }
    });

    CKEDITOR.replace( 'event_description' );

	$("#updateEvent").on('submit', function(e){
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
			url : "{{ route('ajax.event.update') }}",
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
    
    $("#delete-event").on('click', function(e){
		e.preventDefault();

		var event_id = $(this).data("event-id");

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
			url : "{{ route('ajax.event.delete') }}",
			type : "POST",
			data : {
                "_token" : "{{ csrf_token() }}",
                "event_id" : event_id,
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
			error: function()
			{
				$("#loading").modal('hide');
				$("#errorModal").modal('show');
			}
		});
	});
});
</script>