<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$('#categories').DataTable({
    'iDisplayLength': 4,
    "language": {
        "emptyTable" : "لا يوجد فئات لدورات تدريبية في قاعدة البيانات",
    },
    processing : true,
    serverSide : true,
    ajax : "{{ route('ajax.courses-category.index') }}",
    columns : [
        { data : 'category_name', name : 'category_name' },
        { data : 'delete_category', name : 'category_name' },
        { data : 'created_at', name : 'created_at' },
    ],
});

$("#openNewCategoryModalForm").on('click', function(){
    $("#createNewCategoryModal").modal('show');
});

$("#createNewCategory").on('submit', function(e){
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
                    $("#createNewCategoryModal").hide();
                    
                    $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                }
        }, false);
        return xhr;
        },
        url : "{{ route('ajax.course-category.create') }}",
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
                $("#createNewCategoryModal").show();
            });
        }
    });
});

$(document).on('keyup', '.updateCategoryName', function(e){
    e.preventDefault();

    var course_category_id = $(this).data("course-category-id");
    var course_category_name = $(this).text();

    $.ajax({
        url : "{{ route('ajax.course-category.update') }}",
        type : "POST",
        data : {
            "_token" : "{{ csrf_token() }}",
            "course_category_id" : course_category_id,
            "course_category_name" : course_category_name,
        },
    });
});

$(document).on('click', '.deleteCourseCategory', function(e){
    e.preventDefault();

    var course_category_id = $(this).data("course-category-id");

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
        url : "{{ route('ajax.course-category.delete') }}",
        type : "POST",
        data : {
            "_token" : "{{ csrf_token() }}",
            "course_category_id" : course_category_id,
        },
        success : function(data)
        {
            $("#loading").modal('hide');
            $("#resModal").modal({backdrop: 'static', keyboard: false});
            $("#res").html(data);
            $("#onCloseModal").click(function(){
                $("#resModal").modal('hide');
                $("#tr_course_category_"+course_category_id).remove();
            });
        }
    });
});
</script>