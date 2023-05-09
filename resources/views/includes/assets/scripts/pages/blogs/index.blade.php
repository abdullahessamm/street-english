<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$('#blogs').DataTable({
    'iDisplayLength': 4,
    "language": {
        "emptyTable" : "There's no Blogs in your database",
    },
    processing : true,
    serverSide : true,
    ajax : "{{ route('ajax.blogs.index') }}",
    columns : [
        { data : 'title', name : 'title' },
        { data : 'posted_at', name : 'posted_at' },
        { data : 'created_at', name : 'created_at' },
    ],
});
</script>