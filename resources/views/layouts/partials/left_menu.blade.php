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
            {{-- <li class="{{ is_active_url('slider-other-attr') . is_active_url('slider-other-attr/addImage/') . is_active_url('slider-other-attr/create') . is_active_url('slider-other-attr/edit') }}">
                <a class="nav-item" href="{{ route('slider-other-attr.index') }}" data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-sliders"></i>Slider</a>
            </li> --}}
            <li class="nav-item"><a href="{{ url('quick-launch') }}"><i class="la la-automobile"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Quick launch</span></a>
            </li>

            <li class="nav-item"><a href="#"><i class="la la-sliders"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Slider Management</span></a>
                <ul class="menu-content">

                    <li class="{{ is_active_url('sliders') . is_active_url('sliders/create')}}">
                        <a class="menu-item" href="{{ url('sliders') }}" data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-file-image-o"></i> Slider</a>
                    </li>

                </ul>
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
            <li class="{{ is_active_url('ussd') }} nav-item"><a href="{{route('ussd.index')}}">
                <i class="la la-qrcode"></i>USSD</span></a>
            </li>
            <li class="{{ is_active_url('shortcuts') }} nav-item"><a href="{{route('short_cuts.index')}}"><i class="la la-fighter-jet"></i>
                <span class="menu-title" data-i18n="nav.dash.main">Short Cuts</span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="la la-bell"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Notification</span></a>
                <ul class="menu-content">
                    {{--page--}}
                    <li class="{{is_active_url('notifiactionCategorie')}}">
                        <a class="menu-item" href="{{ route('notifiactionCategorie.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="la la-server"></i>Notification Category
                        </a>
                    </li>
                    <li class="{{is_active_url('notifiaction')}}{{is_active_url('notifiaction/create')}}">
                        <a class="menu-item" href="{{ route('notifiaction.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="la la-comment-o"></i>Notification</a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="la la-file"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Manage Page</span></a>
                <ul class="menu-content">
                    {{--page--}}
                    <li class="{{ is_active_url('myblslider') . is_active_url('myblslider/addImage/') . is_active_url('myblslider/create') . is_active_url('myblslider/edit') }}">
                        <a class="menu-item" href="{{ route('myblslider.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="la la-sliders"></i>My-BL Slider</a>
                    </li>
                    <li class="{{ is_active_url('banner') . is_active_url('banner/create')}}">
                        <a class="menu-item" href="{{ route('banner.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="la la-image"></i>My-BL Banner</a>
                    </li>
                    <li class="{{ is_active_url('welcomeInfo') . is_active_url('welcomeInfo')}}">
                        <a class="menu-item" href="{{ route('welcomeInfo.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="la la-info-circle"></i>My-BL Welcome Info</a>
                    </li>
                    <li class="{{ is_active_url('contextualcard') . is_active_url('contextualcard/create')}}">
                        <a class="menu-item" href="{{ route('contextualcard.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="la la-external-link-square"></i>My-BL Contextual Card</a>
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
                            <i class="la la-phone-square"></i> Minute Offer</a>
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
                    <li class="{{is_active_url('amarOffer')}} {{is_active_url('amarOffer/create')}}">
                        <a class="menu-item" href="{{ route('amarOffer.index') }}" data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-cart-arrow-down"></i> Amar Offer</a>
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
