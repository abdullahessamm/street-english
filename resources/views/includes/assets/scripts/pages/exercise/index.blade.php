<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){

    $('#exercises').DataTable({
        'iDisplayLength': 4,
        "language": {
            "emptyTable" : "You have no Excercises",
        },
        processing : true,
        serverSide : true,
        ajax : "{{ route('datatable.excercises') }}",
        columns : [
            { data : 'title', name : 'title' },
            { data : 'users', name : 'users' },
        ],
    });
});
</script>