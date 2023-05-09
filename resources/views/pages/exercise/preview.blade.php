@extends('layouts.app', [
    'title' => $exercise->title,
    'sidebar' => false,
    'active' => 'exercise.index',
    'breadcrumb' => [
        'title' => $exercise->title,
        'map' => [
            'Homepage' => 'home',
            'Exercise' => 'exercise.index',
            $exercise->title => [
                'route' => 'exercise.show',
                'slug' => $exercise->slug
            ],
            'Preview : '.$exercise->title => 'active',
        ]
    ],
    'assets' => 'pages.exercise.preview',
])


@section('content')
<!-- Sruvey Form -->
<section class="content">
    <div class="row">
      <div class="col-12">
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">Create new Survey</h4>  
            </div>
            <div class="box-body">
                <div id="exerciseContainer">
                    <div id="exerciseElement" style="display:inline-block;width:100%;"></div>
                </div>
            </div>
        </div>
      </div>
    </div>
</section>
<!--/ Sruvey Form -->

<!-- Loading Modal -->
<div class="modal" id="loading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body">
                <div class="progress text-right">
                    <div id="progressbar" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Result Modal -->
<div class="modal" id="resModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
                <div id="res"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> Close Window</button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
				<span class="fa fa-times text-danger" style="font-size: 100px;"></span>
				<h1>Error form the Server</h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> Close Window</button>
            </div>
        </div>
    </div>
</div>
@endsection