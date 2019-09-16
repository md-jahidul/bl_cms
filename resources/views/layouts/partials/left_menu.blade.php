<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="#"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>

            </li>
            <li class=" nav-item"><a href="{{ url('menu') }}"><i class="la la-medium"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Menu Management</span></a>
            </li>

            <li class=" nav-item"><a href="{{ url('footer-menu') }}"><i class="la la-futbol-o"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Footer Management</span></a>
            </li>

            <li class=" nav-item"><a href="{{ url('quick-launch') }}"><i class="la la-automobile"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Quick launch</span></a>
            </li>

            <li class=" nav-item"><a href="{{ url('config') }}"><i class="la la-gears"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Settings Page</span></a>
            </li>

            <li class=" nav-item"><a href="#"><i class="la la-sliders"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Slider Management</span></a>
                <ul class="menu-content">

                    <li class="{{ is_active_url('sliders') . is_active_url('sliders/create')}}">
                        <a class="menu-item" href="{{ url('sliders') }}" data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-file-image-o"></i> Slider</a>
                    </li>
{{--                    <li class="{{ is_active_url('slider/images') . is_active_url('sliders/images/create')}}">--}}
{{--                        <a class="menu-item" href="{{ url('slider/images') }}" data-i18n="nav.templates.vert.classic_menu"><i--}}
{{--                                    class="la la-file-image-o"></i> Slider Image</a>--}}
{{--                    </li>--}}

                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="la la-question"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Quiz Management</span></a>
                <ul class="menu-content">
                    {{--Tag--}}
                    <li class="{{ is_active_url('tags') . is_active_url('tags/create')}}">
                        <a class="menu-item" href="{{ url('tags') }}" data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-tags"></i> Tag</a>
                    </li>
                    <li class="{{ is_active_url('campaigns') . is_active_url('campaigns/create')}}">
                        <a class="menu-item" href="{{ url('campaigns') }}" data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-bullhorn"></i> Campaign</a>
                    </li>
                    <li class="{{ is_active_url('questions') . is_active_url('questions/create')}}">
                        <a class="menu-item" href="{{ url('questions') }}" data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-question"></i> Question</a>
                    </li>

                    <li class="{{ is_active_url('prizes') . is_active_url('prizes/create')}}">
                        <a class="menu-item" href="{{ url('prizes') }}" data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-trophy"></i> Prize</a>
                    </li>

                </ul>
            </li>

        </ul>
    </div>
</div>
