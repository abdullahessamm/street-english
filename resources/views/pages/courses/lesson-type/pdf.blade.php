<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">تفاصيل الملف الخاص بالدرس</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
					@if($lesson->doc != null)
						<form id="updateDocCourse" class="form form-horizontal striped-labels form-bordered" enctype="multipart/form-data">
							{{ csrf_field() }}
							<input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
							<input type="hidden" name="lesson_doc_id" value="{{ $lesson->doc->id }}">
							<div class="form-body">

								<div class="form-group row">
									<label class="col-md-3 label-control" for="doc">
										عرض الملف 
									</label>
									<div class="col-md-9">
										@if($lesson->doc->isDownloadable == 1)
										<iframe src="{{ config('app.main_url').'/uploads/courses/'.$lesson->belongsToContent->belongsToCourse->id.'/contents/'.$lesson->belongsToContent->id.'/lessons/'.$lesson->id.'/'.$lesson->doc->pdf }}" width="100%" height="500px"></iframe>
										@else
										<iframe src="{{ config('app.main_url').'/uploads/courses/'.$lesson->belongsToContent->belongsToCourse->id.'/contents/'.$lesson->belongsToContent->id.'/lessons/'.$lesson->id.'/'.$lesson->doc->pdf.'#toolbar=0' }}" width="100%" height="500px"></iframe>
										@endif
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="doc">
										الملف بخاصية ال 
										<br>
										<b>PDF</b>
									</label>
									<div class="col-md-7">
										<input type="file" id="doc" class="form-control" name="doc" required>
									</div>
									<div class="col-md-2">
										<button type="submit" class="btn btn-info">
											<i class="fa fa-upload"></i> تحديث ملف بال pdf
										</button>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="isDocDownloadable">مسموح بالتنزيل</label>
									<div class="col-md-9">
										<input type="checkbox" id="isDocDownloadable" class="switchery isDocDownloadable" data-lesson-doc-id="{{ $lesson->doc->id }}" {{ $lesson->doc->isDownloadable == 1 ? 'checked' : '' }}/>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="pages">
										عدد الصفحات
									</label>
									<div class="col-md-7">
										<input type="number" id="pages" class="form-control" name="pages" pattern="[0-9]+" value="{{ $lesson->doc->pages }}" required>
									</div>
									<div class="col-md-2">
										<button type="button" id="updateDocPages" data-lesson-doc-id="{{ $lesson->doc->id }}" class="btn btn-info">
											تحديث عدد الصفحات
										</button>
									</div>
								</div>
							</div>
						</form>
					@else
						<form id="createDocCourse" class="form form-horizontal striped-labels form-bordered" enctype="multipart/form-data">
							{{ csrf_field() }}
							<input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
							<div class="form-body">
								<div class="form-group row">
									<label class="col-md-3 label-control" for="doc">
										الملف بخاصية ال 
										<br>
										<b>PDF</b>
									</label>
									<div class="col-md-9">
										<input type="file" id="doc" class="form-control" name="doc" {!! $lesson->doc != null ? 'required' : null !!}>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="pages">
										عدد الصفحات
									</label>
									<div class="col-md-9">
										<input type="number" id="pages" class="form-control" name="pages" pattern="[0-9]+" required>
									</div>
								</div>

								<div class="form-actions">
									<button type="submit" class="btn btn-success">
										<i class="fa fa-upload"></i> رفع الملف
									</button>
								</div>
							</div>
						</form>
					@endif
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>