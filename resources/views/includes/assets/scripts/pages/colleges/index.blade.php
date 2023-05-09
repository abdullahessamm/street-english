<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$('#colleges').DataTable({
    'iDisplayLength': 4,
    "language": {
        "emptyTable" : "There's no college in your database",
    },
    processing : true,
    serverSide : true,
    ajax : "{{ route('ajax.colleges.index') }}",
    columns : [
        { data : 'college_name', name : 'college_name' },
        { data : 'created_at', name : 'created_at' },
    ],
});
</script>