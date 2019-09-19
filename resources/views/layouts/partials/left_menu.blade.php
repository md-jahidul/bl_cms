<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="#"><i class="la la-home"></i>
                <span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
            </li>

            {{--------------------------------------------------------------------------------------------------------------------}}
            {{---------------------------------------------------------Asset Lite-------------------------------------------------}}
            {{--------------------------------------------------------------------------------------------------------------------}}
            @if(Auth::user()->role_id == '1'|| Auth::user()->role_id == '3')
            <li class="nav-item"><a href="{{ url('menu') }}"><i class="la la-medium"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Menu Management</span></a>
            </li>

            <li class="nav-item"><a href="{{ url('footer-menu') }}"><i class="la la-futbol-o"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Footer Management</span></a>
            </li>
            {{-- <li class="{{ is_active_url('slider') . is_active_url('slider/addImage/') . is_active_url('slider/create') . is_active_url('slider/edit') }}">
                <a class="nav-item" href="{{ route('slider.index') }}" data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-sliders"></i>Slider</a>
            </li> --}}
            <li class="nav-item"><a href="{{ url('quick-launch') }}"><i class="la la-automobile"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Quick launch</span></a>
            </li>
            <li class="nav-item"><a href="#"><i class="la la-question"></i>
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

            <li class=" nav-item"><a href="{{ url('config') }}"><i class="la la-gears"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Settings Page</span></a>
            </li>

            <li class=" nav-item {{ is_active_url('partners') . is_active_url('partners/create')}}"><a href="{{ url('partners') }}"><i class="la la-users"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Partners Management</span></a>
            </li>

            <li class="nav-item"><a href="#"><i class="la la-sliders"></i>
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
            @endif
            {{--------------------------------------------------------------------------------------------------------------------}}
            {{---------------------------------------------------------Asset Lite End---------------------------------------------}}
            {{--------------------------------------------------------------------------------------------------------------------}}



            {{--------------------------------------------------------------------------------------------------------------------}}
            {{---------------------------------------------------------My-BL App--------------------------------------------------}}
            {{--------------------------------------------------------------------------------------------------------------------}}
            @if(Auth::user()->role_id == '1'|| Auth::user()->role_id == '2')
            <li class="{{ is_active_url('/helpCenter') }} {{ is_active_url('helpCenter/create') }} nav-item"><a href="{{route('helpCenter.index')}}"><i class="la la-ambulance"></i>
                <span class="menu-title" data-i18n="nav.dash.main">Help Center</span></a>
            </li>
            <li class="{{ is_active_url('/setting') }} nav-item"><a href="{{route('setting.index')}}"><i class="la la-cogs"></i>
                <span class="menu-title" data-i18n="nav.dash.main">Settings</span></a>
            </li>
            <li class="{{ is_active_url('shortcuts') }} nav-item"><a href="{{route('short_cuts.index')}}"><i class="la la-fighter-jet"></i>
                <span class="menu-title" data-i18n="nav.dash.main">Short Cuts</span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="la la-file"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Manage Page</span></a>
                <ul class="menu-content">
                    {{--page--}}
                    <li class="{{ is_active_url('slider') . is_active_url('slider/addImage/') . is_active_url('slider/create') . is_active_url('slider/edit') }}">
                        <a class="menu-item" href="{{ route('slider.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="la la-sliders"></i>Slider</a>
                    </li>
                    <li class="{{ is_active_url('banner') . is_active_url('banner/create')}}">
                        <a class="menu-item" href="{{ route('banner.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="la la-image"></i> Banner</a>
                    </li>
                    <li class="{{ is_active_url('wellcomeInfo') . is_active_url('wellcomeInfo/create')}}">
                        <a class="menu-item" href="{{ route('wellcomeInfo.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="la la-info-circle"></i> Welcome Info</a>
                    </li>

                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="la la-gift"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Offers</span></a>
                <ul class="menu-content">
                    {{--offers--}}
                    <li class="{{ is_active_url('internetOffer')}} {{is_active_url('internetOffer/create')}}">
                        <a class="menu-item" href="{{ route('internetOffer.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="la la-globe"></i> Internet Offer</a>
                    </li>
                    <li class="{{is_active_url('minuteOffer')}} {{is_active_url('minuteOffer/create')}}">
                        <a class="menu-item" href="{{ route('minuteOffer.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="la la-phone-square"></i> Minuit Offer</a>
                    </li>
                    <li class="{{is_active_url('smsOffer')}} {{is_active_url('smsOffer/create')}}">
                        <a class="menu-item" href="{{ route('smsOffer.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="la la-comments-o"></i> SMS Offer</a>
                    </li>
                    <li class="{{is_active_url('mixedBundleOffer')}} {{is_active_url('mixedBundleOffer/create')}}">
                        <a class="menu-item" href="{{ route('mixedBundleOffer.index') }} " data-i18n="nav.templates.vert.classic_menu">
                            <i class="la la-flask"></i> Mixed Bundle</a>
                    </li>
                    <li class="{{is_active_url('nearByOffer')}} {{is_active_url('nearByOffer/create')}}">
                        <a class="menu-item" href="{{ route('nearByOffer.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="la la-gift"></i> Near by Offer</a>
                    </li>

                </ul>
            </li>
            @endif
            {{--------------------------------------------------------------------------------------------------------------------}}
            {{---------------------------------------------------------My-BL App End----------------------------------------------}}
            {{--------------------------------------------------------------------------------------------------------------------}}

        </ul>

    </div>
</div>
