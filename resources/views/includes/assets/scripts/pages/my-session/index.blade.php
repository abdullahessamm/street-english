<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$('#my-sessions').DataTable({
    'iDisplayLength': 4,
    "language": {
        "emptyTable" : "لا يوجد جلسات في قاعدة البيانات",
    },
    processing : true,
    serverSide : true,
    ajax : "{{ route('ajax.my-sessions.index') }}",
    columns : [
        { data : 'name', name : 'name' },
        { data : 'session_dates', name : 'name' },
        { data : 'delete_session', name : 'name' },
    ],
});

$(document).on('click', '.deleteStudent', function(e){
    e.preventDefault();

    var coach_id = $(this).attr("data-coach-id");

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
        url : "{{ route('ajax.coach.delete') }}",
        type : "POST",
        data : {
            "_token" : "{{ csrf_token() }}",
            "coach_id" : coach_id,
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
</script>