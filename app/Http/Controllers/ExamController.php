<?php

namespace App\Http\Controllers;

use App\Models\SurveyJs\SurveyAnswer;
use App\Models\SurveyJs\SurveyJs;
use App\Models\SurveyJs\SurveyQuestion;
use App\Models\SurveyJs\SurveyUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index($slug)
    {
        $surveyJs = SurveyJs::where('slug', $slug)->first();

        $surveyJs == null ? abort(404) : true;

        return view('pages.exam.index', compact('surveyJs'));
    }

    public function show($slug)
    {
        $surveyUser = SurveyUser::where('slug', $slug)->first();

        $surveyUser == null ? abort(404) : true;

        $survey_json_file = $this->getUniversalPath('public/uploads/surveys/survey-js/'.$surveyUser->belongsToSurveyJs->slug.'/survey.json', 'admin');
        
        $survey_json_data = json_encode(json_decode(file_get_contents($survey_json_file), JSON_PRETTY_PRINT), true);

        return view('pages.exam.show', compact('surveyUser', 'survey_json_data'));
    }

    public function results($slug)
    {
        $surveyUser = SurveyUser::where('slug', $slug)->first();

        $surveyUser == null ? abort(404) : true;

        $surveyUser->hasFinished == 0 ? abort(404) : true;

        $surveyJs = SurveyJs::where('slug', $surveyUser->belongsToSurveyJs->slug)->first();

        $survey_json_file = $this->getUniversalPath('public/uploads/surveys/survey-js/'.$surveyUser->belongsToSurveyJs->slug.'/survey.json', 'admin');

        $survey_json_data = json_encode(json_decode(file_get_contents($survey_json_file), JSON_PRETTY_PRINT), true);

        $survey_pages = json_decode($survey_json_data, true)['pages'];

        $test_score = $surveyJs->questions->sum('score');
        $user_score = $surveyUser->answers->sum('user_score');
        
        $final_score = $user_score.'/'.$test_score;

        return view('pages.exam.result', compact('surveyUser', 'surveyJs', 'survey_pages', 'final_score'));
    }

    public function joinExam(Request $request)
    {
        $survey_id = $request->input('survey_jd');
        $username = $request->input('username');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $whatstapp = $request->input('whatstapp');

        !filter_var($email, FILTER_VALIDATE_EMAIL) ? $this->errorMsg('Email is invalid') : true;

        $checkSurveyUser = SurveyUser::where('survey_id', $survey_id)->where('email', $email)->where('hasFinished', 1)->first();

        if($checkSurveyUser != null){

            $this->successMsg('Showing my exam result');

            $this->redierctTo('exam/user/'.$checkSurveyUser->slug.'/results');

        }else{

            $surveyUser = SurveyUser::firstOrCreate(['survey_id' => $survey_id, 'email' => $email],[
                'survey_id' => $survey_id,
                'username' => $username,
                'email' => $email,
                'phone_number' => $phone,
                'whatstapp' => $whatstapp,
                'hasJoined' => 1,
                'joined_at' => Carbon::now(),
                'slug' => md5(uniqid()),
            ]);
    
            $this->successMsg('You have joined the exam');
    
            $this->redierctTo('exam/user/'.$surveyUser->slug.'/show');
        }
    }

    public function submitAnswers(Request $request)
    {
        $survey_user_id = $request->input('survey_user_id');
        $answers = $request->input('surveyData');

        $surveyUser = SurveyUser::where('id', $survey_user_id)->first();
        
        $survey_json_file = $this->getUniversalPath('public/uploads/surveys/survey-js/'.$surveyUser->belongsToSurveyJs->slug.'/survey.json', 'admin');
        
        $survey_json_data = json_encode(json_decode(file_get_contents($survey_json_file), JSON_PRETTY_PRINT), true);

        $pages = json_decode($survey_json_data, true)['pages'];

        $questions_name = [];

        for($i = 0; $i < count($pages); $i++){

            for($j = 0; $j < count($pages[$i]['elements']); $j++){

                $questions_name[] = $pages[$i]['elements'][$j]['name'];
            }
        }

        foreach($questions_name as $question_name){

            $question_id = SurveyQuestion::where('survey_id', $surveyUser->belongsToSurveyJs->id)->where('question_name', $question_name)->first()->id;

            SurveyAnswer::firstOrCreate(['survey_user_id' => $surveyUser->id, 'survey_question_id' => $question_id],[
                'survey_user_id' => $surveyUser->id,
                'survey_question_id' => $question_id,
                'my_answer' => isset($answers[$question_name]) ? (is_array($answers[$question_name]) ? serialize($answers[$question_name]) : $answers[$question_name]) : null,
            ]);
        }

        $surveyUser->update([
            'hasFinished' => 1,
            'finished_at' => Carbon::now(),
        ]);

        $this->successMsg('You have completed the exam');

        $this->redierctTo('exam/user/'.$surveyUser->slug.'/results');
    }
}
