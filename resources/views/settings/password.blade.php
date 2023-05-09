@extends('layouts.app', [
    'title' => "Change Password",
    'scripts' => 'settings.index',
    'breadcrumb' => [
        'title' => 'Change my Password',
        'map' => [
            'Dashboard' => 'home',
            'Settings' => 'settings',
            'Change Password' => 'active'
        ]
    ]
])

@section('content')
<!-- General Settings start -->
<section>
    <div class="row">
        <div class="col-md-12 mb-1">
            <h4> Change Password </h4>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="changePassword">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="user_old_password"> Write your old password </label>
                            <input type="password" class="form-control" name="user_old_password" id="user_old_password" required>
                        </div>

                        <div class="form-group">
                            <label for="user_new_password"> Write your new password </label>
                            <input type="password" class="form-control" name="user_new_password" id="user_new_password" required>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password"> Confirm password </label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"> update password </button>
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