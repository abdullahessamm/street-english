<script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script>
$(document).ready(function(){

    $("#resModal").appendTo("body");
    $("#loading").appendTo("body");
    $("#error").appendTo("body");

    function callAjax(route, data, res)
    {
        $.ajax({
            url : route,
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                data
            },
            beforeSend : function()
            {
                $(res).html('<div class="text-center"><h6>يتم عرض الحقل برجاء الانتظار</h6></div>');
            },
            success : function(data)
            {
                $(res).html(data);
            }
        });
    }

    var media_type = $(".chooseMedia").val();

    callAjax("{{ route('coach.ajax.my-blog.preview.media-intro-type') }}", {
        'media_type' : media_type,
    }, '#media_res');

    $(".chooseMedia").on('change', function(e){
        e.preventDefault();

        var media_type = $(this).val();

        callAjax("{{ route('coach.ajax.my-blog.preview.media-intro-type') }}", {
            'media_type' : media_type,
        }, '#media_res');
    });

    CKEDITOR.replace( 'content' );

    $("#createNewBlog").on('submit', function(e){
        e.preventDefault();

        for ( instance in CKEDITOR.instances )
        {
            CKEDITOR.instances[instance].updateElement();
        }

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
            url : "{{ route('coach.ajax.my-blog.create') }}",
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