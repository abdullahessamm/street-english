<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){

    $('#survey-users').DataTable({
        'iDisplayLength': 4,
        "language": {
            "emptyTable" : "This test has no registered users",
        },
        processing : true,
        serverSide : true,
        ajax : "{{ route('datatable.survey-js.survey.users', $surveyJs->slug) }}",
        columns : [
            { data : 'username', name : 'username' },
            { data : 'email', name : 'email' },
            { data : 'has_been_corrected', name : 'has_been_corrected' },
            { data : 'results', name : 'results' },
        ],
    });
});
</script>