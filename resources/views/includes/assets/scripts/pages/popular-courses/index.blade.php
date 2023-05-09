<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/select/selectize.min.js') }}"></script>
<script>
$('#popular-courses').DataTable({
    'iDisplayLength': 4,
    "language": {
        "emptyTable" : "There's no popular courses in your database",
    },
    processing : true,
    serverSide : true,
    ajax : "{{ route('ajax.popular-courses.index') }}",
    columns : [
        { data : 'name', name : 'course_id' },
        { data : 'delete', name : 'course_id' },
    ],
});

$('.selectize-multiple').selectize({
    plugins: ['remove_button'],
    persist: false,
    create: true,
    render: {
        item: function(data, escape) {
            return '<div>"' + escape(data.text) + '"</div>';
        }
    },
    onDelete: function(values) {
        return confirm(values.length > 1 ? 'Are you sure you want to remove these ' + values.length + ' items?' : 'Are you sure you want to remove "' + values[0] + '"?');
    }
});

$("#openAddCourseModalForm").on('click', function(){
    $("#addCourseModal").modal('show');
});

$("#addPopularCourse").on('submit', function(e){
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
                    $("#addCourseModal").hide();
                    
                    $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                }
        }, false);
        return xhr;
        },
        url : "{{ route('ajax.popular-course.add') }}",
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
                $("#addCourseModal").show();
            });
        }
    });
});

$(document).on('click', '.removeCourse', function(e){
    e.preventDefault();

    var course_id = $(this).data("course-id");

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
        url : "{{ route('ajax.popular-course.remove') }}",
        type : "POST",
        data : {
            "_token" : "{{ csrf_token() }}",
            "course_id" : course_id
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