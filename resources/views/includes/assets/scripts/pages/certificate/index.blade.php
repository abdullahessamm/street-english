<script>
    $(document).ready(function(){
    
        $("#searchCertificationBtn").on('click', function(){
            var serial = $("#serial").val();
    
            if(serial == '')
            {
                alert('Your certificate Number is required');
            }
    
            $.ajax({
                type : "POST",
                url : "{{ route('ajax.certificate.search') }}",
                data : {
                    "_token" : "{{ csrf_token() }}",
                    "serial" : serial,
                },
                beforeSend: function()
                {
                    $("#res").html("<h1>Searching for your certificate</h1><h4>Please wait...</h4>");
                    $("#searchCertificationBtn").prop("disabled", true);
                    $("#searchCertificationBtn").text("Searching....");
                },
                success: function(data)
                {
                    $("#searchCertificationBtn").prop("disabled", false);
                    $("#searchCertificationBtn").text("Search");
                    $("#res").html(data);
                }
            });
        });
    });
</script>