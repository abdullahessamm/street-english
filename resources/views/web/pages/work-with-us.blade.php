@extends('web.layouts.app', [
    'title' => 'Work With Us',
    'scripts' => 'pages.work-with-us'
])

@section('content')
<!-- Contact Page Section -->
<section class="contact-page-section">
    <div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-1.png)"></div>
    <div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-2.png)"></div>
    <div class="auto-container mt-5">
        <div class="inner-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <h2>Street English Academy</h2>  
                <h2>English-Language Instructor</h2>
                <h2>Job Application Form</h2>
            </div>
            
            <!-- Contact Form -->
            <div class="contact-form">
                <!-- Profile Form -->
                <form id="work-with-us">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label style="color: #1E284B;font-weight: bold;" for="fullname">Full Name - Quadruple</label>
                        <input type="text" name="fullname" id="fullname" required>
                    </div>

                    <div class="form-group">
                        <label style="color: #1E284B;font-weight: bold;" for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>

                    <div class="form-group">
                        <label style="color: #1E284B;font-weight: bold;" for="phone_number">Phone Number </label>
                        <input type="text" name="phone_number" id="phone_number" required>
                    </div>

                    <div class="form-group">
                        <label style="color: #1E284B;font-weight: bold;" for="whatsapp_number">WhatsApp Number</label>
                        <input type="text" name="whatsapp_number" id="whatsapp_number" pattern="[0-9]+" required>
                    </div>

                    <div class="form-group">
                        <label style="color: #1E284B;font-weight: bold;" for="dob">Date of Birth</label>
                        <input type="date" class="form-control" name="dob" id="dob" required>
                    </div>

                    <div class="form-group">
                        <label style="color: #1E284B;font-weight: bold;" for="address">Home Address / Place of Residence</label>
                        <textarea name="address" id="address" class="form-control" cols="30" rows="10" required></textarea>
                    </div>

                    <div class="form-group">
                        <label style="color: #1E284B;font-weight: bold;" for="matrial_status">Marital Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="matrial_status" id="Married" value="Married">
                            <label style="color: #18a674;font-weight: bold;" class="form-check-label" for="Married">
                                Married
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="matrial_status" id="Engaged" value="Engaged">
                            <label style="color: #18a674;font-weight: bold;" class="form-check-label" for="Engaged">
                                Engaged
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="matrial_status" id="Single" value="Single">
                            <label style="color: #18a674;font-weight: bold;" class="form-check-label" for="Single">
                                Single
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="color: #1E284B;font-weight: bold;" for="military_status">Military Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="military_status" id="Postponed" value="Postponed">
                            <label style="color: #18a674;font-weight: bold;" class="form-check-label" for="Postponed">
                                Postponed
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="military_status" id="Completed" value="Completed My Duty">
                            <label style="color: #18a674;font-weight: bold;" class="form-check-label" for="Completed">
                                Completed My Duty
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="military_status" id="Exempted" value="Exempted">
                            <label style="color: #18a674;font-weight: bold;" class="form-check-label" for="Exempted">
                                Exempted
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="military_status" id="na" value="N/A">
                            <label style="color: #18a674;font-weight: bold;" class="form-check-label" for="na">
                                N/A (For Girls)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="military_status" id="currently_serving" value="Currently Serving">
                            <label style="color: #18a674;font-weight: bold;" class="form-check-label" for="currently_serving">
                                Currently Serving
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="color: #1E284B;font-weight: bold;" for="personal_id_number">Personal ID Number : </label>
                        <input type="text" name="personal_id_number" id="personal_id_number">
                    </div>

                    <div class="form-group">
                        <label style="color: #1E284B;font-weight: bold;" for="are_you_a">Are you a .........?</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="are_you_a" id="Graduate" value="Graduate">
                            <label style="color: #18a674;font-weight: bold;" class="form-check-label" for="Graduate">
                                Graduate
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="are_you_a" id="Student" value="Student">
                            <label style="color: #18a674;font-weight: bold;" class="form-check-label" for="Student">
                                Student
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="color: #1E284B;font-weight: bold;" for="graduation_year">Graduation year - Current studying year</label>
                        <input type="number" class="form-control" name="graduation_year" id="graduation_year" pattern="[0-9]+" required>
                    </div>

                    <div class="form-group">
                        <label style="color: #1E284B;font-weight: bold;" for="educational_background">Your Educational Background : (University - Faculty - Institute) and mention your (Major)</label>
                        <textarea name="educational_background" id="educational_background" class="form-control" cols="30" rows="10" required></textarea>
                    </div>

                    <div class="form-group">
                        <label style="color: #1E284B;font-weight: bold;" for="why_are_you_applying">Why are you applying as an English-language instructor at SEA?</label>
                        <textarea name="why_are_you_applying" id="why_are_you_applying" class="form-control" cols="30" rows="10" required></textarea>
                    </div>

                    <div class="form-group">
                        <label style="color: #1E284B;font-weight: bold;" for="how_long_have_you_been_working">How long have you been working as an English Instructor?</label>
                        <input type="text" name="how_long_have_you_been_working" id="how_long_have_you_been_working" required>
                    </div>

                    <div class="form-group">
                        <label style="color: #1E284B;font-weight: bold;" for="name_3_places">Name 3 places you've worked for and for how long?</label>
                        <textarea name="name_3_places" id="name_3_places" class="form-control" cols="30" rows="10" required></textarea>
                    </div>

                    <div class="form-group">
                        <label style="color: #1E284B;font-weight: bold;" for="extra_qualifications">What are your Extra Qualifications?</label>
                        <textarea name="extra_qualifications" id="extra_qualifications" class="form-control" cols="30" rows="10" required></textarea>
                    </div>

                    <div class="form-group">
                        <label style="color: #1E284B;font-weight: bold;" for="salaray">Expected Hourly Rate</label>
                        <input type="text" name="salaray" id="salaray" required>
                    </div>

                    <div class="form-group">
                        <label style="color: #1E284B;font-weight: bold;" for="work_date_availability">Date of Availability to start at SEA</label>
                        <input type="date" class="form-control" name="work_date_availability" id="work_date_availability" required>
                    </div>

                    {{-- <div class="form-group">
                        <label style="color: #1E284B;font-weight: bold;" for="answer_the_following_3_Questions">Record a video or a voice note and send it to 01142875788. Answer the following THREE Questions!</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answer_the_following_3_Questions" id="introduce_yourself" value="introduce_yourself">
                            <label style="color: #18a674;font-weight: bold;" class="form-check-label" for="introduce_yourself">
                                Introduce yourself.
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answer_the_following_3_Questions" id="best_book_or_movie" value="best_book_or_movie">
                            <label style="color: #18a674;font-weight: bold;" class="form-check-label" for="best_book_or_movie">
                                Talk about "The best book You’ve read or movie you’ve watched" at least 2 minutes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answer_the_following_3_Questions" id="situation" value="situation">
                            <label style="color: #18a674;font-weight: bold;" class="form-check-label" for="situation">
                                A situation you want to share with us. at least 2 minutes
                            </label>
                        </div>
                    </div> --}}

                    <div class="col-lg-12 col-md-12 col-sm-12 form-group text-right">
                        <button class="theme-btn btn-style-three" type="submit"><span class="txt">Submit <i class="fa fa-angle-right"></i></span></button>
                    </div>
                </form>
                    
            </div>
            
        </div>
    </div>
</section>
<!-- End Contact Page Section -->

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
        <div class="modal-content text-right px-3 pt-5">
            <div class="modal-body text-center">
                <div id="res"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> Close Window </button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
				<i class="fa fa-times text-danger" style="font-size: 100px;"></i>
				<h3>Error Occured</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> Close Window </button>
            </div>
        </div>
    </div>
</div>
@endsection