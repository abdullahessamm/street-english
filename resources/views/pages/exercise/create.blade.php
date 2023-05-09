@extends('layouts.app', [
    'title' => 'Create new Exercise',
    'active' => 'exercise.create',
    'breadcrumb' => [
        'title' => 'Create new Exercise',
        'map' => [
            'Homepage' => 'home',
            'Create new Exercise' => 'active'
        ]
    ],
    'assets' => 'pages.exercise.create',
])


@section('content')
<!-- Create new Exercise Form -->
<section class="content">
    <div class="row">
      <div class="col-12">
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">Create new Exercise</h4>  
            </div>
            <form id="create-exercise">
                {{ csrf_field() }}
                <div class="box-body">
                    <div id="exerciseContainer" dir="ltr">
                        <div id="creatorElement" style="height: 100vh;"></div>
                    </div>
                    
                    <div class="form-group">
                        <textarea name="exercise_json_data" class="form-control" id="" dir="ltr" cols="30" rows="50"></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                    <i class="ti-save-alt"></i> Create
                    </button>
                </div> 
            </form>
        </div>
      </div>
    </div>
</section>

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