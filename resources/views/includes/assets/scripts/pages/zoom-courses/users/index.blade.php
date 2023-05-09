<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$('#zoom-course-users').DataTable({
    'iDisplayLength': 4,
    "language": {
        "emptyTable" : "There's no zoom course users in your database",
    },
    processing : true,
    serverSide : true,
    ajax : "{{ route('ajax.zoom-course.users.index') }}",
    columns : [
        { data : 'name', name : 'name' },
        { data : 'email', name : 'email' },
        { data : 'created_at', name : 'created_at' },
    ],
});
</script>