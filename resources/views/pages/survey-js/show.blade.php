@extends('layouts.app', [
    'title' => $survey->title,
    'active' => 'survey-js.index',
    'breadcrumb' => [
        'title' => $survey->title,
        'map' => [
            'Homepage' => 'home',
            'Survey.Js' => 'survey-js.index',
            $survey->title => 'active'
        ]
    ],
    'assets' => 'pages.survey-js.show',
])


@section('content')
<!-- Create new Survey Form -->
<section class="content">
    <div class="row">
      <div class="col-12">
        <div class="box">
            <div class="box-header">
                <h4 class="box-title float-left">Survey : {{ $survey->title }}</h4> 
                <div class="float-right">
                    <a href="{{ route('survey-js.preview', $survey->slug) }}" class="btn btn-success btn-sm">Preview Survey</a>
                    <button class="btn btn-danger btn-sm" id="delete-survey" data-survey-id="{{ $survey->id }}">Delete this survey</button>
                </div>
            </div>
            <form id="update-survey">
                {{ csrf_field() }}
                <input type="hidden" name="survey_id" value="{{ $survey->id }}">
                <div class="box-body" dir="ltr">
                    <div id="surveyContainer">
                        <div id="creatorElement" style="height: 100vh;"></div>
                    </div>
                    
                    <div class="form-group">
                        <textarea name="survey_json_data" class="form-control" id="" dir="ltr" cols="30" rows="15">{{ $survey_json_data }}</textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-rounded btn-info btn-outline">
                    <i class="ti-save-alt"></i> Update
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