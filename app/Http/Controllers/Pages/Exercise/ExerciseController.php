<?php

namespace App\Http\Controllers\Pages\Exercise;

use App\Http\Controllers\Controller;
use App\Models\Excercises\ExerciseAnswer;
use App\Models\Exercises\Exercise;
use App\Models\Exercises\ExerciseQuestion;
use App\Models\Exercises\ExerciseUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;


class ExerciseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.exercise.index');
    }

    public function create()
    {
        return view('pages.exercise.create');
    }

    public function show($slug)
    {
        $exercise = Exercise::where('slug', $slug)->first();

        $exercise == null ? $this->redierctTo('exercise/all-exercises') : true;

        $exercise_json_file = public_path('uploads/exercises/exercise/'.$slug.'/exercise.json');
        
        $exercise_json_data = json_encode(json_decode(file_get_contents($exercise_json_file), JSON_PRETTY_PRINT), true);

        return view('pages.exercise.show')
        ->with('exercise', $exercise)
        ->with('exercise_json_data', $exercise_json_data);
    }

    public function preview($slug)
    {
        $exercise = Exercise::where('slug', $slug)->first();

        $exercise_json_file = public_path('uploads/exercises/exercise/'.$slug.'/exercise.json');

        $exercise_json_data = json_encode(json_decode(file_get_contents($exercise_json_file), JSON_PRETTY_PRINT), true);

        return view('pages.exercise.preview')
        ->with('exercise', $exercise)
        ->with('exercise_json_data', $exercise_json_data);
    }

    public function exerciseUsers($slug)
    {
        $exerciseJs = Exercise::where('slug', $slug)->first();

        return view('pages.exercise.user.index', compact('exerciseJs'));
    }

    public function exerciseUser($exercise_slug, $user_slug)
    {
        $exerciseUser = ExerciseUser::where('slug', $user_slug)->first();
        $exerciseJs = Exercise::where('slug', $exercise_slug)->first();
        
        $exercise_json_file = public_path('uploads/exercises/exercise/'.$exercise_slug.'/exercise.json');
        
        $exercise_json_data = json_encode(json_decode(file_get_contents($exercise_json_file), JSON_PRETTY_PRINT), true);

        $exercise_pages = json_decode($exercise_json_data, true)['pages'];
        
        return view('pages.exercise.user.show', compact('exerciseUser', 'exercise_pages', 'exerciseJs'));
    }

    // datatable to view all educational stages
    public function datatable()
    {
        $exercise = Exercise::get();

        return Datatables::of($exercise)
        ->editColumn('title', function ($exercise) {
            return '<a href="'.route('exercise.show', $exercise->slug).'">'.$exercise->title.'</a>';
        })
        ->editColumn('users', function ($exercise) {
            return '<a href="'.route('exercise.users', $exercise->slug).'">'.$exercise->exerciseUsers->count().'</a>';
        })
        ->rawColumns(['title', 'users'])
        ->make(true);
    }

    public function exerciseUserDatatable($slug)
    {
        $exerciseUser = Exercise::where('slug', $slug)->first()->exerciseUsers;

        return Datatables::of($exerciseUser)
        ->editColumn('username', function ($exerciseUser) {
            return '<a href="'.route('exercise.user.show', [$exerciseUser->belongsToexerciseJs->slug, $exerciseUser->slug]).'">'.$exerciseUser->username.'</a>';
        })
        ->editColumn('user', function ($exerciseUser) {
            return $exerciseUser->email;
        })
        ->editColumn('has_been_corrected', function ($exerciseUser) {
            // return $exerciseUser->hasBeenCorrected == 0 ? '<span'
            return $exerciseUser->hasBeenCorrected == 0 ? '<span class="text-danger font-weight-bold">No</span>' : '<span class="text-success font-weight-bold">Yes</span>';
        })
        ->editColumn('results', function ($exerciseUser) {
            return 0;
        })
        ->rawColumns(['username', 'has_been_corrected'])
        ->make(true);
    }

    public function ajaxCreateExcercise(Request $request)
    {
        $exercise_json_data = $request->input('exercise_json_data');

        $json = json_decode($exercise_json_data, true);
        
        $slug = md5(uniqid());

        $exercise_path = public_path('uploads/exercises/exercise/'.$slug);

        if(!file_exists($exercise_path)){

            mkdir($exercise_path, 0777, true);
        }

        $myfile = fopen(public_path('uploads/exercises/exercise/'.$slug.'/exercise.json'), "w+") or die("Unable to open file!");
        fwrite($myfile, json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        fclose($myfile);

        $exerciseJs = Exercise::create([
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

                        ExerciseQuestion::create([
                            'exercise_id' => $exerciseJs->id,
                            'question' => $question,
                            'question_name' => $question_name,
                        ]);
                    }
                }
            }
        }

        $this->successMsg('New exercise has been created');

        $this->redierctTo('exercise/'.$slug.'/show');
    }

    public function update(Request $request)
    {
        $exercise_id = $request->input('exercise_id');
        $exercise_json_data = $request->input('exercise_json_data');

        $json = json_decode($exercise_json_data, true);

        $exercise = Exercise::where('id', $exercise_id)->first();

        $exercise_json_file = public_path('uploads/exercises/exercise/'.$exercise->slug.'/exercise.json');

        file_exists($exercise_json_file) ? $this->removeFile($exercise_json_file) : true;

        // recreate json file
        $exercise_path = public_path('uploads/exercises/exercise/'.$exercise->slug);

        if(!file_exists($exercise_path)){

            mkdir($exercise_path, 0777, true);
        }

        $myfile = fopen(public_path('uploads/exercises/exercise/'.$exercise->slug.'/exercise.json'), "w+") or die("Unable to open file!");
        fwrite($myfile, json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        fclose($myfile);

        // update exercise in database
        $exercise->update([
            'title' => isset($json['title']) ? $json['title'] : null,
            'description' => isset($json['description']) ? $json['description'] : null,
        ]);

        // get exercise questions
        $exerciseQuestions = ExerciseQuestion::where('exercise_id', $exercise_id)->get();

        // delete exercise questions
        foreach($exerciseQuestions as $exerciseQuestion){

            $exerciseQuestion->delete();
        }

        $score = 0;
        
        // recreate exercise questions
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
    
                    ExerciseQuestion::create([
                        'exercise_id' => $exercise_id,
                        'question' => $question,
                        'question_name' => $question_name,
                    ]);
                }
            }
        }

        $this->successMsg('This exercise has been update...');

        $this->reloadPage();
    }

    public function delete(Request $request)
    {
        $exercise = Exercise::where('id', $request->input('exercise_id'))->first();

        $exercise_dir = public_path('uploads/exercises/exercise/'.$exercise->slug);

        file_exists($exercise_dir) ? $this->deleteDir($exercise_dir) : true;

        $exercise->delete();

        $this->successMsg('This exercise has been removed from our system');

        $this->redierctTo('exercise/all-exercises');
    }

    public function correctUserAnswers(Request $request)
    {
        $exercise_user_id = $request->input('exercise_user_id');
        $user_answer_id = $request->input('user_answer_id');
        $user_score = $request->input('user_score');
        $question_score = $request->input('question_score');
        $correct_answer = $request->input('correct_answer');
        
        for($i = 0; $i < count($user_answer_id); $i++){

            $exerciseAnswer = ExerciseAnswer::where('id', $user_answer_id[$i])->first();

            $exerciseAnswer->belongsToexerciseQuestion->update([
                'score' => $question_score[$i]
            ]);

            $exerciseAnswer->update([
               'question_score' => $question_score[$i],
               'user_score' => $user_score[$i],
               'correct_answer' => $correct_answer[$i]
            ]);
        }

        $exerciseUser = ExerciseUser::where('id', $exercise_user_id)->first();

        $exerciseUser->update([
            'hasBeenCorrected' => 1
        ]);
        
        $data = [
            'to' => $exerciseUser->email,
            'from' => 'info@'.config('app.domain'),
            'subject' => $exerciseUser->belongsToexerciseJs->title." Results",
            'exerciseUser' => $exerciseUser,
        ];

        Mail::send('mail.exercise-test-correction', ['data' => $data], function ($message) use ($data) {
            $message->to($data['to'])
            ->from($data['from'])
            ->subject($data['subject']);
        });

        $this->successMsg('This exam has been corrected');
    }
}