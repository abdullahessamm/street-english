@extends('layouts.app', [
    'title' => $exam->exam_name,
    'active' => Route::currentRouteName(),
    'breadcrumb' => [
        'title' => $exam->exam_name,
        'map' => [
            'Dashboard' => 'home',
            'Exams' => 'exams',
            $exam->exam_name => 'active'
        ]
    ],
    'header_right' => [
		'btn' => [
			'text' => 'Delete this Exam',
			'id' => 'deleteExam',
            'data' => [
                'exam-id' => $exam->id
            ],
			'color' => 'danger',
			'bold' => true,
		]
    ],
    'assets' => 'pages.exams.show'
])

@section('content')
<div class="row"  >
    <div class="col-md-4">
        <!-- Exam info form update -->
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ 'Exam : '.$exam->exam_name }}</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">

                                <form id="updateExam">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="fa fa-file"></i> Exam Info</h4>

                                        <div class="form-group">
                                            <label for="exam_name">Exam Name</label>
                                            <input type="text" id="exam_name" class="form-control" placeholder="e.g. Math Exam" name="exam_name" value="{{ $exam->exam_name }}" required>
                                        </div>

                                        <h4 class="form-section"><i class="fa fa-calendar"></i> Exam Time</h4>

                                        @if($exam->take_exam_anytime == 1)
                                        <div class="form-group">
                                            <label for="exam_hours">Exam Hours</label>
                                            <input type="time" id="exam_hours" class="form-control" name="exam_hours" value="{{ $exam->exam_hours }}" required>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <label for="exam_timezone">Exam Timezone</label>
                                            @php
                                                $timezones = timezone_identifiers_list();
                                            @endphp
                                            <select name="exam_timezone" id="exam_timezone" class="select2 form-control">
                                            @foreach($timezones as $timezone)
                                                <option value="{{ $timezone }}" {{ $exam->exam_timezone == $timezone ? 'selected' : '' }}>{{ $timezone }}</option>
                                            @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exam_date">Date</label>
                                            <input type="date" id="exam_date" class="form-control" name="exam_date" value="{{ $exam->exam_date }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="start_at">Start at</label>
                                            <input type="time" id="start_at" class="form-control" name="start_at" value="{{ $exam->start_at }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="end_at">End at</label>
                                            <input type="time" id="end_at" class="form-control" name="end_at" value="{{ $exam->end_at }}" required>
                                        </div>
                                        @endif

                                        <div class="form-group">
                                            <label for="for_anyone">Anyone can take exams</label>
                                            
                                            <div class="float-right">
                                                <input type="checkbox" id="for_anyone" class="switchery" data-color="success" data-exam-id="{{ $exam->id }}" {{ $exam->for_anyone == 1 ? 'checked' : ''}} />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="publish">Publish Exam</label>
                                            
                                            <div class="float-right">
                                                <input type="checkbox" id="publish" class="switchery" data-color="success" data-exam-id="{{ $exam->id }}" {{ $exam->publish == 1 ? 'checked' : ''}} />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="publish">Exam full mark</label>
                                            
                                            <div class="float-right">
                                                <span class="font-weight-bold" id="full_mark">
                                                    {{ $exam->full_mark == null ? '0/0' : $exam->full_mark.'/'.$exam->full_mark }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fa fa-check"></i> Update
                                        </button>
                                        <a href="{{ route('exam.preview', [$exam->slug]) }}" target="_blank" class="btn btn-primary">
                                            <i class="fa fa-eye"></i> Preview
                                        </a>
                                        <a href="{{ config('app.main_url').'/preview/exam/'.$exam->slug }}" target="_blank" class="btn btn-success">
                                            <i class="fa fa-globe"></i> Preview Public Exam
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ Exam info form update -->
    </div>

    <div class="col-md-8">
        @if($exam->sections->count() > 0)
        <!-- Create Exam Section, Question & Answers -->
        @foreach($exam->sections as $section)
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <span class="text-info">Section</span>
                                :
                                <span contenteditable="true" id="section-name-{{ $section->id }}">{{ ucwords($section->section_name) }}</span>
                            </h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li>
                                        <button type="button" class=" btn btn-warning btn-sm updateSection" data-section-id="{{ $section->id }}">Update this section</button>
                                    </li>
                                    <li>
                                        <button type="button" class=" btn btn-danger btn-sm deleteSection" data-section-id="{{ $section->id }}">Delete this section</button>
                                    </li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="form-body" id="section-{{ $section->id }}">
                                    <div id="questions_{{ $section->id }}">
                                        @foreach($section->questions as $eachQuestion)
                                        <div class="form-group mb-2 border-bottom" id="question_{{ $eachQuestion->id }}">
                                            <h5 class="text-primary font-weight-bold">
                                                Score : <span class="updateScore" data-exam-id="{{ $exam->id }}" data-section-id="{{ $section->id }}" data-question-id="{{ $eachQuestion->id }}" contenteditable="true">{{ $eachQuestion->score }}</span>
                                                <div class="float-right">
                                                    <button class="btn btn-danger btn-sm deleteQuestion" data-exam-id="{{ $exam->id }}" data-section-id="{{ $section->id }}" data-question-id="{{ $eachQuestion->id }}">Delete this question</button>
                                                </div>
                                            </h5>
                                            <h3>
                                                Question : <span class="updateQuestion" data-question-id="{{ $eachQuestion->id }}" contenteditable="true">{{ $eachQuestion->question }}</span>
                                            </h3>

                                            @foreach ($eachQuestion->answers as $eachAnswer)
                                            <div class="form-check the-answer" id="answer_{{ $eachAnswer->id }}_div">
                                                <input class="form-check-input updateCorrectAnswer" data-correct-answer-id="{{ $eachQuestion->correctAnswer->id }}" type="radio" name="section_{{ $section->id }}_question_{{ $eachQuestion->id }}" value="{{ $eachAnswer->id }}" {{ isset($eachAnswer->correctAnswer) && $eachAnswer->id == $eachAnswer->correctAnswer->answer_id ? 'checked' : ''}}>
                                                <label class="form-check-label updateAnswer" id="answer_{{ $eachAnswer->id }}" data-answer-id="{{ $eachAnswer->id }}" contenteditable="true">
                                                    {{ $eachAnswer->answer }}
                                                </label>

                                                @if($eachQuestion->answers->count() > 2)
                                                <button class="btn btn-danger deleteAnswer btn-sm question_answers_{{ $eachQuestion->id }}" data-answer-id="{{ $eachAnswer->id }}" data-question-id="{{ $eachQuestion->id }}">Delete this answer</button>
                                                @endif

                                                <small id="answer_{{ $eachAnswer->id }}_hint" class="text-danger font-weight-bold"></small>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach

                                    @if($section->questions->count() == 0)
                                        <p id="hint_before_questions">
                                            Your Questions & Answers for the <b class="text-info">{{ ucwords($section->section_name) }}</b> section goes here
                                        </p>                                            
                                    @endif
                                    </div>

                                    <div class="question_and_answers_div"></div>

                                    <hr>

                                    <form class="createQuestionAndAnswers mt-3" id="questionAndAnswersForm">
                                        {{ csrf_field() }}
                                        <input type="hidden" id="exam_id" value="{{ $exam->id }}">
                                        <input type="hidden" class="section_id" value="{{ $section->id }}">
                                        <div class="form-group">
                                            <label for="question">
                                                <span class="text-primary">Score</span> :<input type="number" min="0" class="score" placeholder="Question Score e.g. 7" required>
                                                <br>
                                                <span class="text-warning">Question</span> :
                                            </label>
                                            <textarea class="form-control question" cols="30" rows="3" required></textarea>

                                            <div class="mt-1" id="answers">
                                                <div class="form-check mb-2">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input chooseAnswer" type="radio" name="answers" required>
                                                        <span class="text-success">Write your answer : </span> 
                                                        <br>
                                                        <span class="answer_{{ $section->id }}" contenteditable="true">Answer 1</span>
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input chooseAnswer" type="radio" name="answers" required>
                                                        <span class="text-success">Write your answer : </span> 
                                                        <br>
                                                        <span class="answer_{{ $section->id }}" contenteditable="true">Answer 2</span>
                                                    </label>
                                                </div>

                                                <div class="input_wrap_{{ $section->id }}"></div>

                                                <button type="button" class="mt-2 add_field_button btn btn-info btn-sm" data-section-id="{{ $section->id }}">Add More Answers</button>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-warning"> Create question and it's answers </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endforeach
        <!--/ Create Exam Section, Question & Answers -->
        @endif

        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="text-center">
                                    <button type="button" class="btn btn-primary" id="createSectionBtn">
                                        Create new Section
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Create Section Form Modal -->
<div class="modal fade" id="createSectionModal" tabindex="-1" role="dialog" aria-labelledby="createSectionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form id="createNewSection">
                    {{ csrf_field() }}
                    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                    <div class="form-group">
                        <label for="section_name">Section Name</label>
                        <input type="text" class="form-control" name="section_name" id="section_name" required>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Loading Modal -->
<div class="modal" id="loading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body">
                <div class="progress text-right">
                    <div id="progressbar" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Result Modal -->
<div class="modal" id="resModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
                <div id="res"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> Close Window </button>
            </div>
        </div>
    </div>
</div>
@endsection