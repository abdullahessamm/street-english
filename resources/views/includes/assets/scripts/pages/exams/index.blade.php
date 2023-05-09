<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$('#exams').DataTable({
    'iDisplayLength': 4,
    "language": {
        "emptyTable" : "There's no Exams in your database",
    },
    processing : true,
    serverSide : true,
    ajax : "{{ route('ajax.exams.index') }}",
    columns : [
        { data : 'exam_name', name : 'exam_name' },
        { data : 'created_at', name : 'created_at' },
        { data : 'delete_exam', name : 'delete_exam' },
    ],
});

$(document).on('click', '.deleteExam', function(e){
    e.preventDefault();

    var exam_id = $(this).attr("data-exam-id");

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
        url : "{{ route('ajax.exam.delete') }}",
        type : "POST",
        data : {
            "_token" : "{{ csrf_token() }}",
            "exam_id" : exam_id,
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