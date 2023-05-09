<form id="updateVideo">
    {{ csrf_field() }}
    <input type="hidden" name="lesson_id" value="{{ $courseLesson->id }}">
    <div class="modal-header">
        <h5 class="modal-title" id="createNewContentModalLabel">{{ $courseLesson->title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
        @switch($courseLesson->video_type)
            @case('youtube')
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$courseLesson->video_url}}" allowfullscreen></iframe>
            </div>
            @break
            
            @case('vimeo')
            <div class="embed-responsive embed-responsive-16by9">
                <iframe src="https://player.vimeo.com/video/{{$courseLesson->video_url}}" allow="autoplay; fullscreen" allowfullscreen></iframe>
            </div>
            @break

            @case('drive')
            <div class="embed-responsive embed-responsive-16by9">
                {!!$courseLesson->video_url!!}
            </div>
            @break
        @endswitch
        </div>

        <div class="form-group text-left">
            <label for="video_type">Change Video Type</label>
            <select name="video_type" id="video_type" id="video_type" class="form-control">
                <option value="youtube" {{ $courseLesson->video_type == "youtube" ? "selected" : null }}>Youtube</option>
                <option value="vimeo" {{ $courseLesson->video_type == "vimeo" ? "selected" : null }}>Vimeo</option>
                <option value="drive" {{ $courseLesson->video_type == "drive" ? "selected" : null }}>Google Drive</option>
            </select>
        </div>

        <div class="form-group text-left">
            <label for="video_url">Change video url</label>
            <textarea name="video_url" class="form-control" id="video_url" cols="30" rows="3" dir="ltr"></textarea>
            <small id="update_video_res"></small>
        </div>

        <div class="form-group text-left">
            <label for="video_description">Change video description</label>
            <textarea name="video_description" class="form-control" id="video_description" cols="30" rows="3" dir="ltr">{{ $courseLesson->video_description }}</textarea>
            <small id="update_video_res"></small>
        </div>


        <div class="form-group text-left">
            <button type="submit" class="btn btn-warning font-weigh-bold text-dark btn-sm font-weight-bold" id="updateVideoBtn">Update</button>
        </div>
    </div>
</form>