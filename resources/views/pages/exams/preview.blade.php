@extends('layouts.app', [
    'title' => $exam->exam_name,
    'active' => Route::currentRouteName(),
    'breadcrumb' => [
        'title' => $exam->exam_name,
        'map' => [
            'Dashboard' => 'home',
            'Exams' => 'exams',
            $exam->exam_name => [
                'route' => 'exam.show',
                'slug' => $exam->slug
            ],
            'Preview' => 'active'
        ]
    ],
    'assets' => 'pages.exams.preview'
])

@section('content')
<!-- Form wizard with step validation section start -->
<section id="validation">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Preview {{$exam->name}} Exam</h4>
                    <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>

                
                <div class="card-conent collapse show">
                    <div class="card-body">
                        <form action="#" class="steps-validation wizard-circle" id="createNewExamForm">
                            {{ csrf_field() }}
                            <!-- Step 1 -->
                            @php
                                $x = 0;
                            @endphp
                            @foreach($exam->sections as $section)
                                @foreach ($section->questions as $eachQuestion)
                                <h4></h4>
                                <fieldset>
                                    <h3 class="my-1">{{ $section->section_name }}</h3>
                                    <div class="row p-1">
                                        <div class="col-12">
                                            <h4>
                                                Question {{ ++$x }} : {{ $eachQuestion->question }}
                                            </h4>
                                        </div>
                                        <div class="col-12 px-3">
                                            @foreach($eachQuestion->answers as $answer)
                                            <div class="form-check my-1">
                                                <input class="form-check-input" type="radio" name="{{ $eachQuestion->id }}" id="{{ $answer->id }}" {{ $eachQuestion->correctAnswer->answer_id == $answer->id ? 'checked' : '' }}>
                                                <label class="form-check-label" for="{{ $answer->id }}">
                                                    {{ $answer->answer }} {!! $eachQuestion->correctAnswer->answer_id == $answer->id ? ' - <span class="fa fa-check text-success"></span>' : '' !!}
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
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- Form wizard with step validation section end -->
@endsection