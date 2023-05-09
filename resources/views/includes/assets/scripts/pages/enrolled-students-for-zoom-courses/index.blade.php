<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$('#courses').DataTable({
    'iDisplayLength': 4,
    "language": {
        "emptyTable" : "There's no Zoom Courses in your database",
    },
    processing : true,
    serverSide : true,
    ajax : "{{ route('ajax.enrolled-students-for-zoom-courses.index') }}",
    columns : [
        { data : 'title', name : 'title' },
        { data : 'enrolled_students', name : 'enrolled_students' },
    ],
});
</script>