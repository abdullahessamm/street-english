<div class="form-group row">
    <label class="col-md-3 label-control" for="exam_timezone">Exam Timezone</label>
    <div class="col-md-9">
        @php
            $timezones = timezone_identifiers_list();
        @endphp
        <select name="exam_timezone" id="exam_timezone" class="select2 form-control">
        @foreach($timezones as $timezone)
            <option value="{{ $timezone }}">{{ $timezone }}</option>
        @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 label-control" for="exam_date">Date</label>
    <div class="col-md-9">
        <input type="date" id="exam_date" class="form-control" name="exam_date" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 label-control" for="start_at">Start at</label>
    <div class="col-md-9">
        <input type="time" id="start_at" class="form-control" name="start_at" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 label-control" for="end_at">End at</label>
    <div class="col-md-9">
        <input type="time" id="end_at" class="form-control" name="end_at" required>
    </div>
</div>

<script>
	$(".select2").select2();
</script>