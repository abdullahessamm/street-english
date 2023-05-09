@extends('layouts.app', [
    'title' => 'Update Event : '.$event->title,
	'active' => 'event.create',
    'breadcrumb' => [
        'title' => 'Update Event : '.$event->title,
        'map' => [
            'Dashboard' => 'home',
            'Events' => 'events',
            'Update Event : '.$event->title => 'active'
        ]
    ],
    'scripts' => 'pages.events.show'
])

@section('content')
<!-- Create coach section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">Create event details</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <form id="updateEvent" class="form form-horizontal striped-labels form-bordered">
                            {{ csrf_field() }}
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="fa fa-bullhorn"></i> Event Details</h4>

			                    <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="event_title">Event Title</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="event_title" class="form-control" name="event_title" value="{{$event->title}}" required>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="event_description">Event Description</label>
		                            <div class="col-md-9">
                                        <textarea name="event_description" id="event_description" required>{{$event->description}}</textarea>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="image">Event Image</label>
		                            <div class="col-md-9">
		                            	<input type="file" id="image" class="form-control" name="image">

                                        <div class="my-2">
                                            <img src="{{ config('app.main_url').'/images/events/'.$event->id.'/'.$event->image }}" class="img-fluid" alt="">
                                        </div>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="end_date">Event End Date</label>
		                            <div class="col-md-9">
		                            	<input type="date" id="end_date" class="form-control" name="end_date" value="{{$event->end_date}}" required>
		                            </div>
		                        </div>
							</div>

	                        <div class="form-actions">
	                            <button type="reset" class="btn btn-danger mr-1" id="delete-event" data-event-id="{{ $event->id }}">
	                            	<i class="fa fa-trash"></i> Delete
	                            </button>
	                            <button type="submit" class="btn btn-info">
	                                <i class="fa fa-check"></i> Update
	                            </button>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>
<!-- // Create coach section end -->

<!-- List of all Events table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of all users in this event</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered" id="event-users">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>User Email</th>
                                    <th>User Whatsapp No.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($event->users as $user)
                                <tr>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->whatsapp_number }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Username</th>
                                    <th>User Email</th>
                                    <th>User Whatsapp No.</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ List of all Events table -->

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

<!-- Error Modal -->
<div class="modal" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
                <i class="fa fa-times text-danger" style="font-size: 100px;"></i>
                <h3>Error Occured</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> Close Window </button>
            </div>
        </div>
    </div>
</div>
@endsection