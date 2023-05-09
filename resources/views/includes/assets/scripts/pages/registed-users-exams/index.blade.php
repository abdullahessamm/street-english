<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$('#exams').DataTable({
    'iDisplayLength': 4,
    "language": {
        "emptyTable" : "There's no exams in your database",
    },
    processing : true,
    serverSide : true,
    ajax : "{{ route('ajax.registed-users-exams.index') }}",
    columns : [
        { data : 'exam_name', name : 'exam_name' },
        { data : 'registed_users', name : 'id' },
    ],
});
</script>