@extends('layouts.app',[
    'active' => 'home',
    'breadcrumb' => [
        'title' => 'My Dashboard',
    ],
])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Your token is: {{ request()->cookie('token') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
