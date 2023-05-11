<div class="modal-header">
    <h5 class="modal-title" id="previewLessonModalLabel">{{ $lesson->title }}</h5>
</div>
<div class="modal-body">
    @switch($lesson->video_type)
        @case('youtube')
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$lesson->video_url}}" allowfullscreen></iframe>
        </div>
        @break
        
        @case('vimeo')
        <div class="embed-responsive embed-responsive-16by9">
            <iframe src="https://player.vimeo.com/video/{{$lesson->video_url}}" allow="autoplay; fullscreen" allowfullscreen></iframe>
        </div>
        @break

        @case('drive')
        <div class="embed-responsive embed-responsive-16by9">
            {!!$lesson->video_url!!}
        </div>
        @break
    @endswitch
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary close-lesson" data-dismiss="modal">Close</button>
</div>