<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$('#categories').DataTable({
    'iDisplayLength': 4,
    "language": {
        "emptyTable" : "There's no categories in your database",
    },
    processing : true,
    serverSide : true,
    ajax : "{{ route('ajax.blogs.categories.index') }}",
    columns : [
        { data : 'name', name : 'name' },
        { data : 'posts', name : 'posts' },
        { data : 'delete', name : 'delete' },
    ],
});

$(document).on('click', '.deleteCategory', function(e){
    e.preventDefault();

    var category_id = $(this).attr("data-category-id");

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
			url : "{{ route('ajax.blog.category.delete') }}",
			type : "POST",
			data : {
                "_token" : "{{ csrf_token() }}",
                "category_id" : category_id,
            },
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
</script>