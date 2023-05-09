<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){

    $('#sruveys').DataTable({
        'iDisplayLength': 4,
        "language": {
            "emptyTable" : "You have no Survey",
        },
        processing : true,
        serverSide : true,
        ajax : "{{ route('datatable.survey-js.surveys') }}",
        columns : [
            { data : 'title', name : 'title' },
            { data : 'public_url', name : 'public_url' },
            { data : 'users', name : 'users' },
        ],
    });
});
</script>