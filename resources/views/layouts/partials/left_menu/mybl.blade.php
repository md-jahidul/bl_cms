{{--------------------------------------------------------------------------------------------------------------------}}
{{---------------------------------------------------------My-BL App--------------------------------------------------}}
{{--------------------------------------------------------------------------------------------------------------------}}
@if(Auth::user()->type == 'mybl')
    <li class="{{ is_active_url('/helpCenter') }} {{ is_active_url('helpCenter/create') }} nav-item"><a
            href="{{route('helpCenter.index')}}"><i class="la la-ambulance"></i>
            <span class="menu-title" data-i18n="nav.dash.main">Help Center</span></a>
    </li>
    <li class="{{ is_active_url('/setting') }} nav-item"><a href="{{route('setting.index')}}"><i class="la la-cogs"></i>
            <span class="menu-title" data-i18n="nav.dash.main">Settings</span></a>
    </li>
    <li class="{{ is_active_url('ussd') }} nav-item"><a href="{{route('ussd.index')}}">
            <i class="la la-qrcode"></i>USSD</a>
    </li>
    <li class="{{ is_active_url('shortcuts') }} nav-item"><a href="{{route('short_cuts.index')}}"><i
                class="la la-fighter-jet"></i>
            <span class="menu-title" data-i18n="nav.dash.main">Shortcuts</span></a>
    </li>
    <li class=" nav-item"><a href="#"><i class="la la-bell"></i>
            <span class="menu-title" data-i18n="nav.templates.main">Notification</span></a>
        <ul class="menu-content">
            {{--page--}}
            <li class="{{ is_active_url('notificationCategory') }}{{ is_active_url('notificationCategory/create') }}">
                <a class="menu-item" href="{{ route('notificationCategory.index') }}"
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-server"></i>Category List
                </a>
            </li>
            <li class="{{ is_active_url('notification') }}{{ is_active_url('notification/create') }}">
                <a class="menu-item" href="{{ route('notification.index') }}"
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-comment-o"></i>Notification List</a>
            </li>
        </ul>
    </li>
    <li class=" nav-item"><a href="#"><i class="la la-puzzle-piece"></i>
            <span class="menu-title" data-i18n="nav.templates.main">Component</span></a>
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
            <li class="{{ is_active_url('welcomeInfo') . is_active_url('welcomeInfo/create')}} . @if(isset($welcomeInfo)) {{is_active_url('welcomeInfo/'.$welcomeInfo->id.'/edit')}} @endif">
                <a class="menu-item" href="{{ route('welcomeInfo.index') }}"
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-info-circle"></i>My-BL Welcome Info</a>
            </li>
            <li class="{{ is_active_url('contextualcard') . is_active_url('contextualcard/create')}}">
                <a class="menu-item" href="{{ route('contextualcard.index') }}"
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-external-link-square"></i>My-BL Contextual Card</a>
            </li>

        </ul>
    </li>

    <li class=" nav-item"><a href="#"><i class="la la-gift"></i>
            <span class="menu-title" data-i18n="nav.templates.main">Offers</span></a>
        <ul class="menu-content">
            {{--offers--}}
            <li class="{{ is_active_url('internetOffer')}} {{is_active_url('internetOffer/create')}}">
                <a class="menu-item" href="{{ route('internetOffer.index') }}"
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-globe"></i> Internet Offer</a>
            </li>
            <li class="{{is_active_url('minuteOffer')}} {{is_active_url('minuteOffer/create')}}">
                <a class="menu-item" href="{{ route('minuteOffer.index') }}"
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-phone-square"></i> Minute Offer</a>
            </li>
            <li class="{{is_active_url('smsOffer')}} {{is_active_url('smsOffer/create')}}">
                <a class="menu-item" href="{{ route('smsOffer.index') }}" data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-comments-o"></i> SMS Offer</a>
            </li>
            <li class="{{is_active_url('mixedBundleOffer')}} {{is_active_url('mixedBundleOffer/create')}}">
                <a class="menu-item" href="{{ route('mixedBundleOffer.index') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-flask"></i> Mixed Bundle</a>
            </li>
            <li class="{{is_active_url('nearByOffer')}} {{is_active_url('nearByOffer/create')}}">
                <a class="menu-item" href="{{ route('nearByOffer.index') }}"
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-gift"></i> Near by Offer</a>
            </li>
            <li class="{{is_active_url('amarOffer')}} {{is_active_url('amarOffer/create')}}">
                <a class="menu-item" href="{{ route('amarOffer.index') }}" data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-cart-arrow-down"></i> Amar Offer</a>
            </li>

        </ul>
    </li>

    <li class=" nav-item"><a href="#"><i class="la la-flask"></i>
            <span class="menu-title" data-i18n="nav.templates.main">Filters</span></a>
        <ul class="menu-content">

            <li class=" {{is_active_url('internet-pack/filter/create')}}">
                <a class="menu-item" href="{{ route('internet-pack.filter.create') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-flask"></i> Internet Pack Filter
                </a>
            </li>
            <li class="{{is_active_url('mixed-bundle-offer/filter/create')}}">
                <a class="menu-item" href="{{ route('mixed-bundle-offer.filter.create') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-flask"></i> Mixed Bundle Filter
                </a>
            </li>

        </ul>
    </li>

    <li class="{{ is_active_url('/terms-conditions') }} nav-item"><a href="{{route('terms-conditions.show')}}"><i
                class="la la-legal"></i>
            <span class="menu-title">Terms and Conditions</span></a>
    </li>

        <li class=" nav-item"><a href="#"><i class="la la-question"></i>
                <span class="menu-title" data-i18n="nav.templates.main">FAQ</span></a>
            <ul class="menu-content">
                <li class=" {{is_active_url('faq/category')}}">
                    <a class="menu-item" href="{{ route('faq.category.index') }} "
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-list"></i> Category List
                    </a>
                </li>
                <li class="{{is_active_url('faq/questions')}}">
                    <a class="menu-item" href="{{ route('faq.questions.index') }} "
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-list"></i> Question List
                    </a>
                </li>
            </ul>
        </li>

    @endif
    {{--------------------------------------------------------------------------------------------------------------------}}
    {{---------------------------------------------------------My-BL App End----------------------------------------------}}
    {{--------------------------------------------------------------------------------------------------------------------}}
