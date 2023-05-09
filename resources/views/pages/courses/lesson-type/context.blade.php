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
					@if($lesson->context != null)
						<form id="updateCourseContext" class="form form-horizontal striped-labels form-bordered">
							{{ csrf_field() }}
							<input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
							<input type="hidden" name="lesson_context_id" value="{{ $lesson->context->id }}">

							<div class="form-body">
								<div class="form-group row">
									<label class="col-md-2 label-control" for="doc">
										المحتوي الكتابي للدرس
									</label>
									<div class="col-md-10">
                                        <textarea name="lesson_description" id="lesson_description" required>{!! $lesson->context->content !!}</textarea>
									</div>
								</div>
							</div>

							<div class="form-actions">
								<button type="submit" class="btn btn-info">
									<i class="fa fa-refresh"></i> تحديث المحتوي الكتابي
								</button>
							</div>
						</form>
					@else
						<form id="createCourseContext" class="form form-horizontal striped-labels form-bordered">
							{{ csrf_field() }}
							<input type="hidden" name="lesson_id" value="{{ $lesson->id }}">

							<div class="form-body">
								<div class="form-group row">
									<label class="col-md-2 label-control" for="doc">
										المحتوي الكتابي للدرس
									</label>
									<div class="col-md-10">
                                        <textarea name="lesson_description" id="lesson_description" required></textarea>
									</div>
								</div>
							</div>

							<div class="form-actions">
								<button type="submit" class="btn btn-success">
									<i class="fa fa-upload"></i> انشاء المحتوي الكتابي
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