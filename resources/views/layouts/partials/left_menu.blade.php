<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="#"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>

            </li>
            <li class=" nav-item"><a href="#"><i class="la la-television"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Slider Manager</span></a>
                <ul class="menu-content">

                    <li class="{{ is_active_url('sliders') . is_active_url('sliders/create')}}">
                        <a class="menu-item" href="{{ url('sliders') }}" data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-file-image-o"></i> Slider</a>
                    </li>
                    <li class="{{ is_active_url('slider/image') . is_active_url('slider/images/create')}}">
                        <a class="menu-item" href="{{ url('slider/images') }}" data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-file-image-o"></i> Slider Image</a>
                    </li>

                </ul>
            </li>

        </ul>
    </div>
</div>