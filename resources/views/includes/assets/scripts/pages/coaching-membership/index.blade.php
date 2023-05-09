<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$('#coaching-memberships').DataTable({
    'iDisplayLength': 4,
    "language": {
        "emptyTable" : "There's no coaching memberships in your database",
    },
    processing : true,
    serverSide : true,
    ajax : "{{ route('ajax.coaching-memberships.index') }}",
    columns : [
        { data : 'fullname', name : 'fullname' },
        { data : 'email', name : 'email' },
        { data : 'created_at', name : 'created_at' },
    ],
});
</script>