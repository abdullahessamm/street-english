<h1>{{ $data['surveyUser']->belongsToSurveyJs->title }} Results</h1>

<p>Your result for {{ $data['surveyUser']->belongsToSurveyJs->title }} has been published</p>

<p>
    To see your results <a href="{{config('app.main_url')}}/exam/user/{{$data['surveyUser']->slug}}/results">Click Here</a>
</p>

<p>Have a nice day</p>