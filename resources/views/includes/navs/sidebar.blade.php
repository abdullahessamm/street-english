<div class="main-menu menu-static menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
		<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
			<li class=" navigation-header">
                <span data-i18n="nav.category.layouts"> لوحة التحكم </span>
                <i class="ft-more-horizontal ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li>

			{{-- Start Dashboard Pages --}}
			<li class="nav-item {{ isset($active) && $active == 'home' ? 'active' : '' }}">
				<a href="{{ route('home') }}">
					<i class="icon-home"></i>
					<span class="menu-title">
						الصفحة الرئيسية
					</span>
				</a>
			</li>
			{{-- End Dashboard Pages --}}
			

			{{-- Start Users Pages --}}
			<li class=" navigation-header">
                <span data-i18n="nav.category.layouts"> المستخدمين </span>
                <i class="ft-more-horizontal ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li>

			<li class="nav-item">
				<a href="javascript:void(0);">
					<i class="icon-graduation"></i>
					<span class="menu-title" data-i18n="nav.dash.main">المشتركين</span>
				</a>
				<ul class="menu-content">
					<li class="nav-item {{ isset($active) && $active == 'students' ? 'active' : '' }}">
						<a class="menu-item" href="{{ route('students') }}">قائمة بجميع المشتركين</a>
					</li>
					<li class="nav-item {{ isset($active) && $active == 'student.create' ? 'active' : '' }}">
						<a class="menu-item" href="{{ route('student.create') }}">انشاء مشترك جديد</a>
					</li>
				</ul>
			</li>

			<li class="nav-item">
				<a href="javascript:void(0);">
					<i class="icon-user"></i>
					<span class="menu-title" data-i18n="nav.dash.main">المدربين</span>
				</a>
				<ul class="menu-content">
					
					<li class="nav-item {{ isset($active) && $active == 'coaches' ? 'active' : '' }}">
						<a class="menu-item" href="{{ route('coaches') }}">قائمة بجميع المدربين</a>
					</li>
					<li class="nav-item {{ isset($active) && $active == 'coach.create' ? 'active' : '' }}">
						<a class="menu-item" href="{{ route('coach.create') }}">انشاء مدرب جديد</a>
					</li>
				</ul>
			</li>

			<li class="nav-item {{ isset($active) && $active == 'coaching-memberships' ? 'active' : '' }}">
				<a href="{{ route('coaching-memberships') }}">
					<i class="icon-heart"></i>
					<span class="menu-title">
						المتقدمين للتوظيف
					</span>
				</a>
			</li>
			{{-- End Users Pages --}}
			

			{{-- Start Online Courses Pages --}}
			<li class=" navigation-header">
                <span data-i18n="nav.category.layouts"> الدورات المسجلة </span>
                <i class="ft-more-horizontal ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li>
            
            <li class="nav-item {{ isset($active) && $active == 'courses-categories' ? 'active' : '' }}">
				<a href="{{ route('courses-categories') }}">
					<i class="icon-list"></i>
					<span class="menu-title">
						فئات الدورات المسجلة
					</span>
				</a>
			</li>
            
            <li class="nav-item {{ isset($active) && $active == 'courses' ? 'active' : '' }}">
				<a href="{{ route('courses') }}">
					<i class="icon-notebook"></i>
					<span class="menu-title">
						جميع الدورات المسجلة
					</span>
				</a>
			</li>
    
			
			<li class="nav-item {{ isset($active) && $active == 'course.create' ? 'active' : '' }}">
				<a href="{{ route('course.create') }}">
					<i class="icon-plus"></i>
					<span class="menu-title">
						انشا دورة مسجلة
					</span>
				</a>
			</li>

			<li class="nav-item {{ isset($active) && $active == 'instructors-for-course' ? 'active' : '' }}">
				<a href="{{ route('instructors-for-courses') }}">
					<i class="icon-earphones-alt"></i>
					<span class="menu-title">
						المحاضرين بالدورات 
					</span>
				</a>
			</li>

			<li class="nav-item {{ isset($active) && $active == 'enrolled-students-for-courses' ? 'active' : '' }}">
				<a href="{{ route('enrolled-students-for-courses') }}">
					<i class="icon-user-following"></i>
					<span class="menu-title">
						المشتركين بالدورات 
					</span>
				</a>
			</li>

			<li class="nav-item {{ isset($active) && $active == 'popular-courses' ? 'active' : '' }}">
				<a href="{{ route('popular-courses') }}">
					<i class="icon-star"></i>
					<span class="menu-title">
						الدورات الاكثر انتشارا
					</span>
				</a>
			</li>
			{{-- End Online Courses Pages --}}




			{{-- Start IETLS Courses Pages --}}
			<li class=" navigation-header">
				<span data-i18n="nav.category.layouts"> الدورات IETLS </span>
				<i class="ft-more-horizontal ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
			</li>
			
			<li class="nav-item {{ isset($active) && $active == 'ietls-courses-categories' ? 'active' : '' }}">
				<a href="{{ route('ietls-courses-categories') }}">
					<i class="icon-list"></i>
					<span class="menu-title">
						فئات دورات ال IELTS
					</span>
				</a>
			</li>
			
			<li class="nav-item {{ isset($active) && $active == 'ietls-courses' ? 'active' : '' }}">
				<a href="{{ route('ietls-courses') }}">
					<i class="icon-notebook"></i>
					<span class="menu-title">
						جميع دورات ال IELTS 
					</span>
				</a>
			</li>
			
			
			<li class="nav-item {{ isset($active) && $active == 'ietls-course.create' ? 'active' : '' }}">
				<a href="{{ route('ietls-course.create') }}">
					<i class="icon-plus"></i>
					<span class="menu-title">
						انشا دورة IELTS
					</span>
				</a>
			</li>
			
			<li class="nav-item {{ isset($active) && $active == 'instructors-for-ietls-course' ? 'active' : '' }}">
				<a href="{{ route('instructors-for-ietls-courses') }}">
					<i class="icon-earphones-alt"></i>
					<span class="menu-title">
						المحاضرين بدورات IELTS 
					</span>
				</a>
			</li>
			
			<li class="nav-item {{ isset($active) && $active == 'enrolled-students-for-ietls-courses' ? 'active' : '' }}">
				<a href="{{ route('enrolled-students-for-ietls-courses') }}">
					<i class="icon-user-following"></i>
					<span class="menu-title">
						المشتركين بدورات IELTS
					</span>
				</a>
			</li>
			{{-- End IETLS Courses Pages --}}







			{{-- Start Live Zoom Courses Pages --}}
			<li class=" navigation-header">
                <span data-i18n="nav.category.layouts"> دورات Zoom </span>
                <i class="ft-more-horizontal ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li>

			<li class="nav-item {{ isset($active) && $active == 'zoom-courses' ? 'active' : '' }}">
				<a href="{{ route('zoom-courses') }}">
					<i class="icon-notebook"></i>
					<span class="menu-title">
						جميع دورات zoom
					</span>
				</a>
			</li>

			<li class="nav-item {{ isset($active) && $active == 'zoom-course.create' ? 'active' : '' }}">
				<a href="{{ route('zoom-course.create') }}">
					<i class="icon-plus"></i>
					<span class="menu-title">
						انشاء دورة zoom جديدة
					</span>
				</a>
			</li>

			<li class="nav-item {{ isset($active) && $active == 'zoom-course.user.create' ? 'active' : '' }}">
				<a href="{{ route('zoom-course.user.create') }}">
					<i class="icon-user"></i>
					<span class="menu-title">
						انشاء  مستخدمين
					</span>
				</a>
			</li>

			<li class="nav-item {{ isset($active) && $active == 'enrolled-students-for-zoom-courses' ? 'active' : '' }}">
				<a href="{{ route('enrolled-students-for-zoom-courses') }}">
					<i class="icon-user-following"></i>
					<span class="menu-title">
						المشتركين بالدورة
					</span>
				</a>
			</li>

			<li class="nav-item {{ isset($active) && $active == 'zoom-course.users' ? 'active' : '' }}">
				<a href="{{ route('zoom-course.users') }}">
					<i class="icon-user-following"></i>
					<span class="menu-title">
						المستخدمين
					</span>
				</a>
			</li>
			{{-- End Live Zoom Courses Pages --}}


			{{-- Start Bundles Pages --}}
			<li class=" navigation-header">
                <span data-i18n="nav.category.layouts"> الباقات </span>
                <i class="ft-more-horizontal ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li>

			<li class="nav-item {{ isset($active) && $active == 'bundles' ? 'active' : '' }}">
				<a href="{{ route('bundles') }}">
					<i class="icon-social-dropbox"></i>
					<span class="menu-title">
						قائمة بجميع الباقات
					</span>
				</a>
			</li>
			{{-- End Bundles Pages --}}


			{{-- Start Other Pages --}}
			<li class=" navigation-header">
                <span data-i18n="nav.category.layouts"> الصفحات </span>
                <i class="ft-more-horizontal ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li>

			<li class="nav-item {{ isset($active) && $active == 'library' ? 'active' : '' }}">
				<a  href="{{ route('library') }}">
					<i class="icon-book"></i>
					<span class="menu-title">الكتب</span>
				</a>
			</li> 

			<li class="nav-item">
				<a href="index.html">
					<i class="icon-badge"></i>
					<span class="menu-title">الشهادات</span>
				</a>
				<ul class="menu-content">
					<li class="{{ isset($active) && $active == 'public-certificates' ? 'active' : '' }}">
						<a class="menu-item" href="{{ route('public-certificates') }}">الشهادات المفتوحة</a>
					</li>
				</ul>
			</li> 
			
			<li class="nav-item">
				<a href="index.html">
					<i class="icon-book-open"></i>
					<span class="menu-title">البلوجات</span>
				</a>
				<ul class="menu-content">
					<li class="{{ isset($active) && $active == 'blogs.categories' ? 'active' : '' }}">
						<a class="menu-item" href="{{ route('blog.categories') }}">فئات البلوجات</a>
					</li>
					<li class="{{ isset($active) && $active == 'blogs' ? 'active' : '' }}">
						<a class="menu-item" href="{{ route('blogs') }}">قائمة بجميع البلوجات</a>
					</li>
					<li class="{{ isset($active) && $active == 'blogs' ? 'active' : '' }}">
						<a class="menu-item" href="{{ route('blog.create') }}">انشاء بلوج</a>
					</li>
				</ul>
			</li> 
			{{-- End Other Pages --}}

			
			{{-- Start Exam Pages --}}
			<li class=" navigation-header">
                <span data-i18n="nav.category.layouts"> MCQ (IELTS & Recorded) </span>
                <i class="ft-more-horizontal ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li>
			
			<li class="nav-item {{ isset($active) && $active =='exam.create' ? 'active' : '' }}">
				<a href="{{{ route('exam.create') }}}">
					<i class="ft-file-plus"></i>
					<span class="menu-title">
						Create New MCQ
					</span>
				</a>
			</li>

			<li class="nav-item {{ isset($active) && $active == 'exams' ? 'active' : '' }}">
				<a href="{{ route('exams') }}">
					<i class="icon-docs"></i>
					<span class="menu-title">
						List of all of MCQs
					</span>
				</a>
			</li>

			<li class="nav-item {{ isset($active) && $active == 'registed-users-exams' ? 'active' : '' }}">
				<a href="{{ route('registed-users-exams') }}">
					<i class="icon-user-following"></i>
					<span class="menu-title">
						MCQs Students
					</span>
				</a>
			</li>
			{{-- End Exam Pages --}}


			{{-- Start Exam Pages --}}
			<li class=" navigation-header">
                <span data-i18n="nav.category.layouts"> Public Testing Center </span>
                <i class="ft-more-horizontal ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li>

			<li class="nav-item {{ isset($active) && $active =='survey-js.index' ? 'active' : '' }}">
				<a href="{{{ route('survey-js.index') }}}">
					<i class="ft-file-plus"></i>
					<span class="menu-title">
						List of all Tests
					</span>
				</a>
			</li>

			<li class="nav-item {{ isset($active) && $active =='survey-js.create' ? 'active' : '' }}">
				<a href="{{{ route('survey-js.create') }}}">
					<i class="ft-file-plus"></i>
					<span class="menu-title">
						Create new Test
					</span>
				</a>
			</li>
			{{-- Start Exam Pages --}}

			{{-- Start Exercise Pages --}}
			<li class=" navigation-header">
				<span data-i18n="nav.category.layouts"> Exercises (Zoom)</span>
				<i class="ft-more-horizontal ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
			</li>

			<li class="nav-item {{ isset($active) && $active =='exercise.index' ? 'active' : '' }}">
				<a href="{{{ route('exercise.index') }}}">
					<i class="ft-file-plus"></i>
					<span class="menu-title">
						List of all Exercises
					</span>
				</a>
			</li>

			<li class="nav-item {{ isset($active) && $active =='exercise.create' ? 'active' : '' }}">
				<a href="{{{ route('exercise.create') }}}">
					<i class="ft-file-plus"></i>
					<span class="menu-title">
						Create new Exercise
					</span>
				</a>
			</li>
			{{-- Start Exercise Pages --}}


			{{-- Start Settings Pages --}}
			<li class=" navigation-header">
                <span data-i18n="nav.category.layouts"> اعدادات </span>
                <i class="ft-more-horizontal ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li>

            <li class="nav-item {{ isset($active) && $active == '' ? 'active' : '' }}">
                <a href="{{ route('settings') }}">
                    <i class="icon-settings"></i>
                    <span class="menu-title"> اعدادات عامة </span>
                </a>
            </li>

            <li class="nav-item {{ isset($active) && $active == '' ? 'active' : '' }}">
                <a href="{{ route('settings.change-password') }}">
                    <i class="icon-key"></i>
                    <span class="menu-title"> تغيير كلمة المرور </span>
                </a>
            </li>

            <li class="nav-item {{ isset($active) && $active == '' ? 'active' : '' }}">
                <a href="{{ route('settings.change-email') }}">
                    <i class="ft-at-sign"></i>
                    <span class="menu-title"> تغيير البريد الالكتروني </span>
                </a>
            </li>
			{{-- End Settings Pages --}}
		</ul>
    </div>
</div>