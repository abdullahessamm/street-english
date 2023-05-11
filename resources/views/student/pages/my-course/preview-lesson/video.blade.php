@switch($lesson->video->type)
    @case('youtube')
    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $lesson->video->url }}?autoplay=0&rel=0&showinfo=0" allowfullscreen></iframe>
    </div>
    @break
    
    @case('vimeo')
    <div class="embed-responsive embed-responsive-16by9">
        <iframe src="https://player.vimeo.com/video/{{ $lesson->video->url }}" allow="autoplay; fullscreen" allowfullscreen></iframe>
    </div>
    @break

    @case('drive')
    <div class="embed-responsive embed-responsive-16by9">
        {!! $lesson->video->url !!}
    </div>
    @break
@endswitch