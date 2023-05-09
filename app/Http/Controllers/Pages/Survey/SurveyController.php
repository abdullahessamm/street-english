<?php

namespace App\Http\Controllers\Pages\Survey;

use App\Http\Controllers\Controller;
use App\Models\SurveyJs\SurveyAnswer;
use App\Models\SurveyJs\SurveyJs;
use App\Models\SurveyJs\SurveyQuestion;
use App\Models\SurveyJs\SurveyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class SurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.survey-js.index');
    }

    public function create()
    {
        return view('pages.survey-js.create');
    }

    public function show($slug)
    {
        $survey = SurveyJs::where('slug', $slug)->first();

        $survey == null ? $this->redierctTo('survey-js/all-surveys') : true;

        $survey_json_file = public_path('uploads/surveys/survey-js/'.$slug.'/survey.json');
        
        $survey_json_data = json_encode(json_decode(file_get_contents($survey_json_file), JSON_PRETTY_PRINT), true);

        return view('pages.survey-js.show')
        ->with('survey', $survey)
        ->with('survey_json_data', $survey_json_data);
    }

    public function preview($slug)
    {
        $survey = SurveyJs::where('slug', $slug)->first();

        $survey_json_file = public_path('uploads/surveys/survey-js/'.$slug.'/survey.json');
        
        $survey_json_data = json_encode(json_decode(file_get_contents($survey_json_file), JSON_PRETTY_PRINT), true);

        return view('pages.survey-js.preview')
        ->with('survey', $survey)
        ->with('survey_json_data', $survey_json_data);
    }

    public function surveyUsers($slug)
    {
        $surveyJs = SurveyJs::where('slug', $slug)->first();

        return view('pages.survey-js.user.index', compact('surveyJs'));
    }

    public function surveyUser($survey_slug, $user_slug)
    {
        $surveyUser = SurveyUser::where('slug', $user_slug)->first();
        $surveyJs = SurveyJs::where('slug', $survey_slug)->first();
        
        $survey_json_file = public_path('uploads/surveys/survey-js/'.$survey_slug.'/survey.json');
        
        $survey_json_data = json_encode(json_decode(file_get_contents($survey_json_file), JSON_PRETTY_PRINT), true);

        $survey_pages = json_decode($survey_json_data, true)['pages'];
        
        return view('pages.survey-js.user.show', compact('surveyUser', 'survey_pages', 'surveyJs'));
    }

    // datatable to view all educational stages
    public function datatable()
    {
        $survey = SurveyJs::get();

        return Datatables::of($survey)
        ->editColumn('title', function ($survey) {
            return '<a href="'.route('survey-js.show', $survey->slug).'">'.$survey->title.'</a>';
        })
        ->editColumn('public_url', function ($survey) {
            return '<a href="'.config('app.main_url').'/exam/'.$survey->slug.'/register" target="_blank">'.$survey->title.' Public URL</a>';
        })
        ->editColumn('users', function ($survey) {
            return '<a href="'.route('survey-js.users', $survey->slug).'">'.$survey->surveyUsers->count().'</a>';
        })
        ->rawColumns(['title', 'public_url', 'users'])
        ->make(true);
    }

    public function surveyUserDatatable($slug)
    {
        $surveyUser = SurveyJs::where('slug', $slug)->first()->surveyUsers;

        return Datatables::of($surveyUser)
        ->editColumn('username', function ($surveyUser) {
            return '<a href="'.route('survey-js.user.show', [$surveyUser->belongsToSurveyJs->slug, $surveyUser->slug]).'">'.$surveyUser->username.'</a>';
        })
        ->editColumn('user', function ($surveyUser) {
            return $surveyUser->email;
        })
        ->editColumn('has_been_corrected', function ($surveyUser) {
            // return $surveyUser->hasBeenCorrected == 0 ? '<span'
            return $surveyUser->hasBeenCorrected == 0 ? '<span class="text-danger font-weight-bold">No</span>' : '<span class="text-success font-weight-bold">Yes</span>';
        })
        ->editColumn('results', function ($surveyUser) {
            return 0;
        })
        ->rawColumns(['username', 'has_been_corrected'])
        ->make(true);
    }

    public function ajaxCreateSurvey(Request $request)
    {
        $survey_json_data = $request->input('survey_json_data');

        $json = json_decode($survey_json_data, true);
        
        $slug = md5(uniqid());

        $survey_path = public_path('uploads/surveys/survey-js/'.$slug);

        if(!file_exists($survey_path)){

            mkdir($survey_path, 0777, true);
        }

        $myfile = fopen(public_path('uploads/surveys/survey-js/'.$slug.'/survey.json'), "w+") or die("Unable to open file!");
        fwrite($myfile, json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        fclose($myfile);

        $surveyJs = SurveyJs::create([
            'title' => isset($json['title']) ? $json['title'] : null,
            'description' => isset($json['description']) ? $json['description'] : null,
            'slug' => $slug,
        ]);


        $allowed_types = [
            'text', 'comment', 'checkbox', 'radiogroup'
        ];

        for($i = 0; $i < count($json['pages']); $i++){

            if(isset($json['pages'][$i]['elements'])){
                
                for($j = 0; $j < count($json['pages'][$i]['elements']); $j++){
                    
                    $question = isset($json['pages'][$i]['elements'][$j]['title']) ? $json['pages'][$i]['elements'][$j]['title'] : ' ';
                    $question_name = isset($json['pages'][$i]['elements'][$j]['name']) ? $json['pages'][$i]['elements'][$j]['name'] : ' ';

                    if(in_array($json['pages'][$i]['elements'][$j]['type'], $allowed_types)){

                        SurveyQuestion::create([
                            'survey_id' => $surveyJs->id,
                            'question' => $question,
                            'question_name' => $question_name,
                        ]);
                    }
                }
            }
        }

        $this->successMsg('New survey has been created');

        $this->redierctTo('survey-js/'.$slug.'/show');
    }

    public function update(Request $request)
    {
        $survey_id = $request->input('survey_id');
        $survey_json_data = $request->input('survey_json_data');

        $json = json_decode($survey_json_data, true);

        $survey = SurveyJs::where('id', $survey_id)->first();

        $survey_json_file = public_path('uploads/surveys/survey-js/'.$survey->slug.'/survey.json');

        file_exists($survey_json_file) ? $this->removeFile($survey_json_file) : true;

        // recreate json file
        $survey_path = public_path('uploads/surveys/survey-js/'.$survey->slug);

        if(!file_exists($survey_path)){

            mkdir($survey_path, 0777, true);
        }

        $myfile = fopen(public_path('uploads/surveys/survey-js/'.$survey->slug.'/survey.json'), "w+") or die("Unable to open file!");
        fwrite($myfile, json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        fclose($myfile);

        // update survey in database
        $survey->update([
            'title' => isset($json['title']) ? $json['title'] : null,
            'description' => isset($json['description']) ? $json['description'] : null,
        ]);

        // get survey questions
        $surveyQuestions = SurveyQuestion::where('survey_id', $survey_id)->get();

        // delete survey questions
        foreach($surveyQuestions as $surveyQuestion){

            $surveyQuestion->delete();
        }

        $score = 0;
        
        // recreate survey questions
        for($i = 0; $i < count($json['pages']); $i++){

            if(isset($json['pages'][$i]['elements'])){

                for($j = 0; $j < count($json['pages'][$i]['elements']); $j++){
    
                    $question = isset($json['pages'][$i]['elements'][$j]['title']) ? $json['pages'][$i]['elements'][$j]['title'] : ' ';
                    $question_name = isset($json['pages'][$i]['elements'][$j]['name']) ? $json['pages'][$i]['elements'][$j]['name'] : ' ';
    
                    if(isset($json['pages'][$i]['elements'][$j]['dataList'][0])){
    
                        $score = $json['pages'][$i]['elements'][$j]['dataList'][0];
    
                    }elseif(isset($json['pages'][$i]['elements'][$j]['valueName'])){
                        
                        $score = $json['pages'][$i]['elements'][$j]['valueName'];
    
                    }elseif(isset($json['pages'][$i]['elements'][$j]['defaultValueExpression'])){
    
                        $score = $json['pages'][$i]['elements'][$j]['defaultValueExpression'];
                    }
    
                    SurveyQuestion::create([
                        'survey_id' => $survey_id,
                        'question' => $question,
                        'question_name' => $question_name,
                    ]);
                }
            }
        }

        $this->successMsg('This survey has been update...');

        $this->reloadPage();
    }

    public function delete(Request $request)
    {
        $survey = SurveyJs::where('id', $request->input('survey_id'))->first();

        $survey_dir = public_path('uploads/surveys/survey-js/'.$survey->slug);

        file_exists($survey_dir) ? $this->deleteDir($survey_dir) : true;

        $survey->delete();

        $this->successMsg('This survey has been removed from our system');

        $this->redierctTo('survey-js/all-surveys');
    }

    public function correctUserAnswers(Request $request)
    {
        $survey_user_id = $request->input('survey_user_id');
        $user_answer_id = $request->input('user_answer_id');
        $user_score = $request->input('user_score');
        $question_score = $request->input('question_score');
        $correct_answer = $request->input('correct_answer');
        
        for($i = 0; $i < count($user_answer_id); $i++){

            $surveyAnswer = SurveyAnswer::where('id', $user_answer_id[$i])->first();

            $surveyAnswer->belongsToSurveyQuestion->update([
                'score' => $question_score[$i]
            ]);

            $surveyAnswer->update([
               'question_score' => $question_score[$i],
               'user_score' => $user_score[$i],
               'correct_answer' => $correct_answer[$i]
            ]);
        }

        $surveyUser = SurveyUser::where('id', $survey_user_id)->first();

        $surveyUser->update([
            'hasBeenCorrected' => 1
        ]);
        
        $data = [
            'to' => $surveyUser->email,
            'from' => 'info@'.config('app.domain'),
            'subject' => $surveyUser->belongsToSurveyJs->title." Results",
            'surveyUser' => $surveyUser,
        ];

        Mail::send('mail.survey-test-correction', ['data' => $data], function ($message) use ($data) {
            $message->to($data['to'])
            ->from($data['from'])
            ->subject($data['subject']);
        });

        $this->successMsg('This exam has been corrected');
    }
}
