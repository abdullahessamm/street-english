<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$('#courses').DataTable({
    'iDisplayLength': 4,
    "language": {
        "emptyTable" : "There's no Courses in your database",
    },
    processing : true,
    serverSide : true,
    ajax : "{{ route('ajax.instructors-for-course.index') }}",
    columns : [
        { data : 'name', name : 'name' },
        { data : 'instructors', name : 'id' },
    ],
});
</script>