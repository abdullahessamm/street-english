@extends('layouts.app',[
    'title' => 'Placement Test',
    'assets' => 'pages.placement-test.show',
])

@section('content')
<!-- Student Profile Section -->
<section class="student-profile-section">
    <div class="auto-container">
        <div class="row clearfix mt-5">
            
            
            <!-- Content Section -->
            <div class="content-column col-lg-12">
                <div class="inner-column">
                    <div class="content">
                        <!-- Sec Title -->
                        <div class="sec-title">
                            <h2>Placement Test</h2>
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-12">
                            @if($placementTest->publish == 1)
                                <form action="#" class="steps-validation wizard-circle" id="createNewExamForm">
                                    {{ csrf_field() }}
                                    <!-- Step 1 -->
                                    @php
                                        $x = 0;
                                    @endphp
                                    @foreach($placementTest->sections as $section)
                                        @foreach ($section->questions as $eachQuestion)
                                        <h4></h4>
                                        <fieldset>
                                            <h3 class="my-1 font-weight-bold" style="color: #1E284B;">{{ $section->section_name }}</h3>
                                            <div class="row p-1">
                                                <div class="col-12">
                                                    <h4 class="questions" data-question-id="{{ $eachQuestion->id }}">
                                                        <span class="font-weight-bold" style="color: #18a674;">Question {{ ++$x }} :</span> <span style="color: #1E284B;">{{ $eachQuestion->question }}</span>
                                                    </h4>
                                                </div>
                                                <div class="col-12 px-3">
                                                    @foreach($eachQuestion->answers as $answer)
                                                    <div class="form-check my-1">
                                                        <input class="form-check-input questions-and-answers question_{{$eachQuestion->id }}" type="radio" name="{{ $eachQuestion->id }}" id="{{ $answer->id }}" value="{{ $answer->id }}" data-question-id="{{ $eachQuestion->id }}">
                                                        <label class="form-check-label font-weight-bold" for="{{ $answer->id }}" style="color: #18a674;">
                                                            {{ $answer->answer }}
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </fieldset>
                                        @endforeach
                                    @endforeach

                                </form>
                                <div id="hint"></div>
                            
                            @else
                                <div class="jumbotron text-center">
                                    <h3>There is no Placement Test</h3>
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!-- End Profile Section -->

<div class="modal" tabindex="-1" role="dialog" id="answerAtLeastOneQuestionModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <i class="fa fa-times text-danger" style="font-size: 100px;"></i>
                <h3>You must at least answer 1 question</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection