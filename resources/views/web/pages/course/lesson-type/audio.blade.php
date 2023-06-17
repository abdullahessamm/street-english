<audio controls style="width: 100%;max-height: 100%;" {!! $lesson->audio->isDownloadable == 1 ? null : 'controlsList="nodownload"' !!}>
    <source src="{{ asset('public/uploads/courses/'.$lesson->belongsToContent->belongsToCourse->id.'/contents/'.$lesson->belongsToContent->id.'/lessons/'.$lesson->id.'/'.$lesson->audio->audio) }}" type="video/mp4">
    Your browser does not support the audio tag.
</audio>