@extends('layouts.app', [
    'title' => 'Blogs',
    'active' => 'blogs',
    'breadcrumb' => [
        'title' => 'Blogs',
        'map' => [
            'Dashboard' => 'home',
            'Blogs' => 'active',
        ]
    ],
    'header_right' => [
		'href' => [
			'text' => 'Create New Blog',
			'route' => 'blog.create',
			'color' => 'info',
			'bold' => true,
		]
    ],
    'scripts' => 'pages.blogs.index'
])

@section('content')
<!-- List of all Exams table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of all blogs</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered" id="blogs">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Posted at</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>Title</th>
                                    <th>Posted at</th>
                                    <th>Created at</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ List of all Exams table -->
@endsection