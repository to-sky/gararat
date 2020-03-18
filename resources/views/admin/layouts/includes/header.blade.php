<div class="header-container">
    <ul class="nav-left">
        <li>
            <a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);">
                <i class="ti-menu"></i>
            </a>
        </li>
        <li class="search-box">
            <a class="search-toggle no-pdd-right" href="javascript:void(0);">
                <i class="search-icon ti-search pdd-right-10"></i>
                <i class="search-icon-close ti-close pdd-right-10"></i>
            </a>
        </li>
        <li class="search-input">
            <form action="{{ route('admin.search') }}" method="get"><input class="form-control" type="text" name="q" placeholder="Search nodes..."></form>
        </li>
    </ul>

    <ul class="nav-right">
        <li>
            <a href="/" class="d-b td-n bgcH-grey-100 c-grey-700" title="Go to website" target="_blank">
                <i class="ti-home mR-10"></i>
                <span>Go to website</span>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.user.edit', auth()->user()) }}" class="d-b td-n bgcH-grey-100 c-grey-700" title="Profile">
                <i class="ti-user mR-10"></i>
                <span>Profile</span>
            </a>
        </li>

        <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="d-b td-n bgcH-grey-100 c-grey-700">
                <i class="ti-power-off mR-10"></i>
                <span>Logout</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>
