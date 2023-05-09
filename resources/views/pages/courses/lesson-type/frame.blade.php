<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">تفاصيل الدرس الكتابي</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
					@if($lesson->frame != null)
						<form id="updateCourseFrame" class="form form-horizontal striped-labels form-bordered">
							{{ csrf_field() }}
							<input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
							<input type="hidden" name="lesson_frame_id" value="{{ $lesson->frame->id }}">

							<div class="form-body">
								<div class="form-group row">
									<label class="col-md-2 label-control" for="url">
										الاطار
									</label>
									<div class="col-md-10">
										<div class="embed-responsive embed-responsive-16by9">
											<iframe class="embed-responsive-item" name="iframe_a" title="Iframe Example"></iframe>
										</div>
										<br>
										<div class="text-center my-2">
											<a class="btn btn-primary" href="{{ $lesson->frame->url }}" target="iframe_a">اضغط هنا لعرض الرابط داخل الاطار</a>
										</div>
									</div>
								</div>
							</div>

							<div class="form-body">
								<div class="form-group row">
									<label class="col-md-2 label-control" for="url">
										الرابط التوجيهي داخل الاطار
									</label>
									<div class="col-md-10">
										<input type="url" class="form-control" name="url" id="url" value="{{ $lesson->frame->url }}" required>
									</div>
								</div>
							</div>

							<div class="form-actions">
								<button type="submit" class="btn btn-info">
									<i class="fa fa-refresh"></i> تحديث الاطار
								</button>
							</div>
						</form>
					@else
						<form id="createCourseFrame" class="form form-horizontal striped-labels form-bordered">
							{{ csrf_field() }}
							<input type="hidden" name="lesson_id" value="{{ $lesson->id }}">

							<div class="form-body">
								<div class="form-group row">
									<label class="col-md-2 label-control" for="url">
										الرابط التوجيهي داخل الاطار
									</label>
									<div class="col-md-10">
										<input type="url" class="form-control" name="url" id="url" required>
									</div>
								</div>
							</div>

							<div class="form-actions">
								<button type="submit" class="btn btn-success">
									<i class="fa fa-upload"></i> انشاء الاطار
								</button>
							</div>
						</form>
					@endif
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>