<div class="js-player card bg-primary embed-responsive embed-responsive-16by9 mb-24pt">
    <div class="player embed-responsive-item">
        <audio controls style="width: 100%;max-height: 100%;" {!! $lesson->audio->isDownloadable == 1 ? null : 'controlsList="nodownload"' !!}>
            <source src="{{ asset('public/uploads/courses/'.$lesson->belongsToContent->belongsToCourse->id.'/contents/'.$lesson->belongsToContent->id.'/lessons/'.$lesson->id.'/'.$lesson->audio->audio) }}" type="audio/mpeg">
            Your browser does not support the audio tag.
        </audio>
    </div>
</div>

<div class="mb-24pt">
    <span class="chip chip-outline-secondary d-inline-flex align-items-center">
        <i class="material-icons icon--left">schedule</i>
        {{ $lesson->audio->duration }} mins
    </span>
    <span class="chip chip-outline-secondary d-inline-flex align-items-center">
        <i class="material-icons icon--left">assessment</i>
        {{ $lesson->belongsToContent->belongsToCourse->level }}
    </span>
</div>

<p class="lead measure-lead text-70 mb-24pt">
    {!! $lesson->description !!}
</p>