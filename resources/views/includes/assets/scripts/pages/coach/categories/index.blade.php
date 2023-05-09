<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$('#coaches').DataTable({
    'iDisplayLength': 4,
    "language": {
        "emptyTable" : "There's no Coaches in your database",
    },
    processing : true,
    serverSide : true,
    ajax : "{{ route('coach.coach.categories') }}",
    columns : [
        { data : 'name', name : 'name' },
        { data : 'coaches', name : 'coaches' },
    ],
});

$("#openCreateNewCoachCategoryModalForm").on('click', function(){
    $("#createNewCoachCategoryModal").modal('show');
});

$("#createNewCoachCategoryForm").on('submit', function(e){
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
                    $("#createNewCoachCategoryModal").hide();
                    
                    $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                }
        }, false);
        return xhr;
        },
        url : "{{ route('coach.coach.category.create') }}",
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
                $("#createNewCoachCategoryModal").show();
            });
        },
        error : function()
        {
            $("#createNewCoachCategoryModal").modal('hide');
            $("#loading").modal('hide');
            $("#errorModal").modal('show');
        }
    });
    });
</script>