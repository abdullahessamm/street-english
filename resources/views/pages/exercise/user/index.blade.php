@extends('layouts.app', [
    'title' => 'Survey.js',
    'active' => 'survey-js.index',
    'breadcrumb' => [
        'title' => 'Survey.js',
        'map' => [
            'Dashboard' => 'home',
            'Survey.js' => 'active'
        ]
    ],
    'scripts' => 'pages.survey-js.user.index',
])

@section('content')
<!-- List of all Instructors table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Users in {{ $surveyJs->title }}</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                    

                        <table id="survey-users" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <td>User's Answers</td>
                                    <td>Email</td>
                                    <td>Has been corrected</td>
                                    <td>Results</td>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ List of all Instructors table -->
@endsection