<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-light-dodger-blue sidebar-left" data-perfect-scrollbar>

            <!-- Sidebar Content -->

            <a href="index.html"
                class="sidebar-brand ">
                <!-- <img class="sidebar-brand-icon" src="../../public/images/illustration/student/128/white.svg" alt="Luma"> -->

                <span class="avatar avatar-xl sidebar-brand-icon h-auto">
                    <span class="avatar-title rounded bg-primary">
                        <img src="{{ asset('assets/dashboard/images/illustration/student/128/white.svg') }}" class="img-fluid" alt="logo" />
                    </span>
                </span>

                <span>{{ config('app.name') }}</span>
            </a>

            <div class="sidebar-heading">القائمة الخاصة بي</div>

            <ul class="sidebar-menu">

                <li class="sidebar-menu-item {{ isset($active) && $active == 'student.home' ? 'active' : null }}">
                    <a class="sidebar-menu-button" href="{{ route('student.home') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                        <span class="sidebar-menu-text">صفحتي الشخصية</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ isset($active) && $active == 'student.my-courses' ? 'active' : null }}">
                    <a class="sidebar-menu-button" href="{{ route('student.my-courses') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">search</span>
                        <span class="sidebar-menu-text">كورساتي</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ isset($active) && $active == 'student.my-bundles' ? 'active' : null }}">
                    <a class="sidebar-menu-button" href="{{ route('student.my-bundles') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">style</span>
                        <span class="sidebar-menu-text">باقاتي</span>
                    </a>
                </li>

                {{-- <li class="sidebar-menu-item {{ isset($active) && $active == 'student.my-sessions' ? 'active' : null }}">
                    <a class="sidebar-menu-button" href="{{ route('student.my-sessions') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">local_library</span>
                        <span class="sidebar-menu-text">جلساتي</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ isset($active) && $active == 'student.my-exams' ? 'active' : null }}">
                    <a class="sidebar-menu-button" href="{{ route('student.my-exams') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">poll</span>
                        <span class="sidebar-menu-text">امتحاناتي</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="student-quiz-result-details.html">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">live_help</span>
                        <span class="sidebar-menu-text">درجات الاختبار</span>
                    </a>
                </li> --}}
            </ul>
            <!-- // END Sidebar Content -->
        </div>
    </div>
</div>