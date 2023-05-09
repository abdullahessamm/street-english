<form id="updateVideo">
    {{ csrf_field() }}
    <input type="hidden" name="lesson_id" value="{{ $onlineCourseLesson->id }}">
    <div class="modal-header">
        <h5 class="modal-title" id="createNewContentModalLabel">{{ $onlineCourseLesson->title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
        @switch($onlineCourseLesson->video_type)
            @case('youtube')
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$onlineCourseLesson->video_url}}" allowfullscreen></iframe>
            </div>
            @break
            
            @case('vimeo')
            <div class="embed-responsive embed-responsive-16by9">
                <iframe src="https://player.vimeo.com/video/{{$onlineCourseLesson->video_url}}" allow="autoplay; fullscreen" allowfullscreen></iframe>
            </div>
            @break

            @case('drive')
                <div class="embed-responsive embed-responsive-16by9">
                    {!!$onlineCourseLesson->video_url!!}
                </div>
            @break
        @endswitch
        </div>

        <div class="form-group text-left">
            <label for="video_type">Change Video Type</label>
            <select name="video_type" id="video_type" id="video_type" class="form-control">
                <option value="youtube" {{ $onlineCourseLesson->video_type == "youtube" ? "selected" : null }}>Youtube</option>
                <option value="vimeo" {{ $onlineCourseLesson->video_type == "vimeo" ? "selected" : null }}>Vimeo</option>
                <option value="drive" {{ $onlineCourseLesson->video_type == "drive" ? "selected" : null }}>Google Drive</option>
            </select>
        </div>

        <div class="form-group text-left">
            <label for="video_url">Change video url</label>
            <textarea name="video_url" class="form-control" id="video_url" cols="30" rows="3" required dir="ltr"></textarea>
            <small id="update_video_res"></small>
        </div>

        <div class="form-group text-left">
            <label for="video_url">Change video description</label>
            <textarea name="video_url" class="form-control" id="video_url" cols="30" rows="3" required dir="ltr">{{ $onlineCourseLesson->video_description }}</textarea>
            <small id="update_video_res"></small>
        </div>


        <div class="form-group text-left">
            <button type="submit" class="btn btn-warning font-weigh-bold text-dark btn-sm font-weight-bold" id="updateVideoBtn">Update</button>
        </div>
    </div>
</form>