@extends('layouts.app', [
    'title' => 'Placement Test',
    'scripts' => 'pages.placement-test.index',
])

@section('content')
<!-- Contact Page Section -->
<section class="contact-page-section mb-3 pb-0">
    <div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-1.png)"></div>
    <div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-2.png)"></div>
    <div class="auto-container mt-5">
        
        <div class='container-fluid mx-auto mt-5 mb-5 col-12 text-center'>
        @if($exam->publish == 1)
            <h3 style="color: #18a674;">What is Placement Test</h3>
            {{-- <p class="mb-5" style="font-weight: bold;color: #1E284B;font-size: 15px;">Established in 2017, Street English Academy is a leading educational institution that provides English-language courses with reasonable prices and high-quality services. We aspire to be a leader in developing all English-language learners regardless of their level based on CEFR descriptors to meet the labor market requirements, get the score needed for immigration purposes, generate high-impact education and pursue enlightenment and creativity. </p> --}}
            
            <div class="row justify-content-center my-5">
                <div class="col-8 text-left">
                    <h5 style="color: #18a674;">Please fill in the form below</h5>
                    <form id="joinPlacementTest">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="username" class="font-weight-bold" style="color: #1E284B;">Username</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>

                        <div class="form-group">
                            <label for="email" class="font-weight-bold" style="color: #1E284B;">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>

                        <div class="form-group">
                            <label for="whatsapp_number" class="font-weight-bold" style="color: #1E284B;">Phone / Whatsapp Number (OPTIONAL)</label>
                            <input type="telephone" class="form-control" name="whatsapp_number" id="whatsapp_number">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Take Placement Test</button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="row justify-content-center my-5">
                <div class="jumbotron text-center col-8">
                    <h1>There's no Placement Test</h1>
                </div>
            </div>
        @endif
        </div>
    </div>
</section>
<!-- End Contact Page Section -->

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
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body">
                <p class="p-3">
                    {!! errorMsg('Error Occured') !!}
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>
@endsection