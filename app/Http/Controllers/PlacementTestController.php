<?php

namespace App\Http\Controllers;

use App\Models\Exams\Exam;
use App\Models\Exams\ExamQuestion;
use App\Models\PlacmentTest\PlacementTest;
use App\Models\PlacmentTest\PlacementTestUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PlacementTestController extends Controller
{
    public function index()
    {
        $exam = Exam::where('slug', '3714bed4be41e542e8702523ac2eddf8')->first();

        return view('pages.placement-test.index')->with('exam', $exam);
    }

    public function show($slug)
    {
        $placementTestUser = PlacementTestUser::where('slug', $slug)->first();
        
        $placementTestUser == null ? $this->redierctTo('placement-test') : true;
        
        if($placementTestUser->hasFinished == 1){

            $test_score = PlacementTest::where('placement_test_user_id', $placementTestUser->id)->sum('score');
            $whole_score = Exam::where('slug', '3714bed4be41e542e8702523ac2eddf8')->first()->questions->sum('score');

            return view('pages.placement-test.results')
            ->with('test_score', $test_score)
            ->with('whole_score', $whole_score)
            ->with('placementTestUser', $placementTestUser);
        }
        
        $placementTest = Exam::where('slug', '3714bed4be41e542e8702523ac2eddf8')->first();

        return view('pages.placement-test.show')
        ->with('placementTestUser', $placementTestUser)
        ->with('placementTest', $placementTest);
    }

    public function joinPlacementTest(Request $request)
    {
        $name = $request->input('username');
        $email = $request->input('email');
        $whatsapp_number_or_phone_number = $request->input('whatsapp_number');
        $slug = md5(uniqid());

        PlacementTestUser::create([
            'name' => $name,
            'email' => $email,
            'whatsapp_number_or_phone_number' => $whatsapp_number_or_phone_number,
            'slug' => $slug,
        ]);

        $this->successMsg('You have joined this placement test');

        $this->redierctTo('placement-test/user/'.$slug);
    }

    public function submitAnswers(Request $request)
    {
        $placement_test_user_id = $request->input('placement_test_user_id');
        $my_answers = $request->input('my_answers');

        for($i = 0; $i < count($my_answers); $i++){

            $question_id = $my_answers[$i]['question'];
            $answer_id = $my_answers[$i]['answer'];
            $correct_answer_id = ExamQuestion::where('id', $my_answers[$i]['question'])->first()->correctAnswer->id;
            $score = $my_answers[$i]['answer'] == null || $my_answers[$i]['answer'] != ExamQuestion::where('id', $my_answers[$i]['question'])->first()->correctAnswer->answer_id ? 0 : ExamQuestion::where('id', $my_answers[$i]['question'])->first()->score;
        
            PlacementTest::create([
                'placement_test_user_id' => $placement_test_user_id,
                'question_id' => $question_id,
                'answer_id' => $answer_id,
                'correct_answer_id' => $correct_answer_id,
                'score' => $score,
            ]);
        }

        $placementTestUser = PlacementTestUser::where('id', $placement_test_user_id)->first();
        
        $placementTestUser->update([
            'hasFinished' => 1,
        ]);

        $test_score = PlacementTest::where('placement_test_user_id', $placementTestUser->id)->sum('score');
        $whole_score = Exam::where('slug', '3714bed4be41e542e8702523ac2eddf8')->first()->questions->sum('score');

        $data = [
            'test_score' => $test_score,
            'whole_score' => $whole_score,
            'email' => $placementTestUser->email,
            'slug' => $placementTestUser->slug
        ];

        Mail::send('mail.placemnet-test-score', ['data' => $data], function ($message) use ($data) {
            $message->to( $data['email'] )
            ->from('info@'.config('app.domain'), 'Street English')
            ->subject( 'Your Placement Test Score' );
        });

        $this->reloadPage();
    }
}
