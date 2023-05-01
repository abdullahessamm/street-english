@extends('layouts.app',[
    'title' => 'My Dashboard',
    'active' => 'student.home',
    'scripts' => 'student.settings',
])

@section('content')
<!-- Student Profile Section -->
<section class="student-profile-section">
    <div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-1.png)"></div>
    <div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-2.png)"></div>
    <div class="circle-one"></div>
    <div class="circle-two"></div>
    <div class="auto-container">
        
        <div class="row clearfix mt-5">
            
            <!-- Image Section -->
            @include('student.layouts.settings')
            
            <!-- Content Section -->
            <div class="content-column col-lg-9 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="content">
                        <!-- Sec Title -->
                        <div class="sec-title">
                            <h2>Edit my Profile</h2>
                        </div>
                        
                        <!-- Profile Form -->
                        <div class="profile-form">
                        
                            <!-- Profile Form -->
                            <form method="post" action="blog.html">
                                <div class="row clearfix">
                                    
                                    <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                                        <input type="text" name="username" placeholder="First Name" required="" value="{{ Auth::user()->name }}">
                                        <span class="icon flaticon-edit-1"></span>
                                    </div>
                                    
                                    <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                                        <input type="email" name="email" placeholder="Email" required="" value="{{ Auth::user()->email }}">
                                        <span class="icon flaticon-edit-1"></span>
                                    </div>
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group text-right">
                                        <button class="theme-btn btn-style-three" type="submit" name="submit-form"><span class="txt">Save Change <i class="fa fa-angle-right"></i></span></button>
                                    </div>
                                </div>
                            </form>
                                
                        </div>
                            
                    </div>


                    <div class="content">
                        <!-- Sec Title -->
                        <div class="sec-title">
                            <h2>Update Password</h2>
                        </div>
                        
                        <!-- Profile Form -->
                        <div class="profile-form">
                        
                            <!-- Profile Form -->
                            <form id="updatePassword">
                                {{ csrf_field() }}
                                <div class="row clearfix">
                                    
                                    <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                                        <input type="password" name="old_password" placeholder="Your old password" required>
                                        <span class="icon flaticon-edit-1"></span>
                                    </div>

                                    <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                                        <input type="password" name="new_password" placeholder="Your new password" required>
                                        <span class="icon flaticon-edit-1"></span>
                                    </div>

                                    <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                                        <input type="password" name="confirm_password" placeholder="Confirm your new password" required>
                                        <span class="icon flaticon-edit-1"></span>
                                    </div>
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group text-right">
                                        <button class="theme-btn btn-style-three" type="submit" name="submit-form"><span class="txt">Save Change <i class="fa fa-angle-right"></i></span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="content">
                        <!-- Sec Title -->
                        <div class="sec-title">
                            <h2>Update Profile Image</h2>
                        </div>
                        
                        <!-- Profile Form -->
                        <div class="profile-form">
                        
                            <!-- Profile Form -->
                            <div class="row clearfix">

                                <div class="col-md-6">
                                    <!-- Profile Form -->
                                    <form id="updateImage">
                                        {{ csrf_field() }}
                                        <div class="row clearfix">
                                            
                                            <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                                                <input type="file" name="image" required>
                                                <span class="icon flaticon-edit-1"></span>
                                            </div>

                                            
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group text-right">
                                                <button class="theme-btn btn-style-three" type="submit" name="submit-form"><span class="txt">Update Image <i class="fa fa-angle-right"></i></span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="col-md-6">
                                @if(Auth::user()->image != null)
                                    <img src="{{ asset('public/images/students/'.Auth::user()->id.'/'.Auth::user()->image) }}" alt="" />
                                @else
                                    <img src="https://via.placeholder.com/278x319" alt="" />
                                @endif
                                </div>

                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
</section>
<!-- End Profile Section -->

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
            <div class="modal-body p-5">
                {!! errorMsg('Error Occured') !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> Close Windiows </button>
            </div>
        </div>
    </div>
</div>
@endsection