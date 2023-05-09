@extends('layouts.app', [
    'title' => 'الشهادات المفتوحة للمسنخدم : '.$publicCertificateLink->certificate_username,
	'active' => 'public-certificates',
    'breadcrumb' => [
        'title' => 'الشهادات المفتوحة للمسنخدم : '.$publicCertificateLink->certificate_username,
        'map' => [
            'Dashboard' => 'home',
            'الشهادات المفتوحة للمسنخدم : '.$publicCertificateLink->certificate_username => 'active'
        ]
    ],
    'scripts' => 'pages.certificates.public-certificates.show'
])

@section('content')
<!-- Create coach section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">Create public certificate</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <form id="appendPublicCertificate" class="form form-horizontal striped-labels form-bordered">
                            {{ csrf_field() }}
							<input type="hidden" name="public_certificate_link_id" value="{{ $publicCertificateLink->id }}">
	                    	<div class="form-body">
			                    <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="certificate_username">Username</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="certificate_username" class="form-control" placeholder="e.g. John Doe" name="certificate_username" value="{{ $publicCertificateLink->certificate_username }}" disabled>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="certificate_user_email">Email</label>
		                            <div class="col-md-9">
		                            	<input type="email" id="certificate_user_email" class="form-control" placeholder="johndoe@email.com" name="certificate_user_email" value="{{ $publicCertificateLink->certificate_user_email }}" disabled>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="email">اضافة المزيد من الشهادات</label>
		                            <div class="col-md-9">
										<div class="repeater-default">
											<div data-repeater-list="certificates">
												<div data-repeater-item>
													<div class="form-group row">
														<div class="col-10">
															<label for="certificate_name">اسم الدورة</label>
															<input type="text" class="form-control" name="certificate_name" id="certificate_name" required>
														</div>
														
														<div class="col-2">
															<button type="button" class="btn btn-danger mt-2" data-repeater-delete> <i class="ft-x"></i> Delete</button>
														</div>
													</div>
												</div>
											</div>
		
											<div class="form-group overflow-hidden">
												<div class="col-12">
													<button type="button" data-repeater-create class="btn btn-primary">
														<i class="ft-plus"></i> اضافة شهادة
													</button>
												</div>
											</div>
										</div>
		                            </div>
		                        </div>
							</div>

	                        <div class="form-actions">
	                            <button type="submit" class="btn btn-primary mr-1">
	                            	<i class="fa fa-check"></i> Append
	                            </button>
	                            <button type="button" class="btn btn-danger" id="delete-all-certificate" data-public-certificate-link-id="{{ $publicCertificateLink->id }}">
	                                <i class="fa fa-trash"></i> Delete all
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

<!-- Create coach section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">{{ $publicCertificateLink->certificate_username }} public certificates</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
						<table class="table table-striped- table-bordered" id="public-certificates">
							<thead>
								<tr>
									<th>اسم الشهادة</th>
									<th>رقم الشهادة</th>
									<th>رابط الشهادة</th>
									<th>مسح الشهادة</th>
								</tr>
							</thead>
							<tbody>
								@foreach($publicCertificateLink->publicCertificates as $publicCertificate)
								<tr id="tr_public_certificate_{{$publicCertificate->id}}">
									<td>{{ $publicCertificate->certificate_name }}</td>
									<td>{{ $publicCertificate->serial }}</td>
									<td>
										<a href="{{ config('app.main_url') }}/search/certificate/{{ $publicCertificate->slug }}" target="_blank">اضغط هنا لرابط شهادة ال {{ $publicCertificate->certificate_name }}</a>
									</td>
									<td>
										<button class="btn btn-sm btn-danger delete-public-certificate" data-public-certificate-id="{{ $publicCertificate->id }}">مسح الشهادة</button>
									</td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th>اسم الشهادة</th>
									<th>مسح الشهادة</th>
								</tr>
							</tfoot>
						</table>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>
<!-- // Create coach section end -->

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

<div class="modal" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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