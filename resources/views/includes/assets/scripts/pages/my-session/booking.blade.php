<script>
$(document).ready(function(){

    $('#deleteBookingAppointment').on('click', function(e){
        e.preventDefault();
        
        var appointment_booking_id = $(this).data("appointment-booking-id");

        $("#deleteBookingAppointmentModal").modal('show');

        $("#confirmdeleteBookingAppointmentID").val(appointment_booking_id);
    });

    $("#confirmdeleteBookingAppointment").on('click', function(e){
        e.preventDefault();

        var appointment_booking_id = $("#confirmdeleteBookingAppointmentID").val();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        $("#deleteBookingAppointmentModal").hide();
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.my-session.delete.appointment.booking') }}",
            type : "POST",
            data : {
				"_token" : "{{ csrf_token() }}",
				"appointment_booking_id" : appointment_booking_id,
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