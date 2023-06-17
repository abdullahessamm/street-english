<div class="modal-header">
    <h5 class="modal-title" id="previewLessonModalLabel">{{ $lesson->title }}</h5>
</div>
<div class="modal-body">
    @switch($lesson->type)
        @case('video')
        @switch($lesson->video->type)
            @case('youtube')
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$lesson->video->url}}" allowfullscreen></iframe>
            </div>
            @break
            
            @case('vimeo')
            <div class="embed-responsive embed-responsive-16by9">
                <iframe src="https://player.vimeo.com/video/{{$lesson->video->url}}" allow="autoplay; fullscreen" allowfullscreen></iframe>
            </div>
            @break

            @case('drive')
            <div class="embed-responsive embed-responsive-16by9">
                {!!$lesson->video->url!!}
            </div>
            @break
        @endswitch
        @break

        @case('context')
        <span class="fa fa-file-text"></span>
        {{ $lesson->title }}
        @break

        @case('doc')
        <span class="fa fa-file-pdf-o"></span>
        {{ $lesson->title }}
        @break

        @case('frame')
        <span class="fa fa-external-link"></span>
        {{ $lesson->title }}
        @break
        
        @case('exercise')
        <span class="fa fa-pencil-square-o"></span>
        {{ $lesson->title }}
        @break
    @endswitch
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary close-lesson" data-dismiss="modal">Close</button>
</div>