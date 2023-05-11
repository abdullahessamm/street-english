@extends('layouts.app', [
	'title' => 'My Results',
])

@section('content')
<!-- Login Section -->
<section class="container login-section">
    <div class="row">
        <div class="col-12">
            @if($surveyUser->hasBeenCorrected == 0)
            <div class="jumbotron text-center bg-light">
                <h3>Waiting For my results</h3>
            </div>
            @else
            <div class="card mt-5">
                <div class="card-header">
                    <h3 class="card-title float-left" style="color: #18a674;">My Answers</h3>
                    <div class="float-right">
                        <h3 class="text-danger">{{ $final_score }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @php
                            $x = 1;
                        @endphp
                        <div class="col-12">
                        @for($i = 0; $i < count($survey_pages); $i++)
                            @for ($j = 0; $j < count($survey_pages[$i]['elements']); $j++)
                                @php
                                $surveyQuestion = App\Models\SurveyJs\SurveyQuestion::where('survey_id', $surveyJs->id)->where('question_name', $survey_pages[$i]['elements'][$j]['name'])->first();
                                $survey_question_id = App\Models\SurveyJs\SurveyQuestion::where('survey_id', $surveyJs->id)->where('question_name', $survey_pages[$i]['elements'][$j]['name'])->first()->id;
                                $surveyUserAnswer = App\Models\SurveyJs\SurveyAnswer::where('survey_user_id', $surveyUser->id)->where('survey_question_id', $survey_question_id)->first();
                                @endphp
                                
                                @if($survey_pages[$i]['elements'][$j]['type'] == 'text')
                                <div class="form-group row">
                                    <h4 class="col-9"><span style="color: #18a674;">{{$x++}} - Question :</span> <span style="color: #1e284b;font-weight: bold;">{{ $survey_pages[$i]['elements'][$j]['title'] }}</span></h4>
                                    <h4 class="col-3 text-right text-danger">{{ $surveyUserAnswer->user_score }} / {{ $surveyQuestion->score }}</h4>
                                </div>

                                <p style="font-size: 18px;"><span style="color: #18a674;">Your Answer :</span> <span class="font-weight-bold">{{ $surveyUserAnswer->my_answer }}</span></p>

                                @if($surveyUserAnswer->correct_answer != null)
                                <p style="font-size: 18px;"><span class="text-danger">The Correct Answer :</span> <span class="font-weight-bold">{{ $surveyUserAnswer->correct_answer }}</span></p>
                                @endif
                        
                                @elseif($survey_pages[$i]['elements'][$j]['type'] == 'comment')
                                <div class="form-group row">
                                    <h4 class="col-9"><span style="color: #18a674;">{{$x++}} - Question :</span> <span style="color: #1e284b;font-weight: bold;">{{ $survey_pages[$i]['elements'][$j]['title'] }}</span></h4>
                                    <h4 class="col-3 text-right text-danger">{{ $surveyUserAnswer->user_score }} / {{ $surveyQuestion->score }}</h4>
                                </div>

                                <p style="font-size: 18px;"><span style="color: #18a674;">Your Answer :</span> <span class="font-weight-bold">{{ $surveyUserAnswer->my_answer }}</span></p>

                                @if($surveyUserAnswer->correct_answer != null)
                                <p style="font-size: 18px;"><span class="text-danger">The Correct Answer :</span> <span class="font-weight-bold">{{ $surveyUserAnswer->correct_answer }}</span></p>
                                @endif

                                @elseif($survey_pages[$i]['elements'][$j]['type'] == 'checkbox')
                                <div class="form-group row">
                                    <h4 class="col-9"><span style="color: #18a674;">{{$x++}} - Question :</span> <span style="color: #1e284b;font-weight: bold;">{{ $survey_pages[$i]['elements'][$j]['title'] }}</span></h4>
                                    <h4 class="col-3 text-right text-danger">{{ $surveyUserAnswer->user_score }} / {{ $surveyQuestion->score }}</h4>
                                </div>
                                
                                <h4 style="color: #18a674;">Your Answer</h4>
                                @php
                                    $unserialzed_answers = unserialize($surveyUserAnswer->my_answer);
                                @endphp
                                
                                @foreach ($unserialzed_answers as $unserialzed_answer)
                                <h4>{{ $unserialzed_answer }}</h4>
                                @endforeach

                                @if($surveyUserAnswer->correct_answer != null)
                                <div class="form-group">
                                    <label for="correct_answer_{{$survey_question_id}}">
                                        The Correct Answer
                                        <small class="font-weight-bold text-danger">Optional</small>
                                    </label>
                                    {{ $surveyUserAnswer->correct_answer }}
                                </div>
                                @endif
    
                                @elseif($survey_pages[$i]['elements'][$j]['type'] == 'html')
                                
                                {!! $survey_pages[$i]['elements'][$j]['html'] !!}
    
                                @elseif($survey_pages[$i]['elements'][$j]['type'] == 'radiogroup')
                                <input type="hidden" name="user_answer_id[]" value="{{ $surveyUserAnswer->id }}">

                                <div class="form-group row">
                                    <h4 class="col-9"><span style="color: #18a674;">{{$x++}} - Question :</span> <span style="color: #1e284b;font-weight: bold;">{{ $survey_pages[$i]['elements'][$j]['title'] }}</span></h4>
                                    <h4 class="col-3 text-right text-danger">{{ $surveyUserAnswer->user_score }} / {{ $surveyQuestion->score }}</h4>
                                </div>

                                <h4 style="color: #18a674;">Your Answer</h4>
                                <h4>{{ $surveyUserAnswer->my_answer }}</h4>

                                @if($surveyUserAnswer->correct_answer != null)
                                <div class="form-group">
                                    <label for="correct_answer_{{$survey_question_id}}">
                                        The Correct Answer
                                        <small class="font-weight-bold text-danger">Optional</small>
                                    </label>
                                    {{ $surveyUserAnswer->correct_answer }}
                                </div>
                                @endif
    
                                @endif
                                <hr>
                            @endfor
                        @endfor
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
<!-- End Login Section -->
@endsection