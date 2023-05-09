<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){
    $('#bundles').DataTable({
        'iDisplayLength': 4,
        "language": {
            "emptyTable" : "There's no bundles in your database",
        },
        processing : true,
        serverSide : true,
        ajax : "{{ route('ajax.bundles.index') }}",
        columns : [
            { data : 'name', name : 'name' },
            { data : 'number_of_courses', name : 'slug' },
            { data : 'number_of_users', name : 'slug' },
            { data : 'created_at', name : 'created_at' },
            { data : 'delete_bundle', name : 'slug' },
        ],
    });

    $("#openCreateNewBundleModalForm").on('click', function(){
        $("#createNewBundleModal").modal({backdrop: 'static', keyboard: false});
        $("#createNewBundleModal").modal('show');
    });

    $("#createNewBundle").on('submit', function(e){
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
                        $("#createNewBundleModal").hide();
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.bundle.create') }}",
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

    $(document).on('click', '.deleteBundle', function(e){
        e.preventDefault();

        var bundle_id = $(this).attr("data-bundle-id");

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
            url : "{{ route('ajax.bundle.delete') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "bundle_id" : bundle_id,
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