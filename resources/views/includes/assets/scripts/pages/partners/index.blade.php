<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$('#partners').DataTable({
    'iDisplayLength': 4,
    "language": {
        "emptyTable" : "There's no partners in your database",
    },
    processing : true,
    serverSide : true,
    ajax : "{{ route('ajax.partners.index') }}",
    columns : [
        { data : 'name', name : 'name' },
        { data : 'url', name : 'url' },
        { data : 'image', name : 'image' },
        { data : 'delete', name : 'id' },
    ],
});

$("#openNewPartnerModalForm").on('click', function(){
    $("#createNewPartnerModal").modal('show');
});

$("#createNewPartner").on('submit', function(e){
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
                    $("#createNewPartnerModal").hide();
                    
                    $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                }
        }, false);
        return xhr;
        },
        url : "{{ route('ajax.partner.create') }}",
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
                $("#createNewPartnerModal").show();
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#loading").modal('hide');
            $("#resModal").modal('hide');
            $("#createNewPartnerModal").modal('hide');
            $("#error").modal('show');
        }
    });
});

$(document).on('keyup', '.updatePartnerName', function(e){
    e.preventDefault();

    var partner_id = $(this).data("partner-id");
    var partner_name = $(this).text();

    $.ajax({
        url : "{{ route('ajax.partner.name.update') }}",
        type : "POST",
        data : {
            "_token" : "{{ csrf_token() }}",
            "partner_id" : partner_id,
            "partner_name" : partner_name,
        },
    });
});

$(document).on('keyup', '.updatePartnerUrl', function(e){
    e.preventDefault();

    var partner_id = $(this).data("partner-id");
    var partner_url = $(this).text();

    $.ajax({
        url : "{{ route('ajax.partner.url.update') }}",
        type : "POST",
        data : {
            "_token" : "{{ csrf_token() }}",
            "partner_id" : partner_id,
            "partner_url" : partner_url,
        },
    });
});

$(document).on('click', '.previewPartnerImage', function(e){
    e.preventDefault();

    var partner_id = $(this).data("partner-id");

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
        url : "{{ route('ajax.partner.image.preview') }}",
        type : "POST",
        data : {
            "_token" : "{{ csrf_token() }}",
            "partner_id" : partner_id,
        },
        success : function(data)
        {
            $("#loading").modal('hide');
            $("#previewImageModal").modal('show');
            $("#preview_partner_image").html(data);
            $("#onCloseModal").click(function(){
                $("#previewImageModal").modal('hide');
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#loading").modal('hide');
            $("#error").modal({backdrop: 'static', keyboard: false});
            $("#error").modal('show');
        }
    });
});

$(document).on('submit', '#updatePartnerImage', function(e){
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
                    $("#previewImageModal").hide();
                    
                    $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                }
        }, false);
        return xhr;
        },
        url : "{{ route('ajax.partner.image.update') }}",
        type : "POST",
        data : new FormData(this),
        contentType : false,
        processData : false,
        cache : false,
        success : function(data)
        {
            $("#loading").modal('hide');
            $("#resModal").modal('show');
            $("#res").html(data);
            $("#onClosePreviewImageModalModal").click(function(){
                $("#resModal").modal('hide');
                $("#previewImageModal").show();
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#loading").modal('hide');
            $("#previewImageModal").modal('hide');
            $("#error").modal('show');
        }
    });
});

$(document).on('click', '.deletePartner', function(e){
    e.preventDefault();

    var partner_id = $(this).data("partner-id");

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
        url : "{{ route('ajax.partner.delete') }}",
        type : "POST",
        data : {
            "_token" : "{{ csrf_token() }}",
            "partner_id" : partner_id,
        },
        success : function(data)
        {
            $("#loading").modal('hide');
            $("#resModal").modal({backdrop: 'static', keyboard: false});
            $("#res").html(data);
            $("#onCloseModal").click(function(){
                $("#resModal").modal('hide');
                $("#tr_partner_"+partner_id).remove();
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#loading").modal('hide');
            $("#error").modal({backdrop: 'static', keyboard: false});
            $("#error").modal('show');
        }
    });
});
</script>