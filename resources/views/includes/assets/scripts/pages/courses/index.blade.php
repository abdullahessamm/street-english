<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$('#courses').DataTable({
    'iDisplayLength': 4,
    "language": {
        "emptyTable" : "لا يوجد دورات تدريبية في قاعدة البيانات",
    },
    processing : true,
    serverSide : true,
    ajax : "{{ route('ajax.courses.index') }}",
    columns : [
        { data : 'name', name : 'name' },
        { data : 'created_at', name : 'created_at' },
    ],
});
</script>