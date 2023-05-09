<script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/toggle/switchery.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
<script>
$(document).ready(function(){
    function callAjax(route, data)
	{
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
            url : route,
            type : "POST",
            data : {
				"_token" : "{{ csrf_token() }}",
				data
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
	}

    $('.repeater-default').repeater({
		show: function () {
			$(this).slideDown();
		},
		hide: function(remove) {
			if (confirm('Are you sure you want to remove this item?')) {
				$(this).slideUp(remove);
			}
		},
        isFirstItemUndeletable: true,
	});

    /* Swtichery */
    var i = 0;
    if (Array.prototype.forEach) {

        var elems = $('.switchery');
        $.each( elems, function( key, value ) {
            var $size="", $color="",$sizeClass="", $colorCode="";
            $size = $(this).data('size');
            var $sizes ={
                'lg' : "large",
                'sm' : "small",
                'xs' : "xsmall"
            };
            if($(this).data('size')!== undefined){
                $sizeClass = "switchery switchery-"+$sizes[$size];
            }
            else{
                $sizeClass = "switchery";
            }

            $color = $(this).data('color');
            var $colors ={
                'primary' : "#967ADC",
                'success' : "#37BC9B",
                'danger' : "#DA4453",
                'warning' : "#F6BB42",
                'info' : "#3BAFDA"
            };
            if($color !== undefined){
                $colorCode = $colors[$color];
            }
            else{
                $colorCode = "#37BC9B";
            }

            var switchery = new Switchery($(this)[0], { className: $sizeClass, color: $colorCode });
        });
    } else {
        var elems1 = document.querySelectorAll('.switchery');

        for (i = 0; i < elems1.length; i++) {
            var $size = elems1[i].data('size');
            var $color = elems1[i].data('color');
            var switchery = new Switchery(elems1[i], { color: '#37BC9B' });
        }
    }
    /* End Swtichery */

    $("#openNewContentModalForm").on('click', function(){
        $("#createNewContentModal").modal('show');
    });

    $("#createNewContent").on('submit', function(e){
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
                        $("#createNewContentModal").hide();
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.ietls-course.content.create') }}",
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
                    $("#createNewContentModal").show();
                });
            },
			error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#createNewContentModal").modal('hide');
                $("#error").modal('show');
			}
        });
    });

    $(".updateContentTitle").on('keyup', function(e){
        e.preventDefault();

        var content_id = $(this).data("content-id");
        var content_title = $(this).text();

        $.ajax({
            url : "{{ route('ajax.ietls-course.content.title.update') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "content_id" : content_id,
                "content_title" : content_title,
            }
        });
    });
    
    $(".updateContentDescription").on('keyup', function(e){
        e.preventDefault();

        var content_id = $(this).data("content-id");
        var content_description = $(this).text();

        $.ajax({
            url : "{{ route('ajax.ietls-course.content.description.update') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "content_id" : content_id,
                "content_description" : content_description,
            }
        });
    });

    $('.deleteContent').on('click', function(e){
        e.preventDefault();
        
        var content_id = $(this).data("content-id");

        $("#deleteContentModal").modal('show');

        $("#confirmDeleteContentID").val(content_id);
    });

    $("#confirmDeleteContent").on('click', function(e){
        e.preventDefault();

        var content_id = $("#confirmDeleteContentID").val();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        $("#deleteContentModal").hide();
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.ietls-course.content.delete') }}",
            type : "POST",
            data : {
				"_token" : "{{ csrf_token() }}",
				"content_id" : content_id,
			},
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                    $("#deleteContentModal").show();
                });
            },
			error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#deleteContentModal").modal('hide');
                $("#createNewContentModal").modal('hide');
                $("#error").modal('show');
			}
        });
    });

    
    $(".addNewLessons").on('submit', function(e){
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
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.ietls-course.content.lesson.create') }}",
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
			error: function (request, status, error) {
                $("#loading").modal('hide');
                $("#error").modal('show');
			}
        });
    });
});
</script>