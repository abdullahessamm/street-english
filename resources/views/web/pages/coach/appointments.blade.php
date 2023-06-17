<div class="modal-header">
    <h5 class="modal-title" id="appointmentModalLabel">Avaliable Appointments on {{ $date }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="bookMeeting">
    {{ csrf_field() }}
    <div class="modal-body text-right" dir="rtl">
        @for ($i = 0; $i < count($appointments); $i++)
        @php
            list($time, $attr) = explode(' ', date("h:i a", strtotime($appointments[$i]['start_time'])));
            $am_or_pm = $attr == 'am' ? 'صباحا' : 'مساء';
        @endphp
        <div class="form-check">
            
            <input class="form-check-input" type="radio" name="appointment" id="{{ $appointments[$i]['appointment_id'] }}" value="{{ $appointments[$i]['appointment_id'] }}" {!! $appointments[$i]['is_taken'] == 0 ? "required" : "disabled" !!} >
            <label class="form-check-label mx-3" for="{{ $appointments[$i]['appointment_id'] }}">
                الساعة {{ $time }} {{ $am_or_pm }} - {!! $appointments[$i]['is_taken'] == 0 ? '<span class="text-success">متاح</span>' : '<span class="text-danger">غير متاح</span>' !!}
            </label>
        </div>
        @endfor
        
        <hr>

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="form-group">
                    <input type="text" class="form-control framed" name="name" id="first-name" placeholder="الأسم الاول" required>
                </div><!-- /.form-group -->
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="form-group">
                    <input type="email" class="form-control framed" name="email" id="booking-email" placeholder="البريد الالكتروني" required>
                </div><!-- /.form-group -->
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <input type="text" class="form-control framed" name="phone" id="phone-number" placeholder="رقم هاتفك" pattern="\d*" required>
                </div><!-- /.form-group -->
            </div>
        </div>    
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Book Meeting</button>
    </div>
</form>
