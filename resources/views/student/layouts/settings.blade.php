<div class="image-column col-lg-3 col-md-12 col-sm-12">
    <div class="inner-column">
        <div class="image">
        @if(Auth::user()->image != null)
            <img src="{{ asset('public/images/students/'.Auth::user()->id.'/'.Auth::user()->image) }}" alt="" />
        @else
            <img src="https://via.placeholder.com/278x319" alt="" />
        @endif
        </div>
        <h4>{{ Auth::user()->name }}</h4>
        <div class="text">Joined at {{ date("Y-m-d", strtotime(Auth::user()->created_at)) }}</div>
       
        <ul class="student-editing text-left p-2">
            <li><a href="{{ route('student.home') }}">My Dashboard</a></li>
            <li><a href="{{ route('student.my-courses') }}">My Courses</a></li>
            <li><a href="{{ route('student.my-bundles') }}">My Bundles</a></li>
            <li><a href="{{ route('student.settings') }}">Edit Account</a></li>
        </ul>
    </div>
</div>