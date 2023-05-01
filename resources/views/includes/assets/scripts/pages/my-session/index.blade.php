<script src="{{ asset('assets/js/zabuto_calendar.min.js') }}"></script>

<script>
$(document).ready(function(){
    if($(".calendar").length)
    {
        $(".calendar").zabuto_calendar({
            language: "ar",
            action: function () {
                return checkDate(this.id);
            },
            ajax: { 
                url: "{{ route('calendar') }}", 
                modal: true
            },
            // data: eventData,
            nav_icon: {
                prev: '<i class="fa fa-arrow-left"></i>',
                next: '<i class="fa fa-arrow-right"></i>'
            }
        });
    }
    
    function checkDate(id) {
        var date = $("#" + id).data("date");
        var hasEvent = $("#" + id).data("hasEvent");
        
        if(hasEvent){
            $.ajax({
                'type' : 'POST',
                'url' : "{{ route('calendar.appointments') }}",
                'data' : {
                    '_token' : "{{ csrf_token() }}",
                    'date' : date,
                },
                beforeSend : function()
                {
                    $("#appointments").html('<h3 class="text-center">يتم عرض المواعيد برجاء الاتظار...</h3>');
                },
                success : function(data)
                {
                    $("#appointmentModal").modal('show');
                    $("#appointmentModal").modal({backdrop: 'static', keyboard: false});
                    $("#appointments").html(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $("#appointmentModal").modal('hide');
                    $("#error").modal({backdrop: 'static', keyboard: false});
                    $("#error").modal('show');
                }
            });
        }
    }

    $(document).on('submit', '#bookMeeting', function(e){
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
                        $("#appointmentModal").modal('hide');
    
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('calendar.book.appointment') }}",
            type :'POST',
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