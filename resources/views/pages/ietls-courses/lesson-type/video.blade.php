<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">تفاصيل الفيديو</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
					@if($lesson->video != null)
					<form id="updateVideoCourse" class="form form-horizontal striped-labels form-bordered" enctype="multipart/form-data">
						{{ csrf_field() }}
						<input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
						<input type="hidden" name="lesson_video_id" value="{{ $lesson->video->id }}">
						<div class="form-body">
							<div class="form-group row">
								<label class="col-md-3 label-control" for="video">الفيديو الخاص بالدرس</label>
								<div class="col-md-9">
								@switch($lesson->video->type)
									@case('youtube')
									<div class="embed-responsive embed-responsive-16by9">
										<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$lesson->video->url}}" allowfullscreen></iframe>
									</div>
									@break

									@case('vimeo')
									<div class="embed-responsive embed-responsive-16by9">
										<iframe src="https://player.vimeo.com/video/{{$lesson->video->url}}" allowfullscreen></iframe>
									</div>
									@break

									@case('drive')
									{!! $lesson->video->url !!}
									@break
								@endswitch
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-3 label-control" for="video_url">رابط الفيديو</label>
								<div class="col-md-9">
									<textarea name="video_url" id="video_url" class="form-control" cols="30" rows="3" dir="ltr" required></textarea>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-3 label-control" for="video_type">نوع الفيديو</label>
								<div class="col-md-9">
									<select name="video_type" id="video_type" class="form-control">
										<option value="youtube" {{ $lesson->video->type == 'youtube' ? 'selected' : null }}>Youtube</option>
										<option value="vimeo" {{ $lesson->video->type == 'vimeo' ? 'selected' : null }}>Vimeo</option>
										<option value="drive" {{ $lesson->video->type == 'drive' ? 'selected' : null }}>Google Drive</option>
									</select>
								</div>
							</div>

							<div class="form-actions">
								<button type="submit" class="btn btn-success">
									<i class="fa fa-upload"></i> تحديث الفيدو
								</button>
							</div>
						</div>
					</form>					
					@else
					<form id="createVideoCourse" class="form form-horizontal striped-labels form-bordered" enctype="multipart/form-data">
						{{ csrf_field() }}
						<input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
						<div class="form-body">
							<div class="form-group row">
								<label class="col-md-3 label-control" for="video_url">رابط الفيديو</label>
								<div class="col-md-9">
									<textarea name="video_url" id="video_url" class="form-control" cols="30" rows="3" dir="ltr"></textarea>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-3 label-control" for="video_type">نوع الفيديو</label>
								<div class="col-md-9">
									<select name="video_type" id="video_type" class="form-control">
										<option value="youtube" selected>Youtube</option>
										<option value="vimeo">Vimeo</option>
										<option value="drive">Google Drive</option>
									</select>
								</div>
							</div>
						</div>

						<div class="form-actions">
							<button type="submit" class="btn btn-success">
								<i class="fa fa-upload"></i> رفع الفيدو
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

{{-- <script>
//register canplaythrough event to #audio element to can get duration
var f_duration =0;  //store duration
document.getElementById('audio').addEventListener('canplaythrough', function(e){
  //add duration in the input field #f_du
  f_duration = Math.round(e.currentTarget.duration);
  duration = e.currentTarget.duration;
  
//   document.getElementsByClassName('duration').value = Math.round(duration / 60);
  $(".duration").val(Math.round(duration / 60))
  URL.revokeObjectURL(obUrl);
});

//when select a file, create an ObjectURL with the file and add it in the #audio element
var obUrl;
document.getElementById('video').addEventListener('change', function(e){
  var file = e.currentTarget.files[0];
  //check file extension for audio/video type
  if(file.name.match(/\.(avi|mp3|mp4|mpeg|ogg)$/i)){
    obUrl = URL.createObjectURL(file);
    document.getElementById('audio').setAttribute('src', obUrl);
  }
});

var control = document.getElementById("video");
control.addEventListener("change", function(event) {
    // When the control has changed, there are new files
    var files = control.files;
	
	$(".type").val(files[0]['type']);
	$(".size").val(files[0]['size']);
}, false);
</script> --}}