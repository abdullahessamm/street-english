<div class="text-left">
    <div class="form-group">
        <label class="label-control" for="points">عدد النقاط</label>
        <div class="row">
            <div class="col-md-9">
                <input type="number" name="points" id="points" min="0" class="form-control" value="{{ $getPoints }}" pattern="[0-9]+">
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-primary" id="addPoints" data-lesson-id="{{ $lesson_id }}">اضافة النقاط</button>
            </div>
        </div>
    </div>
</div>