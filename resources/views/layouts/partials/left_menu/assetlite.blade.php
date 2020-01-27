{{--------------------------------------------------------------------------------------------------------------------}}
{{---------------------------------------------------------Asset Lite-------------------------------------------------}}
{{--------------------------------------------------------------------------------------------------------------------}}
@if(Auth::user()->type == 'assetlite')

    @if( auth()->user()->can_view('User') || auth()->user()->can_view('Role') || auth()->user()->can_view('Permissions') )
        <li class="nav-item"><a href="#"><i class="la la-users"></i>
                <span class="menu-title" data-i18n="nav.templates.main">User Management</span></a>
            <ul class="menu-content">
                @if( auth()->user()->can_view('User') )
                    <li class="{{ is_active_url('authorize/users')}}">
                        <a class="menu-item" href="{{ url('authorize/users') }}"
                           data-i18n="nav.templates.vert.classic_menu"><i
                                class="la la-user"></i> User</a>
                    </li>
                @endif


                @if( auth()->user()->can_view('Roles') )
                    <li class="{{ is_active_url('authorize/roles')}}">
                        <a class="menu-item" href="{{ url('authorize/roles') }}"
                           data-i18n="nav.templates.vert.classic_menu"><i
                                class="la la-cubes"></i> Role</a>
                    </li>
                @endif
                @if( auth()->user()->can_view('Permissions') )
                    <li class="{{ is_active_url('authorize/permissions')}}">
                        <a class="menu-item" href="{{ url('authorize/permissions') }}"
                           data-i18n="nav.templates.vert.classic_menu"><i
                                class="la la-check-square"></i> Permission</a>
                    </li>
                @endif
            </ul>
        </li>
    @endif

    @if( auth()->user()->can_view('QuickLaunch') )
        <li class="{{ is_active_url('/quick-launch') }} nav-item"><a href="{{ url('quick-launch') }}"><i
                    class="la la-automobile"></i>
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
                    <li class="{{ is_active_url('/config') }} nav-item"><a href="{{ url('config')}}"><i
                                class="la la-cogs"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">General</span></a>
                    </li>
                @endif

                @if( auth()->user()->can_view('Menu') )
                    <li class="{{ is_active_url('/menu') }} nav-item"><a href="{{ url('menu') }}"><i
                                class="la la-medium"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">Header menu</span></a>
                    </li>
                @endif

                @if( auth()->user()->can_view('FooterMenu') )
                    <li class="{{ is_active_url('/footer-menu') }} nav-item"><a href="{{ url('footer-menu') }}"><i
                                class="la la-futbol-o"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">Footer menu</span></a>
                    </li>
                @endif

                <li class="{{ is_active_url('/priyojon') }} nav-item"><a href="{{ url('priyojon') }}"><i
                            class="la la-futbol-o"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">Priyojon Landing</span></a>
                </li>

            </ul>
        </li>
    @endif

    @if( auth()->user()->can_view('Slider', 'singleSlider') || auth()->user()->can_view('Slider', 'multiSlider') )
        <li class="nav-item"><a href="#"><i class="la la-sliders"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Slider Management</span></a>
            <ul class="menu-content">
                @if( auth()->user()->can_view('Slider', 'singleSlider') )
                    <li class="{{ is_active_url('single-sliders') . is_active_url('sliders/create')}}">
                        <a class="menu-item" href="{{ url('single-sliders') }}"
                           data-i18n="nav.templates.vert.classic_menu"><i class="la la-file-image-o"></i> Single slider</a>
                    </li>
                @endif

                @if(  auth()->user()->can_view('Slider', 'multiSlider') )
                    <li class="{{ is_active_url('multiple-sliders') . is_active_url('sliders/create')}}">
                        <a class="menu-item" href="{{ url('multiple-sliders/') }}"
                           data-i18n="nav.templates.vert.classic_menu"><i class="la la-file-image-o"></i> Multiple
                            slider</a>
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

    @if( auth()->user()->can_view('Product') )
        <li class="nav-item"><a href="#"><i class="la la-gittip"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Offer Categories</span></a>
            <ul class="menu-content">

                <li class="{{ is_active_url('tag-category') }}">
                    <a class="menu-item" href="{{ url('tag-category') }}" data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-tags"></i> Tag</a>
                </li>
                <li class="{{ is_active_url('sim-categories') }}">
                    <a class="menu-item" href="{{ route('sim-categories.index') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-file"></i> Package</a>
                </li>

                <li class="{{ is_active_url('offer-categories') }}">
                    <a class="menu-item" href="{{ route('offer-categories.index') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-magic"></i> Offer</a>
                </li>

                <li class="{{ is_active_url('duration-categories') }}">
                    <a class="menu-item" href="{{ route('duration-categories.index') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-calendar-times-o"></i> Duration</a>
                </li>

            </ul>
        </li>
    @endif


    @if( auth()->user()->can_view('Product') )
        <li class="nav-item"><a href="#"><i class="la la-gift"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Product Management</span></a>
            <ul class="menu-content">

                <li class="{{ is_active_url('offers/prepaid') . is_active_url('offers/prepaid/create') }}">
                    <a class="menu-item" href="{{ route('product.list','prepaid') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-magic"></i> Prepaid</a>
                </li>
                <li class="{{ is_active_url('offers/postpaid') . is_active_url('offers/postpaid/create') }}">
                    <a class="menu-item" href="{{ route('product.list','postpaid') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-magic"></i> Postpaid</a>
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

        <li class="nav-item"><a href="#"><i class="la la-info"></i>
                <span class="menu-title" data-i18n="nav.templates.main">About Page</span></a>
            <ul class="menu-content">
                <li class="{{ is_active_url('about-page/priyojon') }}">
                    <a class="menu-item" href="{{ url('about-page/priyojon') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-exclamation-circle"></i>About Priyojon
                    </a>
                </li>
                <li class="{{ is_active_url('about-page/reward_points')}}">
                    <a class="menu-item" href="{{ url('about-page/reward_points') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-exclamation-circle"></i> About Reward Point</a>
                </li>
            </ul>
        </li>
    @endif


    @if( auth()->user()->can_view('Product') )
        <li class="nav-item"><a href="#"><i class="la la-gift"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Core Product</span></a>
            <ul class="menu-content">

                <li class="{{ is_active_url('product-core') . is_active_url('product-core') }}">
                    <a class="menu-item" href="{{ route('product.core.list') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-magic"></i> Core Product Management</a>
                </li>
                <!-- <li class="{{ is_active_url('offers/postpaid') . is_active_url('offers/postpaid/create') }}">
                    <a class="menu-item" href="{{ route('product.list','postpaid') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-magic"></i> Postpaid</a>
                </li> -->

            </ul>
        </li>
    @endif

    {{--        TODO:: Quiz Management using 2nd priority  --}}
    {{--        @if( auth()->user()->can_view('Tag') || auth()->user()->can_view('Campaign') || auth()->user()->can_view('Question') || auth()->user()->can_view('Prize'))--}}
    {{--            <li class="nav-item"><a href="#"><i class="la la-question"></i>--}}
    {{--                    <span class="menu-title" data-i18n="nav.templates.main">Quiz Management</span></a>--}}
    {{--                <ul class="menu-content">--}}
    {{--                    --}}{{--Tag--}}
    {{--                    @if( auth()->user()->can_view('Tag') )--}}
    {{--                        <li class="{{ is_active_url('tags') . is_active_url('tags/create')}}">--}}
    {{--                            <a class="menu-item" href="{{ url('tags') }}" data-i18n="nav.templates.vert.classic_menu"><i--}}
    {{--                                    class="la la-tags"></i> Tag</a>--}}
    {{--                        </li>--}}
    {{--                    @endif--}}
    {{--                    @if( auth()->user()->can_view('Campaign') )--}}
    {{--                        <li class="{{ is_active_url('campaigns') . is_active_url('campaigns/create')}}">--}}
    {{--                            <a class="menu-item" href="{{ url('campaigns') }}" data-i18n="nav.templates.vert.classic_menu"><i--}}
    {{--                                    class="la la-bullhorn"></i> Campaign</a>--}}
    {{--                        </li>--}}
    {{--                    @endif--}}
    {{--                    @if( auth()->user()->can_view('Question') )--}}
    {{--                        <li class="{{ is_active_url('questions') . is_active_url('questions/create')}}">--}}
    {{--                            <a class="menu-item" href="{{ url('questions') }}" data-i18n="nav.templates.vert.classic_menu"><i--}}
    {{--                                    class="la la-question"></i> Question</a>--}}
    {{--                        </li>--}}
    {{--                    @endif--}}
    {{--                    @if( auth()->user()->can_view('Prize') )--}}
    {{--                        <li class="{{ is_active_url('prizes') . is_active_url('prizes/create')}}">--}}
    {{--                            <a class="menu-item" href="{{ url('prizes') }}" data-i18n="nav.templates.vert.classic_menu"><i--}}
    {{--                                    class="la la-trophy"></i> Prize</a>--}}
    {{--                        </li>--}}
    {{--                    @endif--}}
    {{--                </ul>--}}
    {{--            </li>--}}
    {{--        @endif--}}
@endif
{{--------------------------------------------------------------------------------------------------------------------}}
{{---------------------------------------------------------Asset Lite End---------------------------------------------}}
{{--------------------------------------------------------------------------------------------------------------------}}
