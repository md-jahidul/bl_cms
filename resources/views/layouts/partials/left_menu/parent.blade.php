<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ is_active_url('/home') }} nav-item"><a href="{{ asset('home') }}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
            </li>

            @include('layouts.partials.left_menu.assetlite')

            @include('layouts.partials.left_menu.mybl')

        </ul>
    </div>
</div>
