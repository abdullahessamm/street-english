<div class="image-column col-lg-3 col-md-12 col-sm-12">
    <div class="inner-column">
        @php
            $user = App\LiveCourseUser::where('id', Auth::guard('live_course_user')->user()->id)->first();
        @endphp
        <div class="image">
        @if(isset($user->info) && $user->info->image != null)
            <img src="{{ asset('public/images/live-course-users/'.$user->id.'/'.$user->info->image) }}" alt="" />
        @else
            <img src="https://via.placeholder.com/278x319" alt="" />
        @endif
        </div>
        <h4>{{ $user->name }}</h4>
        <div class="text">Joined {{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</div>
       
        <ul class="student-editing">
            <li ><a href="{{ route('student.home') }}">My Dashboard</a></li>
            <li><a href="{{ route('student.settings') }}">Edit Account</a></li>
        </ul>
    </div>
</div>