<div class="image-column col-lg-3 col-md-12 col-sm-12">
    <div class="inner-column">
        <div class="image">
        @php
            $user = App\Models\IETLSCourses\IeltsUser::where('id', Auth::guard('ielts_user')->user()->id)->first();
        @endphp
        @if($user->image != null)
            <img src="{{ asset('public/images/ielts-user/'.$user->id.'/'.$user->image) }}" alt="" />
        @else
            <img src="https://via.placeholder.com/278x319" alt="" />
        @endif
        </div>
        <h4>{{ $user->name }}</h4>
        <div class="text">Joined {{ Carbon\Carbon::parse(Auth::guard('ielts_user')->user()->created_at)->diffForHumans() }}</div>
       
        <ul class="student-editing">
            <li ><a href="{{ route('ielts-user.home') }}">My Dashboard</a></li>
            <li><a href="{{ route('ielts-user.settings') }}">Edit Account</a></li>
        </ul>
    </div>
</div>