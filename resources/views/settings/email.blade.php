@extends('layouts.app', [
    'title' => "Change your Email",
    'scripts' => 'settings.index',
    'breadcrumb' => [
        'title' => 'Change my Email Account',
        'map' => [
            'Dashboard' => 'home',
            'Settings' => 'settings',
            'Change your Email' => 'active'
        ]
    ]
])

@section('content')
<!-- General Settings start -->
<section>
    <div class="row">
        <div class="col-md-12 mb-1">
            <h4> Change your Email </h4>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="changeEmail">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="user_email"> Change your email account name </label>
                            <input type="email" class="form-control" name="user_email" id="user_email" value="{{ Auth::user()->email }}" required dir="ltr">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"> update </button>
                        </div>
                    </form>
                </div>    
            </div>
        </div>
    </div>
</section>
<!-- General Settings end -->

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
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal">@lang('settings.Close Window')</button>
            </div>
        </div>
    </div>
</div>
@endsection