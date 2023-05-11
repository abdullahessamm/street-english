@extends('layouts.app',[
    'title' => 'Placement Test Results',
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
                            <h2>Placement Test Results for {{ $placementTestUser->name }}</h2>
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-12">
                                <div class="jumbotron text-center">
                                    <h3>Your Score is</h3>
                                    <h1>{{ $test_score.' / '.$whole_score }}</h1>
                                </div>
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