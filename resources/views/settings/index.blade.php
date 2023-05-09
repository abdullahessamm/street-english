@extends('layouts.app', [
    'title' => 'General Settings',
    'scripts' => 'settings.index',
    'breadcrumb' => [
        'title' => 'General Settings',
        'map' => [
            'Dashboard' => 'home',
            'Settings' => 'active',
        ]
    ]
])

@section('content')
<!-- General Settings start -->
<section>
    <div class="row">
        <div class="col-md-12 mb-1">
            <h4> General Settings </h4>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="changeUserName">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="user_name"> Change your current name </label>
                                    <input type="text" class="form-control" name="user_name" id="user_name" value="{{ Auth::user()->name }}" required>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success"> update </button>
                                </div>
                            </form>
                        </div>    
                    </div>
                </div>

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
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <form id="changeUserImage">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="text-center mb-2">
                            @if(Auth::user()->image == null)
                                <img src="{{ asset('app-assets/images/avatars/man.png') }}" class="img-fluid rounded-circle">
                            @else
                                <img src="{{ config('app.main_url').'/images/admin/'.Auth::user()->image }}" class="img-fluid rounded-circle" alt="">
                            @endif
                            </div>
                            <input type="file" name="user_image" id="user_image" required>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success btn-sm"> update my current image </button>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> Close Window </button>
            </div>
        </div>
    </div>
</div>
@endsection