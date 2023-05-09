<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$('#events').DataTable({
    'iDisplayLength': 4,
    "language": {
        "emptyTable" : "There's no Events in your database",
    },
    processing : true,
    serverSide : true,
    ajax : "{{ route('ajax.events.index') }}",
    columns : [
        { data : 'title', name : 'title' },
        { data : 'id', name : 'users' },
    ],
});
</script>