<script>
$("#subscribe").on('submit', function(e){
    e.preventDefault();
    
    $.ajax({
        type : "POST",
        url : "{{ route('ajax.subscribe') }}",
        data : new FormData(this),
        contentType : false,
        processData : false,
        cache : false,
        success : function(data){
            
            $("#subscribe_hint").html(data);
        }
    });

});
</script>