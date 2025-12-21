<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">Menu</li>
        <li class="{{ adminSidebarActive(['admin.dashboard']) }}">
            <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                <i class="ri-dashboard-line"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="{{ adminSidebarActive(['admin.instructor-requests.index']) }}">
            <a href="{{ route('admin.instructor-requests.index') }}" class="waves-effect">
                <i class="ri-dashboard-line"></i>
                <span>Instructor Requests</span>
            </a>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-mail-send-line"></i>
                <span>Course Management</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li class="{{ adminSidebarActive(['admin.course-categories.*']) }}"><a
                        href="{{ route('admin.course-categories.index') }}">Course Categories</a></li>
                <li class="{{ adminSidebarActive(['admin.course-languages.*']) }}"><a
                        href="{{ route('admin.course-languages.index') }}">Course Languages</a></li>
                <li class="{{ adminSidebarActive(['admin.course-levels.*']) }}"><a
                        href="{{ route('admin.course-levels.index') }}">Course Levels</a></li>
            </ul>
        </li>

        {{-- <li>
            <a href="index.html" class="waves-effect">
                <i class="ri-dashboard-line"></i>
                <span>Dashboard</span>
            </a>
        </li> --}}
        {{-- <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-mail-send-line"></i>
                <span>Email</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="email-inbox.html">Inbox</a></li>
                <li><a href="email-read.html">Read Email</a></li>
            </ul>
        </li> --}}
    </ul>
</div>
