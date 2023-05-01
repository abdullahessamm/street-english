{!! $lesson->context->content !!}

<div class="mb-24pt">
    
    <span class="chip chip-outline-secondary d-inline-flex align-items-center">
        <i class="material-icons icon--left">assessment</i>
        {{ $lesson->belongsToContent->belongsToCourse->level }}
    </span>
</div>

<p class="lead measure-lead text-70 mb-24pt">
    {!! $lesson->description !!}
</p>