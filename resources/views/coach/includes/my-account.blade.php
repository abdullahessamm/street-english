<div class="accordion js-accordion accordion--boxed mb-24pt" id="instructor-accordion">
    <div class="accordion__item">
        <a href="#"
            class="accordion__toggle collapsed"
            data-toggle="collapse"
            data-target="#instructor-accordion-menu"
            data-parent="#instructor-accordion">
            <span class="flex">
                حسابي
                <b>({{ isset($title) ? $title : null }})</b>
            </span>
            <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
        </a>
        <div class="accordion__menu collapse" id="instructor-accordion-menu">
            
            <div class="accordion__menu-link {{ isset($active) && $active == 'coach.home' ? 'active' : null }}">
                <span class="icon-holder icon-holder--small icon-holder--light rounded-circle d-inline-flex icon--left">
                    <i class="material-icons icon-16pt">school</i>
                </span>
                <a class="flex" href="{{ route('coach.home') }}">صفحتي الشخصية</a>
            </div>

            <div class="accordion__menu-link {{ isset($active) && $active == 'coach.my-courses' ? 'active' : null }}">
                <span class="icon-holder icon-holder--small icon-holder--light rounded-circle d-inline-flex icon--left">
                    <i class="material-icons icon-16pt">import_contacts</i>
                </span>
                <a class="flex" href="{{ route('coach.my-courses') }}">دوراتي التدريبية</a>
            </div>
            
            <div class="accordion__menu-link {{ isset($active) && $active == 'coach.my-sessions' ? 'active' : null }}">
                <span class="icon-holder icon-holder--small icon-holder--light rounded-circle d-inline-flex icon--left">
                    <i class="material-icons icon-16pt">calendar_today</i>
                </span>
                <a class="flex" href="{{ route('coach.my-sessions') }}">جلساتي</a>
            </div>

            <div class="accordion__menu-link {{ isset($active) && $active == 'coach.my-blogs' ? 'active' : null }}">
                <span class="icon-holder icon-holder--small icon-holder--light rounded-circle d-inline-flex icon--left">
                    <i class="material-icons icon-16pt">local_library</i>
                </span>
                <a class="flex" href="{{ route('coach.my-blogs') }}">مقالاتي</a>
            </div>
        </div>
    </div>
</div>