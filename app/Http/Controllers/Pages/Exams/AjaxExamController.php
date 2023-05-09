<?php

namespace App\Http\Controllers\Pages\Exams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use App\Models\Exams\Exam;
use App\Models\Exams\ExamSection;
use App\Models\Exams\ExamQuestion;
use App\Models\Exams\ExamAnswer;
use App\Models\Exams\CorrectAnswer;

class AjaxExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $exam = Exam::query();

        return Datatables::of($exam)
        ->editColumn('exam_name', function ($exam) {
            return '<a href="'.route('exam.show', [$exam->slug]).'">'.$exam->exam_name.'</a>';
        })
        ->editColumn('delete_exam', function ($exam) {
            return '<button class="btn btn-danger btn-sm deleteExam" data-exam-id="'.$exam->id.'">Delete Exam</button>';
        })
        ->editColumn('created_at', function ($exam) {
            return date("Y-m-d h:i:s a", strtotime($exam->created_at));
        })
        ->rawColumns(['exam_name', 'delete_exam'])
        ->make(true);
    }

    public function create(Request $request)
    {
        $exam_name = $request->input('exam_name');
        $take_exam_anytime = $request->input('choose_exam_time_type') == 'anytime' ? 1 : 0;
        $exam_hours = $request->input('exam_hours');
        $exam_timezone = $request->input('exam_timezone');
        $exam_date = $request->input('exam_date');
        $start_at = $request->input('start_at');
        $end_at = $request->input('end_at');
        $slug = md5(uniqid());

        if($take_exam_anytime == 0)
        {
            $date1 = Carbon::createFromFormat('Y-m-d H:i', $exam_date.' '.$start_at);
            $date2 = Carbon::createFromFormat('Y-m-d H:i', $exam_date.' '.$end_at);
            
            // check if exam hasn't any previous dates
            if($exam_date < Carbon::today()->toDateString())
            {
                echo $this->errorMsg("You can't choose previous dates for the exam, please choose another date");
                die();
            }
    
            // check if exam date is not today
            if(Carbon::today()->toDateString() == $exam_date)
            {
                echo $this->errorMsg("Exam date can't be today, please choose another date");
                die();
            }
    
            // check if exam start time not equal exam end time
            if($date1->equalTo($date2))
            {
                echo $this->errorMsg("Exam start time can't be equal to exam end time");
                die();
            }
    
            // check if exam end time is greater than exam start time
            if($date2->lt($date1))
            {
                echo $this->errorMsg("Exam end time must be greater than exam start time");
                die();
            }
        }

        // data to insert
        $data = [
            'exam_name' => $exam_name,
            'take_exam_anytime' => $take_exam_anytime,
            'exam_hours' => $exam_hours,
            'exam_timezone' => $exam_timezone,
            'exam_date' => $exam_date,
            'start_at' => $start_at,
            'end_at' => $end_at,
            'slug' => $slug,
        ];

        // check if exam not exist then insert the above data
        $Exam = Exam::firstOrCreate(['exam_name' => $exam_name], $data);

        // if data inserted show success message
        if($Exam)
        {
            echo $this->successMsg("New exam has been created");
            $this->redierctTo('exam/show/'.$slug);
        }
        else
        {
            echo $this->errorMsg("Error occured") ;
        }
    }

    public function update(Request $request)
    {
        $exam_id = $request->input('exam_id');

        $exam = Exam::where('id', $exam_id)->first();
        
        $exam_name = $request->input('exam_name');
        $slug = $exam->slug;
        
        if($exam->take_exam_anytime == 0)
        {
            $exam_timezone = $request->input('exam_timezone');
            $exam_date = $request->input('exam_date');
            $start_at = date("H:i", strtotime($request->input('start_at')));
            $end_at = date("H:i", strtotime($request->input('end_at')));

            $now = Carbon::createFromFormat('Y-m-d H:i', date("Y-m-d H:i"));
            $date1 = Carbon::createFromFormat('Y-m-d H:i', $exam_date.' '.$start_at);
            $date2 = Carbon::createFromFormat('Y-m-d H:i', $exam_date.' '.$end_at);
            
            // check if exam hasn't any previous dates
            if($exam_date < Carbon::today()->toDateString())
            {
                echo $this->errorMsg("You can't choose previous dates for the exam, please choose another date");
                die();
            }
    
            // check if exam start time or end time is not now
            if($now->eq($date1) || $now->eq($date2))
            {
                echo $this->errorMsg("You can't choose exam start time or exam end time as now");
                die();
            }
    
            // check if exam time hasn't any previous time
            if($now->gt($date1) || $now->gt($date2))
            {
                echo $this->errorMsg("You can't choose previous time for the exam, please choose another time");
                die();
            }
    
            // check if exam start time not equal exam end time
            if($date1->equalTo($date2))
            {
                echo $this->errorMsg("Exam start time can't be equal to exam end time");
                die();
            }
    
            // check if exam end time is greater than exam start time
            if($date2->lt($date1))
            {
                echo $this->errorMsg("Exam end time must be greater than exam start time");
                die();
            }

            $exam_hours = null;
        }
        else
        {
            $exam_timezone = null;
            $exam_date = null;
            $start_at = null;
            $end_at = null;

            $exam_hours = $request->input('exam_hours');
        }

        Exam::where('id', $exam_id)->update([
            'exam_name' => $exam_name,
            'take_exam_anytime' => $exam->take_exam_anytime,
            'exam_hours' => $exam_hours,
            'exam_timezone' => $exam_timezone,
            'exam_date' => $exam_date,
            'start_at' => $start_at,
            'end_at' => $end_at,
            'slug' => $slug,
        ]);

        echo $this->successMsg("Exam info has been updated");
    }

    public function delete(Request $request)
    {
        $exam_id = $request->input('exam_id');

        $exam = Exam::where('id', $exam_id)->first();

        if($exam->delete())
        {
            echo $this->successMsg("Exam : '".$exam->exam_name."' has been removed from our database");
            echo $this->redierctTo('exams');
        }
    }

    public function forAnyOne(Request $request)
    {
        $exam_id = $request->input('exam_id');

        Exam::where('id', $exam_id)->update([
            'for_anyone' => 1
        ]);

        echo $this->successMsg("The exam is now set for anyone");
    }

    public function forRegistedUsers(Request $request)
    {
        $exam_id = $request->input('exam_id');

        Exam::where('id', $exam_id)->update([
            'for_anyone' => 0
        ]);

        echo $this->successMsg("The exam is now set only for registed users");
    }

    public function publish(Request $request)
    {
        $exam_id = $request->input('exam_id');

        $exam = Exam::where('id', $exam_id)->first();

        if($exam->sections->count() == 0)
        {
            echo $this->errorMsg("This exam cannot be published because it has no sections");
            die();
        }

        if($exam->questions->count() == 0)
        {
            echo $this->errorMsg("This exam cannot be published because it has no questions");
            die();
        }

        Exam::where('id', $exam_id)->update([
            'publish' => 1
        ]);

        echo $this->successMsg("This exam has been published");
    }
    
    public function unPublish(Request $request)
    {
        $exam_id = $request->input('exam_id');

        Exam::where('id', $exam_id)->update([
            'publish' => 0
        ]);

        echo $this->successMsg("This exam is not published");
    }

    public function createSection(Request $request)
    {
        $exam_id = $request->input('exam_id');
        $section_name = strtolower($request->input('section_name'));

        ExamSection::firstOrCreate(['section_name' => $section_name], [
            'exam_id' => $exam_id,
            'section_name' => $section_name,
        ]);

        echo $this->successMsg("New Section has been created");
        $this->reloadPage();
    }

    public function updateSection(Request $request)
    {
        $section_id = $request->input('section_id');
        $section_name = strtolower($request->input('section_name'));

        ExamSection::where('id', $section_id)->update([
            'section_name' => $section_name
        ]);

        echo $this->successMsg("Section name has been updated to : ".ucwords($section_name));
    }

    public function deleteSection(Request $request)
    {
        $section_id = $request->input('section_id');

        if(ExamSection::where('id', $section_id)->delete())
        {
            echo $this->successMsg("This section has been removed");
            $this->reloadPage();
        }
    }

    public function createQuestion(Request $request)
    {
        $exam_id = $request->input('exam_id');

        $questionInfo = $request->input('question');

        $section_id = $questionInfo['sectionID'];
        $score = $questionInfo['score'];
        $question = $questionInfo['question'];
        $answers = $questionInfo['answers'];
        $correct_answer = $questionInfo['correct_answer'];

        $questions_data = [
            'section_id' => $section_id,
            'question' => $question,
            'score' => $score,
        ];

        // create questions
        $ExamQuestion = ExamQuestion::create($questions_data);

        // get exam question scores
        $question_score = ExamQuestion::where('section_id', $section_id)->sum('score');

        // update section score
        ExamSection::where('id', $section_id)->update([
            'score' => $question_score
        ]);

        // get exam sections scores
        $sections_score = ExamSection::where('exam_id', $exam_id)->sum('score');

        // update exam full mark
        Exam::where('id', $exam_id)->update([
            'full_mark' => $sections_score
        ]);

        $html = <<<EOD
        <div class="form-group mb-2 border-bottom" id="question_{$ExamQuestion->id}">
            <h5 class="text-primary font-weight-bold">
                Score : <span data-exam-id="{exam_id}" data-section-id="{$section_id}" data-question-id="{$ExamQuestion->id}" contenteditable="true">{$score}</span>\
            </h5>
            <h3>
                Question : <span contenteditable="true" class="updateQuestion" data-question-id="{$ExamQuestion->id}">{$question}</span>
            </h3>
        EOD;
        for($i = 0; $i < count($answers); $i++)
        {
            // create answers
            $ExamAnswer = ExamAnswer::create([
                'question_id' => $ExamQuestion->id,
                'answer' => $answers[$i],
            ]);

            if($correct_answer == $answers[$i])
            {
                $correct_answer_id = ExamAnswer::where('question_id', $ExamQuestion->id)->where('answer', $answers[$i])->first()->id;
            }

            $checkIfCheckOrNot = isset($correct_answer_id) && $ExamAnswer->id == $correct_answer_id ? 'checked' : '';

            $html .= <<<EOD
            <div class="form-check the-answer" id="answer_{$ExamAnswer->id}_div">
                <input class="form-check-input updateCorrectAnswer" data-correct-answer-id="{$ExamAnswer->id}" type="radio" name="{$ExamQuestion->id}" value="{$ExamAnswer->id}" {$checkIfCheckOrNot}>
                <label class="form-check-label updateAnswer" id="answer_{$ExamAnswer->id}" data-answer-id="{$ExamAnswer->id}" contenteditable="true">
                    {$answers[$i]}
                </label>

            EOD;
            if(count($questionInfo['answers']) > 2)
                $html .= <<<EOD
                <button class="btn btn-danger deleteAnswer btn-sm question_answers_{$ExamQuestion->id}" data-answer-id="{$ExamAnswer->id}" data-question-id="{$ExamQuestion->id}">Delete this answer</button>
                EOD;
            $html .= <<<EOD
                <small id="answer_{$ExamAnswer->id}_hint" class="text-danger font-weight-bold"></small>
            </div>
            EOD;
        }
        $html .= <<<EOD
            
        </div>
        EOD;

        // create correct answer
        CorrectAnswer::create(['question_id' => $ExamQuestion->id, 'answer_id' => $correct_answer_id]);

        echo <<<HTML
        <script> 
            $("#questions_{$section_id}").after(`$html`); 
            $("#hint_before_questions").remove(); 
        </script>
        HTML;

        echo $this->successMsg("Question has been created");
    }
    
    public function updateQuestion(Request $request)
    {
        $question_id = $request->input('question_id');
        $question = $request->input('question');

        ExamQuestion::where('id', $question_id)->update([
            'question' => $question
        ]);
    }

    public function deleteQuestion(Request $request)
    {
        $exam_id = $request->input('exam_id');
        $section_id = $request->input('section_id');
        $question_id = $request->input('question_id');

        if(ExamQuestion::where('id', $question_id)->delete())
        {
            echo $this->successMsg("This question has been removed");
        }

        // get exam question scores
        $question_score = ExamQuestion::where('section_id', $section_id)->sum('score');

        // update section score
        ExamSection::where('id', $section_id)->update([
            'score' => $question_score
        ]);

        // get exam sections scores
        $sections_score = ExamSection::where('exam_id', $exam_id)->sum('score');

        // update exam full mark
        Exam::where('id', $exam_id)->update([
            'full_mark' => $sections_score
        ]);
    }

    public function updateQuestionScore(Request $request)
    {
        $exam_id = $request->input('exam_id');
        $section_id = $request->input('section_id');
        $question_id = $request->input('question_id');
        $score = $request->input('score');

        // update score
        ExamQuestion::where('id', $question_id)->update([
            'score' => $score,
        ]);

        // get exam question scores
        $question_score = ExamQuestion::where('section_id', $section_id)->sum('score');

        // update section score
        ExamSection::where('id', $section_id)->update([
            'score' => $question_score
        ]);

        // get exam sections scores
        $sections_score = ExamSection::where('exam_id', $exam_id)->sum('score');

        // update exam full mark
        Exam::where('id', $exam_id)->update([
            'full_mark' => $sections_score
        ]);
    }
    
    public function updateAnswer(Request $request)
    {
        $answer_id = $request->input('answer_id');
        $answer = $request->input('answer');

        ExamAnswer::where('id', $answer_id)->update([
            'answer' => $answer
        ]);
    }

    public function deleteAnswer(Request $request)
    {
        $answer_id = $request->input('answer_id');
        $question_id = $request->input('question_id');
        
        $examAnswer = ExamAnswer::where('id', $answer_id)->first();

        isset($examAnswer->correctAnswer) && $examAnswer->correctAnswer->answer_id == $answer_id ? die("You can't removed checked answer") : 'no';

        if(ExamAnswer::where('id', $answer_id)->delete())
        {
            // echo $examAnswer->belongsToQuestion->answers->count();

            if($examAnswer->belongsToQuestion->answers->count() == 2)
            {
                echo '<script>
                $("#answer_"+'.$answer_id.'+"_div").remove();
                $(".question_answers_'.$question_id.'").each(function(){
                    $(this).remove();
                });
                </script>';
                die();
            }
            else
            {
                echo '<script>
                    $("#answer_"+'.$answer_id.'+"_div").remove();
                </script>';
            }
        }
    }
    
    public function updateCorrectAnswer(Request $request)
    {
        $correct_answer_id = $request->input('correct_answer_id');
        $correct_answer = $request->input('correct_answer');

        CorrectAnswer::where('id', $correct_answer_id)->update([
            'answer_id' => $correct_answer
        ]);

        echo $this->successMsg("Correct answer has been updated");
    }
}
