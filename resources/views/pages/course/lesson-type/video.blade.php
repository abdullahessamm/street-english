<div class="embed-responsive embed-responsive-16by9 video-lesson">
    <video width="320" height="240" controls {!! $lesson->video->isDownloadable == 1 ? null : 'controlsList="nodownload"' !!}>
        <source src="{{ asset('public/uploads/courses/'.$lesson->belongsToContent->belongsToCourse->id.'/contents/'.$lesson->belongsToContent->id.'/lessons/'.$lesson->id.'/'.$lesson->video->video) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>