<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
<script>
$(document).ready(function(){
	$('#public-certificates').DataTable({
		'iDisplayLength': 4,
		"language": {
			"emptyTable" : "There's no public certificates for this user",
		},
	});

    $('.repeater-default').repeater({
		show: function () {
			$(this).slideDown();
		},
		hide: function(remove) {
			if (confirm('Are you sure you want to remove this item?')) {
				$(this).slideUp(remove);
			}
		},
        isFirstItemUndeletable: true,
	});

	$("#appendPublicCertificate").on('submit', function(e){
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
            url : "{{ route('ajax.public-certificate.append') }}",
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
                $("#errorModal").modal('show');
			}
        });
    });
	
	$(document).on('click', ".delete-public-certificate", function(e){
        e.preventDefault();

		var public_certificate_id = $(this).data("public-certificate-id");

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
            url : "{{ route('ajax.public-certificate.delete') }}",
            type : "POST",
            data : {
				"_token" : "{{ csrf_token() }}",
				"public_certificate_id" : public_certificate_id,
			},
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
					$("#tr_public_certificate_"+public_certificate_id).remove();
                });
            },
			error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#errorModal").modal('show');
			}
        });
    });

	$("#delete-all-certificate").on('click', function(e){
        e.preventDefault();

		var public_certificate_link_id = $(this).data("public-certificate-link-id");

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
            url : "{{ route('ajax.public-certificate.delete-all') }}",
            type : "POST",
            data : {
				"_token" : "{{ csrf_token() }}",
				"public_certificate_link_id" : public_certificate_link_id,
			},
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
					$("#tr_public_certificate_"+public_certificate_id).remove();
                });
            },
			error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#errorModal").modal('show');
			}
        });
    });
});
</script>