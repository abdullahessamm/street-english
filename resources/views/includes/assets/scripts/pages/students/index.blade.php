<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$('#students').DataTable({
    'iDisplayLength': 4,
    "language": {
        "emptyTable" : "There's no Students in your database",
    },
    processing : true,
    serverSide : true,
    ajax : "{{ route('ajax.students.index') }}",
    columns : [
        { data : 'name', name : 'name' },
        { data : 'created_at', name : 'created_at' },
        { data : 'updated_at', name : 'updated_at' },
        { data : 'delete_student', name : 'name' },
    ],
});

$(document).on('click', '.deleteStudent', function(e){
    e.preventDefault();

    var student_id = $(this).attr("data-student-id");

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
        url : "{{ route('ajax.student.delete') }}",
        type : "POST",
        data : {
            "_token" : "{{ csrf_token() }}",
            "student_id" : student_id,
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