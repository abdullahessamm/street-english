@if($lesson->doc->isDownloadable == 1)
<iframe src="{{ asset('public/uploads/courses/'.$lesson->belongsToContent->belongsToCourse->id.'/contents/'.$lesson->belongsToContent->id.'/lessons/'.$lesson->id.'/'.$lesson->doc->pdf) }}" width="100%" height="500px"></iframe>
@else
<iframe src="{{ asset('public/uploads/courses/'.$lesson->belongsToContent->belongsToCourse->id.'/contents/'.$lesson->belongsToContent->id.'/lessons/'.$lesson->id.'/'.$lesson->doc->pdf.'#toolbar=0') }}" width="100%" height="500px"></iframe>
@endif