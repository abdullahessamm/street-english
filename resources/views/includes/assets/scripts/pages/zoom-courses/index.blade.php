<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$('#zoom-courses').DataTable({
    'iDisplayLength': 4,
    "language": {
        "emptyTable" : "There's no Zoom Courses in your database",
    },
    processing : true,
    serverSide : true,
    ajax : "{{ route('ajax.zoom-courses.index') }}",
    columns : [
        { data : 'title', name : 'title' },
        { data : 'levels', name : 'levels' },
        { data : 'created_at', name : 'created_at' },
    ],
});
</script>