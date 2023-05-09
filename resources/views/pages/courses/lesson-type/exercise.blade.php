<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">اختر اسئلة تدريبة من الامتحانات</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
					@if($lesson->exercise != null)
					<form id="updateCourseExercise" class="form form-horizontal striped-labels form-bordered" enctype="multipart/form-data">
						{{ csrf_field() }}
						<input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
						<input type="hidden" name="lesson_exercise_id" value="{{ $lesson->exercise->id }}">
						<div class="form-body">
							<div class="form-group row">
								<label class="col-md-3 label-control" for="selected_exam">الامتحان الخاص بالاسئلة التدريبية</label>
								<div class="col-md-9">
                                    <input type="text" class="form-control" id="selected_exam" value="{{ $lesson->exercise->belongsToExam->exam_name }}" disabled>
								</div>
							</div>

                            <div class="form-group row">
								<label class="col-md-3 label-control" for="selected_exam">لتغيير الاسئلة التدريبية</label>
								<div class="col-md-9">
                                @php
                                $exams = \App\Models\Exams\Exam::get();
                                @endphp
                                <select class="select2 form-control" name="exam_id">
                                    @foreach($exams as $exam)
                                    <option value="{{ $exam->id }}" {{ $lesson->exercise->exam_id == $exam->id ? 'selected' : null }}>{{ $exam->exam_name }}</option>
                                    @endforeach
                                </select>
								</div>
							</div>

							<div class="form-actions">
								<button type="submit" class="btn btn-success">
									<i class="fa fa-upload"></i> تحديث الاسئلة التدريبية
								</button>
							</div>
						</div>
					</form>					
					@else
					<form id="createCourseExercise" class="form form-horizontal striped-labels form-bordered" enctype="multipart/form-data">
						{{ csrf_field() }}
						<input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
						<div class="form-body">
							<div class="form-group row">
								<label class="col-md-3 label-control" for="video_url">اختر امتحان</label>
								<div class="col-md-9">
                                @php
                                $exams = \App\Models\Exams\Exam::get();
                                @endphp
                                @if($exams->count() > 0)
                                    <select class="select2 form-control" name="exam_id">
                                        @foreach($exams as $exam)
                                        <option value="{{ $exam->id }}">{{ $exam->exam_name }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <div class="jumbotron text-center">
                                        <h3>ليس لديك اي امتحانات</h3>
                                        <a href="{{ route('exam.create') }}" class="btn btn-info mt-1" target="_blank">انشاء امتحان جديد</a>
                                    </div>
                                @endif
								</div>
							</div>
						</div>

						<div class="form-actions">
							<button type="submit" class="btn btn-success">
								<i class="fa fa-upload"></i> انشاء الاسئلة التدريبية
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