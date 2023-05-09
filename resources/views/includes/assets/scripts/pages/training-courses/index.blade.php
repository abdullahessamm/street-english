<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$('#training-courses').DataTable({
    'iDisplayLength': 4,
    "language": {
        "emptyTable" : "There's no Training Courses in your database",
    },
    processing : true,
    serverSide : true,
    ajax : "{{ route('ajax.training-courses.index') }}",
    columns : [
        { data : 'name', name : 'name' },
        { data : 'created_at', name : 'created_at' },
    ],
});

$(document).on('click', '.deleteStudent', function(e){
    e.preventDefault();

    var courses_id = $(this).attr("data-courses-id");

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
        url : "{{ route('ajax.training-course.delete') }}",
        type : "POST",
        data : {
            "_token" : "{{ csrf_token() }}",
            "courses_id" : courses_id,
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