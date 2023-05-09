@extends('layouts.app', [
    'title' => 'Exercises',
    'active' => 'exercise.index',
    'breadcrumb' => [
        'title' => 'Exercises',
        'map' => [
            'Dashboard' => 'home',
            'Exercises' => 'active'
        ]
    ],
    'scripts' => 'pages.exercise.index',
])

@section('content')
<!-- List of all Instructors table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of all Surveyes</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                    

                        <table id="exercises" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <td>Exercise Title</td>
                                    <td>Exercise Users</td>
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