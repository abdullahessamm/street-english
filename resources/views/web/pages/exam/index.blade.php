@extends('layouts.app', [
	'title' => 'Register for the exam',
    'scripts' => 'pages.exam.index',
])

@section('content')
<!-- Login Section -->
<section class="login-section ">
    <div class="auto-container">
        <div class="login-box">
            <!-- Title Box -->
            <div class="title-box">
                <h2>Register for the Exam</h2>
                <div class="text">Please fill the inputs below to join the exam</div>
            </div>
            
            <!-- Login Form -->
            <div class="styled-form">
                <form id="register-for-exam" novalidate>
                    @csrf
                    
                    <input type="hidden" name="survey_jd" value="{{ $surveyJs->id }}">
                    <div class="form-group">
                        <input id="username" type="text" class="form-control form-control-prepended" name="username" placeholder="Your Username" required autofocus style="color: #18a674;font-weight: bold;">
                    </div>

                    <div class="form-group">
                        <input id="email" type="email" class="form-control form-control-prepended" name="email" placeholder="Your Email" required autofocus style="color: #18a674;font-weight: bold;" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$">
                    </div>

                    <div class="form-group">
                        <input id="phone" type="text" class="form-control form-control-prepended" name="phone" placeholder="Your Phone" style="color: #18a674;font-weight: bold;" pattern="[0-9]+">
                    </div>

                    <div class="form-group">
                        <input id="whatstapp" type="text" class="form-control form-control-prepended" name="whatstapp" placeholder="Your Whatsapp Number" required autofocus style="color: #18a674;font-weight: bold;" pattern="[0-9]+">
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="theme-btn btn-style-three"><span class="txt">Login <i class="fa fa-angle-right"></i></span></button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</section>
<!-- End Login Section -->

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
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body">
                <p class="p-3">
                    {!! errorMsg('Error Occured') !!}
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>
@endsection