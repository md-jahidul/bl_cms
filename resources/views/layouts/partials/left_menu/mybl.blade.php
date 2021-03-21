{{--------------------------------------------------------------------------------------------------------------------}}
{{---------------------------------------------------------My-BL App--------------------------------------------------}}
{{--------------------------------------------------------------------------------------------------------------------}}
@if(Auth::user()->type == 'mybl')

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

                @if( auth()->user()->can_view('AccessLog') )
                    <li class="{{ is_active_url('access-logs')}}">
                        <a class="menu-item" href="{{ url('access-logs') }}"
                           data-i18n="nav.templates.vert.classic_menu"><i
                                class="la la-lock"></i> Access Logs</a>
                    </li>
                @endif
            </ul>
        </li>
    @endif

    @if( auth()->user()->can_view('ShortCut') )
        <li class="{{ is_active_url('shortcuts') }} nav-item"><a href="{{route('short_cuts.index')}}"><i
                    class="la la-fighter-jet"></i>
                <span class="menu-title" data-i18n="nav.dash.main">Shortcuts</span></a>
        </li>
    @endif

    @if( auth()->user()->can_view('MyblProductEntry') )
        <li class="{{ is_active_url('mybl/core-product') }} nav-item"><a href="{{route('mybl.product.index')}}"><i
                    class="la la-list"></i>
                <span class="menu-title">Products</span></a>

            <ul class="menu-content">
                <li class="{{ is_active_match(route('mybl.product.index')) }}">
                    <a class="menu-item" href="{{ route('mybl.product.index') }}">
                        <i class="ft-list"></i>Products</a>
                </li>
                <li class="{{ is_active_match(route('product-tags.index'))}}">
                    <a class="menu-item" href="{{ route('product-tags.index') }}">
                        <i class="ft-tag"></i>Product Tags</a>
                </li>
            </ul>
        </li>
    @endif

    @if( auth()->user()->can_view('AppLaunch') )
        <li class=" nav-item"><a href="#"><i class="la la-feed"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Popup Management</span></a>
            <ul class="menu-content">
                <li class="{{ is_active_match(route('app-launch.report')) ? '' : is_active_match(route('app-launch.index')) }}">
                    <a class="menu-item" href="{{ route('app-launch.index') }}">
                        <i class="ft-alert-triangle"></i>App Launch Popup</a>
                </li>
                <li class="{{ is_active_match(route('recurring-schedule-hours.index'))}}">
                    <a class="menu-item" href="{{ route('recurring-schedule-hours.index') }}">
                        <i class="ft-clock"></i>Recurring Hours</a>
                </li>
                <li class="{{ is_active_match(route('app-launch.report'))}}">
                    <a class="menu-item" href="{{ route('app-launch.report') }}">
                        <i class="ft-list"></i>Purchase Report</a>
                </li>
            </ul>
        </li>
    @endif

    @if( auth()->user()->can_view('Feed') || auth()->user()->can_view('FeedCategory') )
        <li class=" nav-item"><a href="#"><i class="la la-feed"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Feed</span></a>
            <ul class="menu-content">
                {{--page--}}
                <li class="{{ is_active_url('feeds/categories') }}{{ is_active_url('feeds/categories/create') }}">
                    <a class="menu-item" href="{{ route('feeds.categories.index') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-server"></i>Category List
                    </a>
                </li>
                <li class="{{ is_active_url('feeds') }}{{ is_active_url('feeds/create') }}">
                    <a class="menu-item" href="{{ route('feeds.index') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-feed"></i>Feed List</a>
                </li>
            </ul>
        </li>
    @endif

    @if( auth()->user()->can_view('Notification') || auth()->user()->can_view('NotificationCategory') )
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

                {{-- <li class="{{ is_active_url('notification-report')}}">
                    <a class="menu-item" href="{{ url('notification-report') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-comment-o"></i>Notification Report</a>
                </li> --}}
                <li class="{{ is_active_url('target-wise-notification-report') }}">
                    <a class="menu-item" href="{{ route('target-wise-notification-report.report') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-comment-o"></i>Notification Report</a>
                </li>
                <li class="{{ is_active_url('purchase/from-notification/list')}}">
                    <a class="menu-item" href="{{ url('purchase/from-notification/list') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-comment-o"></i>Purchase Report</a>
                </li>

            </ul>
        </li>
    @endif


    @if( auth()->user()->can_view('Store') || auth()->user()->can_view('StoreCategory') )
        <li class=" nav-item"><a href="#"><i class="la la-cubes"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Store</span></a>
            <ul class="menu-content">
                {{--page--}}
                <li class="{{ is_active_url('storeCategory') }}{{ is_active_url('storeCategory/create') }}">
                    <a class="menu-item" href="{{ route('storeCategory.index') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-server"></i>Category List
                    </a>
                </li>

                <li class="{{ is_active_url('subStore') }}{{ is_active_url('subStore/create') }}">
                    <a class="menu-item" href="{{ route('subStore.index') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-comment-o"></i>Subcategory List</a>
                </li>


                <li class="{{ is_active_url('myblStore') }}{{ is_active_url('myblStore/create') }}">
                    <a class="menu-item" href="{{ route('myblStore.index') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-comment-o"></i>Store List</a>
                </li>


                <li class="{{ is_active_url('appStore') }}{{ is_active_url('appStore/create') }}">
                    <a class="menu-item" href="{{ route('appStore.index') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-comment-o"></i>App List</a>
                </li>


            </ul>
        </li>
    @endif


    @if( auth()->user()->can_view('Banner') || auth()->user()->can_view('WelcomeInfo') || auth()->user()->can_view('MyblSlider')
         || auth()->user()->can_view('MyblSliderImage')  || auth()->user()->can_view('ContextualCard')    )
        <li class=" nav-item"><a href="#"><i class="la la-puzzle-piece"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Component</span></a>
            <ul class="menu-content">
                {{--page--}}
                <li class="{{ is_active_url('myblslider') . is_active_url('myblslider/addImage/') . is_active_url('myblslider/create') . is_active_url('myblslider/edit') }}">
                    <a class="menu-item" href="{{ route('myblslider.index') }}"
                       data-i18n="nav.templates.vert.classic_menu">
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
                <li class="{{ is_active_url('contextualcard-icons') . is_active_url('contextualcard/create')}}">
                    <a class="menu-item" href="{{ route('contextualcard-icons.index') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-external-link-square"></i>Contextual Card Icons</a>
                </li>

                <li class="{{ is_active_url('banner-analytic')}}">
                    <a class="menu-item" href="{{ route('banner-analytic.index') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-external-link-square"></i>Banner Analytics</a>
                </li>
            </ul>
        </li>
    @endif


    @if( auth()->user()->can_view('HelpCenter') )
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
    @endif


    @if( auth()->user()->can_view('MixedBundleFilter') )
        <li class=" nav-item"><a href="#"><i class="la la-flask"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Filters</span></a>
            <ul class="menu-content">
                <li class="{{is_active_url('minute-pack/filter/create')}}">
                    <a class="menu-item" href="{{ route('minute-pack.filter.create') }} "
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="ft-phone-call"></i> Minutes Pack Filter
                    </a>
                </li>

                <li class=" {{is_active_url('internet-pack/filter/create')}}">
                    <a class="menu-item" href="{{ route('internet-pack.filter.create') }} "
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-flask"></i> Internet Pack Filter
                    </a>
                </li>

                <li class=" {{is_active_url('sms-pack/filter/create')}}">
                    <a class="menu-item" href="{{ route('sms-pack.filter.create') }} "
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-send-o"></i> SMS Pack Filter
                    </a>
                </li>

                <li class="{{is_active_url('mixed-bundle-offer/filter/create')}}">
                    <a class="menu-item" href="{{ route('mixed-bundle-offer.filter.create') }} "
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-flask"></i> Mixed Bundle Filter
                    </a>
                </li>

                <li class="{{is_active_url('mybl-internet-offer-category')}}">
                    <a class="menu-item" href="{{ route('mybl-internet-offer-category') }} "
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-align-center"></i> Data Pack Filter
                    </a>
                </li>
                <li class="{{ is_active_url('internetOffer')}} {{is_active_url('recharge-pack/filter/create')}}">
                    <a class="menu-item" href="{{ route('recharge-pack.filter.create') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-globe"></i> Recharge Offer</a>
                </li>
                <li class="{{is_active_url('special-pack/filter/create')}}">
                    <a class="menu-item" href="{{ route('special-pack.filter.create') }} "
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="ft-phone-call"></i> Special call rate Filter
                    </a>
                </li>
            </ul>
        </li>
    @endif


    @if( auth()->user()->can_view('Otp') )
        <li class=" nav-item"><a href="#"><i class="la la-cogs"></i>
                <span class="menu-title">Config</span></a>
            <ul class="menu-content">
                <li class="{{ is_active_url('otp-config') . is_active_url('otp-config/create')}}">
                    <a class="menu-item" href="{{ route('otp-config.index') }}" data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-cog"></i>OTP Config</a>
                </li>

                <li class="{{ is_active_url('recharge/prefill-amounts')}}">
                    <a class="menu-item" href="{{ route('recharge.prefill-amounts.index') }}">
                        <i class="la la-money"></i>Recharge Prefill Amount</a>

                </li>

                <li class="{{ is_active_url('balance-transfer/prefill-amounts')}}">
                    <a class="menu-item" href="{{ route('balance-transfer.prefill-amounts.create') }}">
                        <i class="la la-money"></i>Balance Transfer Prefill Amount</a>

                </li>

                <li class="{{ is_active_url('mybl/settings/najat')}}">
                    <a class="menu-item" href="{{ route('mybl.settings.najat.index') }}">
                        <i class="la la-feed"></i>Najat Content Config</a>

                </li>
                <li class="{{ is_active_url('mybl/settings/lodge/complaints')}}">
                    <a class="menu-item" href="{{ route('lodge_complaints') }}">
                        <i class="la la-cog"></i>Lodge Complaints</a>
                </li>
                <li class="{{ is_active_url('mybl/settings/bandho/sim/list')}}">
                    <a class="menu-item" href="{{ route('bandhosim.index') }}">
                        <i class="la la-cog"></i>Bandho sim image</a>
                </li>

            </ul>
        </li>
    @endif

    @if( auth()->user()->can_view('MigratePlan'))
        <li class=" nav-item"><a href="#"><i class="la la-comment"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Migrate PLan</span></a>
            <ul class="menu-content">
                <li class="{{ is_active_url('migrate-plan') }}{{ is_active_url('migrate-plan/create') }}">
                    <a class="menu-item" href="{{ route('migrate-plan.index') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-comment-o"></i>Migrate Plan List</a>
                </li>


            </ul>
        </li>
    @endif


    @if( auth()->user()->can_view('TermsAndConditions') )
        <li class=" nav-item"><a href="#"><i class="la la-comment"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Terms and Conditions</span></a>
            <ul class="menu-content">
                <li class="{{ is_active_url('/terms-conditions/general') }} nav-item">
                    <a href="{{route('terms-conditions.show', ['feature_name' => 'general'])}}">
                        <i class="la la-legal"></i>
                        <span class="menu-title">T&C For App</span></a>
                </li>
                <li class="{{ is_active_url('/terms-conditions/balance_transfer') }} nav-item">
                    <a href="{{route('terms-conditions.show', ['feature_name' => 'balance_transfer'])}}">
                        <i class="la la-legal"></i><span class="menu-title">T&C For Balance Transfer</span>
                    </a>
                </li>
            </ul>
        </li>
    @endif


    @if( auth()->user()->can_view('PrivacyPolicy') )
        <li class="{{ is_active_url('/privacy-policy') }} nav-item"><a href="{{route('privacy-policy.show')}}"><i
                    class="la la-paragraph"></i>
                <span class="menu-title">Privacy and Policy</span></a>
        </li>
    @endif


    @if( auth()->user()->can_view('AppVersion') )
        <li class="{{ is_active_url('app-version') . is_active_url('app-version/create')}}">
            <a class="menu-item" href="{{ route('app-version.index') }}" data-i18n="nav.templates.vert.classic_menu">
                <i class="la la-code-fork"></i>App Version</a>
        </li>
    @endif

    @if( auth()->user()->can_view('AppLaunch') )
        <li class="{{ is_active_url('app-launch')}}">
            <a class="menu-item" href="{{ route('app-launch.index') }}">
                <i class="ft-alert-triangle"></i>App Launch Popup</a>
        </li>
    @endif

    @if( auth()->user()->can_view('LearnPriyojon') )
        <li class=" nav-item"><a href="#"><i class="la la-gift"></i>
                <span class="menu-title">Priyojon</span></a>
            <ul class="menu-content">
                {{--page--}}
                <li class="{{ is_active_url('mybl/learn-priyojon') }}">
                    <a class="menu-item" href="{{ route('learn-priyojon.show') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-file"></i>Learn Priyojon
                    </a>
                </li>
            </ul>
        </li>
    @endif


    @if( auth()->user()->can_view('FaqCategory') || auth()->user()->can_view('FaqQuestions') )
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

    @if( auth()->user()->can_view('Ussd') )
        <li class="{{ is_active_url('ussd') }} nav-item"><a href="{{route('ussd.index')}}">
                <i class="la la-qrcode"></i>USSD Code</a>
        </li>
    @endif

    @if( auth()->user()->can_view('HelpCenter') )
        <li class="{{ is_active_url('/helpCenter') }} {{ is_active_url('helpCenter/create') }} nav-item"><a
                href="{{route('helpCenter.index')}}"><i class="la la-ambulance"></i>
                <span class="menu-title" data-i18n="nav.dash.main">Help Center</span></a>
        </li>
    @endif

    @if( auth()->user()->can_view('Setting') )
        <li class="{{ is_active_url('/setting') }} nav-item"><a href="{{route('setting.index')}}"><i
                    class="la la-cogs"></i>
                <span class="menu-title" data-i18n="nav.dash.main">Settings</span></a>
        </li>
    @endif

    @if( auth()->user()->can_view('MigratePlan'))
        <li class=" nav-item"><a href="#"><i class="la la-comment"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Deeplink Report</span></a>
            <ul class="menu-content">
                <li class="{{ is_active_url('products-deep-link-report') }}">
                    <a class="menu-item" href="{{ route('products-deep-link-report') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-comment-o"></i>Product Deeplink</a>
                </li>


            </ul>
        </li>
    @endif

    @if (Auth::user()->hasRole('developer'))
        <li class="{{ is_active_url('developer/api/debug') }}">
            <a class="menu-item" href="{{ route('mybl.api.debug') }}">
                <i class="la la-code-fork"></i>Debug Panel</a>
        </li>
    @endif


    <li class="{{ is_active_url('developer/api/debug') }}">
        <a class="menu-item" href="{{ route('support-message') }}">
            <i class="la la-code-fork"></i>Support Messages</a>
    </li>

    <!-- Agent Deep link Menu -->
    <li class=" nav-item"><a href="#"><i class="la la-users"></i>
            <span class="menu-title" data-i18n="nav.templates.main">Agent List</span></a>
        <ul class="menu-content">
            <li class=" {{is_active_url('deeplink/agent/deeplink/list')}}">
                <a class="menu-item" href="{{ route('deeplink.agent.list') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-list"></i>Agent List
                </a>
            </li>
            <li class="{{is_active_url('agent/deeplink/report')}}">
                <a class="menu-item" href="{{ route('agent.deeplink.report') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-list"></i> Report
                </a>
            </li>
        </ul>

@endif
{{--------------------------------------------------------------------------------------------------------------------}}
{{---------------------------------------------------------My-BL App End----------------------------------------------}}
{{--------------------------------------------------------------------------------------------------------------------}}
