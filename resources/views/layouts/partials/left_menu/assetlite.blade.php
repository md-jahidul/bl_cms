    {{--------------------------------------------------------------------------------------------------------------------}}
    {{---------------------------------------------------------Asset Lite-------------------------------------------------}}
    {{--------------------------------------------------------------------------------------------------------------------}}
    @if(Auth::user()->type == 'assetlite')

        @if( auth()->user()->can_view('User') || auth()->user()->can_view('Role') || auth()->user()->can_view('Role') )
            <li class="nav-item"><a href="#"><i class="la la-users"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">User Management</span></a>
                <ul class="menu-content">
                    @if( auth()->user()->can_view('User') )
                        <li class="{{ is_active_url('authorize/users')}}">
                            <a class="menu-item" href="{{ url('authorize/users') }}" data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-user"></i> User</a>
                        </li>
                    @endif


                    @if( auth()->user()->can_view('Roles') )
                        <li class="{{ is_active_url('authorize/roles')}}">
                            <a class="menu-item" href="{{ url('authorize/roles') }}" data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-cubes"></i> Role</a>
                        </li>
                    @endif
                    @if( auth()->user()->can_view('Permissions') )
                        <li class="{{ is_active_url('authorize/permissions')}}">
                            <a class="menu-item" href="{{ url('authorize/permissions') }}" data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-check-square"></i> Permission</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if( auth()->user()->can_view('QuickLaunch') )
            <li class="{{ is_active_url('/quick-launch') }} nav-item"><a href="{{ url('quick-launch') }}"><i class="la la-automobile"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Quick launch</span></a>
            </li>
        @endif

        @if( auth()->user()->can_view('Config') || auth()->user()->can_view('Menu') || auth()->user()->can_view('FooterMenu') )
            <li class="nav-item">
                <a href="#">
                    <i class="la la la-cogs"></i><span class="menu-title" data-i18n="nav.templates.main">Settings</span>
                </a>
                <ul class="menu-content">
                    @if( auth()->user()->can_view('Config') )
                        <li class="{{ is_active_url('/config') }} nav-item"><a href="{{ url('config')}}"><i class="la la-cogs"></i>
                                <span class="menu-title" data-i18n="nav.dash.main">General</span></a>
                        </li>
                    @endif

                    @if( auth()->user()->can_view('Menu') )
                        <li class="{{ is_active_url('/menu') }} nav-item"><a href="{{ url('menu') }}"><i class="la la-medium"></i>
                                <span class="menu-title" data-i18n="nav.templates.main">Header menu</span></a>
                        </li>
                    @endif

                    @if( auth()->user()->can_view('FooterMenu') )
                        <li class="{{ is_active_url('/footer-menu') }} nav-item"><a href="{{ url('footer-menu') }}"><i class="la la-futbol-o"></i>
                                <span class="menu-title" data-i18n="nav.templates.main">Footer menu</span></a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if( auth()->user()->can_view('AlSlider', 'singleSlider') || auth()->user()->can_view('AlSlider', 'multiSlider') )
            <li class="nav-item"><a href="#"><i class="la la-sliders"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Slider Management</span></a>
                <ul class="menu-content">
                    @if( auth()->user()->can_view('AlSlider', 'singleSlider') )
                        <li class="{{ is_active_url('single-sliders') . is_active_url('sliders/create')}}">
                            <a class="menu-item" href="{{ url('single-sliders') }}" data-i18n="nav.templates.vert.classic_menu"><i class="la la-file-image-o"></i> Single slider</a>
                        </li>
                    @endif

                    @if(  auth()->user()->can_view('AlSlider', 'multiSlider') )
                        <li class="{{ is_active_url('multiple-sliders') . is_active_url('sliders/create')}}">
                            <a class="menu-item" href="{{ url('multiple-sliders/') }}" data-i18n="nav.templates.vert.classic_menu"><i class="la la-file-image-o"></i> Multiple slider</a>
                        </li>
                    @endif

                </ul>
            </li>
        @endif

        @if( auth()->user()->can_view('FixedPage') )
            <li class="nav-item"><a href="#"><i class="la la-file"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Page Management</span></a>
                <ul class="menu-content">

                    <li class="{{ is_active_url('fixed-pages') }}">
                        <a class="menu-item" href="{{ url('fixed-pages') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="la la-file-image-o"></i> Fixed pages
                        </a>
                    </li>

                </ul>
            </li>
        @endif

        @if( auth()->user()->can_view('Partner') )
            <li class="nav-item"><a href="#"><i class="la la-gift"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Offer Management</span></a>
                <ul class="menu-content">

                    <li class="{{ is_active_url('partners') . is_active_url('partners/create')}}">
                        <a class="menu-item" href="{{ url('partners') }}" data-i18n="nav.templates.vert.classic_menu"><i
                                class="la la-magic"></i> Partner and Offers</a>
                    </li>

                </ul>
            </li>
        @endif


        @if( auth()->user()->can_view('Tag') || auth()->user()->can_view('Campaign') || auth()->user()->can_view('Question') || auth()->user()->can_view('Prize'))
            <li class="nav-item"><a href="#"><i class="la la-question"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Quiz Management</span></a>
                <ul class="menu-content">
                    {{--Tag--}}
                    @if( auth()->user()->can_view('Tag') )
                        <li class="{{ is_active_url('tags') . is_active_url('tags/create')}}">
                            <a class="menu-item" href="{{ url('tags') }}" data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-tags"></i> Tag</a>
                        </li>
                    @endif
                    @if( auth()->user()->can_view('Campaign') )
                        <li class="{{ is_active_url('campaigns') . is_active_url('campaigns/create')}}">
                            <a class="menu-item" href="{{ url('campaigns') }}" data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-bullhorn"></i> Campaign</a>
                        </li>
                    @endif
                    @if( auth()->user()->can_view('Question') )
                        <li class="{{ is_active_url('questions') . is_active_url('questions/create')}}">
                            <a class="menu-item" href="{{ url('questions') }}" data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-question"></i> Question</a>
                        </li>
                    @endif
                    @if( auth()->user()->can_view('Prize') )
                        <li class="{{ is_active_url('prizes') . is_active_url('prizes/create')}}">
                            <a class="menu-item" href="{{ url('prizes') }}" data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-trophy"></i> Prize</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
    @endif
    {{--------------------------------------------------------------------------------------------------------------------}}
    {{---------------------------------------------------------Asset Lite End---------------------------------------------}}
    {{--------------------------------------------------------------------------------------------------------------------}}
