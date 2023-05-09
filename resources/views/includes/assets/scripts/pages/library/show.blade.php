<script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/toggle/switchery.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script>
$(document).ready(function(){
	function callAjax(route, data, res)
	{
		$.ajax({
			url : route,
			type : "POST",
			data : {
				"_token" : "{{ csrf_token() }}",
				"data" : data
			},
			beforeSend : function()
			{
				$(res).html('<div class="text-center"><h4>Please wait...</h4></div>');
			},
			success : function(data)
			{
				$(res).html(data);
			}
		});
	}

    var book_type = $(".chooseBookType:checked").val();

	callAjax("{{ route('ajax.library.preview.choose-book-type') }}", {
        'book_type' : book_type,
		'book_id' : $("#book_id").val()
    }, '#book_type_res');

    $(".chooseBookType").on('change', function(e){
		e.preventDefault();

		var book_type = $(this).val();

		callAjax("{{ route('ajax.library.preview.choose-book-type') }}", {
            'book_type' : book_type,
			'book_id' : $("#book_id").val()
        }, '#book_type_res');
	});

    CKEDITOR.replace( 'summary' );

    $("#updateBookInfo").on('submit', function(e){
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
			url : "{{ route('ajax.library.book.update') }}",
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
			}
		});
	});

    // Switchery
    var i = 0;
    
    if (Array.prototype.forEach) 
    {
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
    } 
    else
    {
        var elems1 = document.querySelectorAll('.switchery');

        for (i = 0; i < elems1.length; i++) {
            var $size = elems1[i].data('size');
            var $color = elems1[i].data('color');
            var switchery = new Switchery(elems1[i], { color: '#37BC9B' });
        }
    }
    /*  Toggle Ends   */

    $("#deleteBook").on('click', function(e){
		e.preventDefault();

        var book_id = $(this).attr("data-book-id");

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
			url : "{{ route('ajax.library.book.delete') }}",
			type : "POST",
			data : {
                "_token" : "{{ csrf_token() }}",
                "book_id" : book_id, 
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