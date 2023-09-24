{{--------------------------------------------------------------------------------------------------------------------}}
{{---------------------------------------------------------My-BL App--------------------------------------------------}}
{{--------------------------------------------------------------------------------------------------------------------}}
@if(Auth::user()->type == 'mybl')

    @if( auth()->user()->can_view('User') || auth()->user()->can_view('Role') || auth()->user()->can_view('Permissions') )

        <li class=" nav-item"><a href="#"><i class="la la-cogs"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Settings & Others</span></a>
            <ul class="menu-content">
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
                        @if( auth()->user()->can_view('AccessLog') )
                        <li class="{{ is_active_url('activity-logs')}}">
                            <a class="menu-item" href="{{ url('activity-logs') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-lock"></i> Activity Logs</a>
                        </li>
                    @endif
                    </ul>
                </li>
            </ul>

            <ul class="menu-content">
                <li class="{{ is_active_url('manage-category') }}">
                    <a class="menu-item" href="{{ route('manage-category.index') }}">
                        <i class="la la-medium"></i>Explore</a>
                </li>
            </ul>
        </li>
    @endif

    @if( auth()->user()->can_view('ShortCut') )
        <li class="{{ is_active_url('shortcuts') }} nav-item"><a href="{{route('short_cuts.index')}}"><i
                    class="la la-fighter-jet"></i>
                <span class="menu-title" data-i18n="nav.dash.main">Shortcuts</span></a>
        </li>
    @endif

    @if( auth()->user()->can_view('MyblAppMenu') )
        <li class=" {{ is_active_url('mybl-menu') }}">
            <a class="menu-item" href="{{ url('mybl-menu') }}"
            data-i18n="nav.templates.vert.classic_menu">
                <i class="la la-ellipsis-v"></i> Menu List
            </a>
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
                <li class="{{ is_active_match(route('pin-to-top.products')) }}">
                    <a class="menu-item" href="{{ route('pin-to-top.products') }}">
                        <i class="ft-list"></i>Pin To Top Products</a>
                </li>
                <li class="{{ is_active_match(route('free-product.purchase.report')) }}">
                    <a class="menu-item" href="{{ route('free-product.purchase.report') }}">
                        <i class="la la-fire"></i>Free Products Analytic</a>
                </li>

                <li class="{{ is_active_match(route('mybl.products.inactive-products')) }}">
                    <a class="menu-item" href="{{ route('mybl.products.inactive-products') }}">
                        <i class="ft-x-square"></i>Inactive Products</a>
                </li>

                <li class="{{ is_active_match(route('product-activities.history')) }}">
                    <a class="menu-item" href="{{ route('product-activities.history') }}">
                        <i class="la la-history"></i>Products Activities</a>
                </li>


                <li class="{{is_active_url('mybl-internet-offer-category')}}">
                    <a class="menu-item" href="{{ route('mybl-internet-offer-category') }} "
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-align-center"></i> Product Categories
                    </a>
                </li>

                <li class="{{ is_active_match(route('product-tags.index'))}}">
                    <a class="menu-item" href="{{ route('product-tags.index') }}">
                        <i class="ft-tag"></i>Product Tags</a>
                </li>
                <li class="{{ is_active_match(route('product.schedule'))}}">
                    <a class="menu-item" href="{{ route('product.schedule') }}">
                        <i class="la la-history"></i>Schedule Products</a>
                </li>
                <li class="{{ is_active_url('redis-key-update-view') }}">
                    <a class="menu-item" href="{{route('active-product-redis-key.update.view')}}">
                        <i class="la la-align-center"></i>Activate New Product Code</a>
                </li>
{{--                <li class="{{ is_active_url('redis-key-update-view') }} nav-item"><a href="{{route('active-product-redis-key.update.view')}}">--}}
{{--                        <span class="la la-align-center" data-i18n="nav.dash.main">Activate New Product Code</span></a>--}}
{{--                </li>--}}

                <li class="{{is_active_url('product-special-types')}}">
                    <a class="menu-item" href="{{ url('product-special-types') }} " data-i18n="nav.templates.vert.classic_menu">
                        <i class="ft-tag"></i>Product Special Types
                    </a>
                </li>
            </ul>
        </li>
    @endif

    @if( auth()->user()->can_view('MyblProductEntry') )
        <li class="{{ is_active_match(route('toffee-product.index')) }} nav-item"><a href="{{route('toffee-product.index')}}"><i
                    class="la la-list"></i>
                <span class="menu-title">Toffee</span></a>

            <ul class="menu-content">

                <li class="{{ is_active_match(route('toffee-product.index')) }}">
                    <a class="menu-item" href="{{ route('toffee-product.index') }}">
                        <i class="ft-list"></i>Toffee Products</a>
                </li>
                <li class="{{ is_active_match(route('toffee-subscription-types.index')) }}">
                    <a class="menu-item" href="{{ route('toffee-subscription-types.index') }}">
                        <i class="ft-list"></i>Subscription Types</a>
                </li>
                <li class="{{ is_active_match(route('toffee-premium-products.index')) }}">
                    <a class="menu-item" href="{{ route('toffee-premium-products.index') }}">
                        <i class="ft-list"></i>Premium Products</a>
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
    <li class="{{ is_active_url('digital-service') }}">
        <a class="menu-item" href="{{ route('digital-service.index') }}"
           data-i18n="nav.templates.vert.classic_menu">
            <i class="la la-server"></i>Digital Services
        </a>
    </li>
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
                <li class="{{ is_active_url('quick-notification') }}{{ is_active_url('quick-notification.create') }}">
                    <a class="menu-item" href="{{ route('quick-notification.index') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-comment-o"></i>Quick Notification List</a>
                </li>

                {{-- <li class="{{ is_active_url('notification') }}{{ is_active_url('notification-report') }}">
                     <a class="menu-item" href="{{ route('notification.report') }}"
                        data-i18n="nav.templates.vert.classic_menu">
                         <i class="la la-comment-o"></i>Notification Report</a>
                 </li>--}}

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


    <!-- Campaign Menu -->
    <li class=" nav-item"><a href="#"><i class="la la-bullhorn"></i>
            <span class="menu-title" data-i18n="nav.templates.main">Campaigns</span></a>
        <ul class="menu-content">
            <li class=" {{is_active_url('mybl-refer-and-earn')}}">
                <a class="menu-item" href="{{ route('mybl-refer-and-earn.index') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-list"></i> Refer And Earn
                </a>
            </li>

{{--            <li class="nav-item"><a href="#"><i class="la la-users"></i>--}}
{{--                    <span class="menu-title" data-i18n="nav.templates.main">Event Base Bonus</span></a>--}}
{{--                <ul class="menu-content">--}}
{{--                    <li class="{{ is_active_url('event-base-bonus/tasks')}}">--}}
{{--                        <a class="menu-item" href="{{ url('event-base-bonus/tasks') }}"--}}
{{--                           data-i18n="nav.templates.vert.classic_menu"><i class="la la-user"></i> Tasks</a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ is_active_url('event-base-bonus/campaigns')}}">--}}
{{--                        <a class="menu-item" href="{{ url('event-base-bonus/campaigns') }}"--}}
{{--                           data-i18n="nav.templates.vert.classic_menu"><i class="la la-user"></i> Campaign</a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ is_active_url('event-base-bonus/tasks/analytics')}}">--}}
{{--                        <a class="menu-item" href="{{ url('event-base-bonus/analytics') }}"--}}
{{--                           data-i18n="nav.templates.vert.classic_menu"><i class="la la-book"></i> Analytic</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}




        <!-- Campaign V2 Menu -->

            <li class="nav-item"><a href="#"><i class="la la-users"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Event Base Bonus</span></a>
                <ul class="menu-content">
                    <li class="{{ is_active_match('event-base-bonus/v2/tasks')}}">
                        <a class="menu-item" href="{{ url('event-base-bonus/v2/tasks') }}" data-i18n="nav.templates.vert.classic_menu"><i class="la la-cubes"></i> Tasks</a>
                    </li>
                    <li class="{{ is_active_match('event-base-bonus/v2/campaigns')}}">
                        <a class="menu-item" href="{{ url('event-base-bonus/v2/campaigns') }}" data-i18n="nav.templates.vert.classic_menu"><i class="la la-briefcase"></i> Campaign</a>
                    </li>
                    <li class="{{ is_active_match('event-base-bonus/v2/challenges')}}">
                        <a class="menu-item" href="{{ url('event-base-bonus/v2/challenges') }}" data-i18n="nav.templates.vert.classic_menu"><i class="la la-history"></i> Challenge</a>
                    </li>
                    <li class="{{ is_active_match('event-base-bonus/v2/analytics') }}">
                        <a class="menu-item" href="{{ url('event-base-bonus/v2/analytics') }}" data-i18n="nav.templates.vert.classic_menu"><i class="la la-book"></i> Analytic</a>
                    </li>
                </ul>
            </li>

            <li class="{{is_active_url('flash-hour-campaign')}}">
                <a class="menu-item" href="{{ route('flash-hour-campaign.index') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-hourglass-half"></i> Flash Hour
                </a>
            </li>

            <li class="{{is_active_url('mybl-campaign')}}">
                <a class="menu-item" href="{{ route('mybl-campaign.index') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-bullhorn"></i> Mybl Campaign
                </a>
            </li>
            <li class="{{is_active_url('cash-back-campaign')}}">
                <a class="menu-item" href="{{ route('cash-back-campaign.index') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-dollar"></i> Cash Back
                </a>
            </li>
            <li class="{{is_active_url('new-campaign-modality')}}">
                <a class="menu-item" href="{{ route('new-campaign-modality.index') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-bullhorn"></i> New Campaign Modality
                </a>
            </li>
            <li class="{{is_active_url('mybl-campaign-section')}}">
                <a class="menu-item" href="{{ route('mybl-campaign-section.index') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-bullhorn"></i> Sections
                </a>
            </li>
            <li class="{{is_active_url('mybl-campaign-winners')}}">
                <a class="menu-item" href="{{ route('mybl-campaign-winners.index') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-bullhorn"></i> Campaign Winner
                </a>
            </li>

        </ul>
    </li>
    <!-- LMS -->
    <li class="nav-item"><a href="#"><i class="la la-users"></i>
            <span class="menu-title" data-i18n="nav.templates.main">LMS</span></a>
        <ul class="menu-content">
            <li class="{{ is_active_url('lms-components') }}">
                <a class="menu-item" href="{{ route('lms-components') }}">
                    <i class="la la-puzzle-piece"></i>Home Components</a>
            </li>
            <li class="{{ is_active_url('shortcut-components') }}">
                <a class="menu-item" href="{{ route('shortcut-components') }}">
                    <i class="la la-puzzle-piece"></i>Shortcut</a>
            </li>
        </ul>
    </li>
    <!-- PGW -->
    <li class="nav-item"><a href="#"><i class="la la-users"></i>
        <span class="menu-title" data-i18n="nav.templates.main">PGW</span></a>
        <ul class="menu-content">
            <li class="{{ is_active_match('pgw-gateway')}}">
                <a class="menu-item" href="{{ url('pgw-gateway') }}" data-i18n="nav.templates.vert.classic_menu"><i class="la la-cubes"></i> PGW List</a>
            </li>
        </ul>
        <ul class="menu-content">
            <li class="{{ is_active_match('payment-gateways')}}">
                <a class="menu-item" href="{{ url('payment-gateways') }}" data-i18n="nav.templates.vert.classic_menu"><i class="la la-cubes"></i> Gateway List V2</a>
            </li>
        </ul>
    </li>

    <!-- PGW -->
    <li class="nav-item"><a href="#"><i class="la la-bullhorn"></i>
            <span class="menu-title" data-i18n="nav.templates.main">Commerce</span></a>
        <ul class="menu-content">
            <li class="{{ is_active_match('mybl-commerce-components')}}">
                <a class="menu-item" href="{{ url('mybl-commerce-components') }}" data-i18n="nav.templates.vert.classic_menu"><i class="la la-cubes"></i> Home Component</a>
            </li>
        </ul>
        <ul class="menu-content">
            <li class="{{ is_active_match('utility-bill')}}">
                <a class="menu-item" href="{{ url('utility-bill') }}" data-i18n="nav.templates.vert.classic_menu"><i class="la la-cubes"></i>Utility</a>
            </li>
        </ul>
        <ul class="menu-content">
            <li class="{{ is_active_match('commerce-navigation-rail')}}">
                <a class="menu-item" href="{{ url('commerce-navigation-rail') }}" data-i18n="nav.templates.vert.classic_menu"><i class="la la-cubes"></i>Commerce Navigation Rail</a>
            </li>
        </ul>
        <ul class="menu-content">
            <li class="{{ is_active_match('travel')}}">
                <a class="menu-item" href="{{ url('travel') }}" data-i18n="nav.templates.vert.classic_menu"><i class="la la-cubes"></i>Travel</a>
            </li>
        </ul>
    </li>

    <!-- Groups -->
    <li class="nav-item"><a href="#"><i class="la la-bullhorn"></i>
        <span class="menu-title" data-i18n="nav.templates.main">Group Components</span></a>
        <ul class="menu-content">
            <li class="{{ is_active_match('non-bl-components')}}">
                <a class="menu-item" href="{{ url('group-components') }}" data-i18n="nav.templates.vert.classic_menu"><i class="la la-cubes"></i>Show</a>
            </li>
            <li class="{{ is_active_match('non-bl-components')}}">
                <a class="menu-item" href="{{ url('group-components/create') }}" data-i18n="nav.templates.vert.classic_menu"><i class="la la-cubes"></i> Create Group</a>
            </li>
        </ul>
    </li>

    <!-- Non Bl -->
    <li class="nav-item"><a href="#"><i class="la la-bullhorn"></i>
        <span class="menu-title" data-i18n="nav.templates.main">Non Bl</span></a>
        <ul class="menu-content">
            <li class="{{ is_active_match('non-bl-components')}}">
                <a class="menu-item" href="{{ url('non-bl-components') }}" data-i18n="nav.templates.vert.classic_menu"><i class="la la-cubes"></i> Home Component</a>
            </li>
            <li class="{{ is_active_match('non-bl-offers')}}">
                <a class="menu-item" href="{{ url('non-bl-offers') }}" data-i18n="nav.templates.vert.classic_menu"><i class="la la-cubes"></i>Offer</a>
            </li>

            <li class=" {{is_active_url(route('nonbl-navigation-rail.index'))}}">
                <a class="menu-item" href="{{ route('nonbl-navigation-rail.index') }}">
                    <i class="la la-paper-plane"></i>NonBl Navigation Rail
                </a>
            </li>
        </ul>
    </li>

    <!-- FIFA WC -->
    <li class=" nav-item"><a href="#"><i class="la la-bullhorn"></i>
            <span class="menu-title" data-i18n="nav.templates.main">FIFA WC</span></a>
        <ul class="menu-content">
            <li class=" {{is_active_url('fifa-content')}}">
                <a class="menu-item" href="{{ route('fifa-content') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-users"></i> Fifa Content
                </a>
            </li>
            <li class=" {{is_active_url('teams')}}">
                <a class="menu-item" href="{{ route('teams.index') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-users"></i> Team
                </a>
            </li>
            <li class=" {{is_active_url('matches')}}">
                <a class="menu-item" href="{{ route('matches.index') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-bullhorn"></i> Match
                </a>
            </li>
            <li class=" {{is_active_url('signed-cookie')}}">
                <a class="menu-item" href="{{ route('signed-cookie') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-bullhorn"></i> Generate Signed Cookie
                </a>
            </li>
            <li class=" {{is_active_url('fifa-deeplink')}}">
                <a class="menu-item" href="{{ route('fifa-deeplink') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-bullhorn"></i> Deeplink
                </a>
            </li>
        </ul>
    </li>

    <li class="{{ is_active_url('gamification') . is_active_url('gamification')}}">
        <a class="menu-item" href="{{ route('gamification.index') }} "
           data-i18n="nav.templates.vert.classic_menu">
            <i class="la la-gamepad"></i>Gamification
        </a>
    </li>

    <!-- Loyalty Partner Menu -->
    @if( auth()->user()->can_view('LoyaltyPartnerImage') || auth()->user()->can_view('LoyaltyPartnerImage') )
    <li class=" nav-item"><a href="#"><i class="la la-bullhorn"></i>
            <span class="menu-title" data-i18n="nav.templates.main">Loyalty Partner</span></a>
        <ul class="menu-content">
            <li class=" {{is_active_url('loyalty-partner-image')}}{{is_active_url('loyalty-partner-image/create')}}{{is_active_url('loyalty-partner-image/*/edit')}}">
                <a class="menu-item" href="{{ route('loyalty-partner-image.index') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-list"></i> Partner Image
                </a>
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
                <li class="{{ is_active_match('generic-slider')}}">
                    <a class="menu-item" href="{{ url('generic-slider') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-sliders"></i>Generic Slider</a>
                <li class="@if(is_active_match('generic-shortcut-master')) {{ is_active_match('generic-shortcut-master') }} @else {{ is_active_match('generic-shortcut') }}  @endif">
                    <a class="menu-item" href="{{ route('generic-shortcut-master.index') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-sliders"></i>Generic Shortcut</a>
                </li>
                <li class="{{ is_active_match('generic-carousel')}}">
                    <a class="menu-item" href="{{ url('generic-carousel') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-sliders"></i>Generic Carousel</a>
                </li>
                <li class="{{ is_active_url('mybl-slider/base-msisdn-list'). is_active_url('mybl-slider/base-msisdn-create')}}">
                    <a class="menu-item" href="{{ route('myblslider.baseMsisdnList.index') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-sliders"></i>Base MSISDN</a>
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

                <li class="{{ is_active_url('banner-analytic')}}">
                    <a class="menu-item" href="{{ route('banner-analytic.index') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-external-link-square"></i>Banner Analytics</a>
                </li>
                <li class="{{ is_active_url('welcome-banner') . is_active_url('welcome-banner/create')}}">
                    <a class="menu-item" href="{{ route('welcome-banner.index') }}" data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-image"></i>My-BL Welcome Banner</a>
                </li>
                <li class="{{is_active_url('popup-banner')}}">
                    <a class="menu-item" href="{{ route('popup-banner.index') }} "
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-list"></i> Popup Banner
                    </a>
                </li>
                <li class="{{is_active_url('free-product-disburse')}}">
                    <a class="menu-item" href="{{ route('free-product-disburse') }} "
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-list"></i> Free Product Disburse
                    </a>
                </li>
                <li class="{{is_active_url('free-product-disburse-report-view')}}">
                    <a class="menu-item" href="{{ route('free-product-disburse-report') }} "
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-list"></i> Free Product Disburse Report
                    </a>
                </li>
                <li class="{{ is_active_url('mybl-home-components') }}">
                    <a class="menu-item" href="{{ route('mybl.home.components') }}">
                        <i class="la la-puzzle-piece"></i>Home Components</a>
                </li>
                <li class="{{ is_active_url('content-components') }}">
                    <a class="menu-item" href="{{ route('content-components') }}">
                        <i class="la la-puzzle-piece"></i>Content Components</a>
                </li>
                <li class=" {{is_active_url(route('health-hub.index'))}}">
                    <a class="menu-item" href="{{ route('health-hub.index') }} "
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-heart"></i>Health Hub
                    </a>
                </li>
                <li class=" {{is_active_url(route('heme-navigation-rail.index'))}}">
                    <a class="menu-item" href="{{ route('heme-navigation-rail.index') }}">
                        <i class="la la-paper-plane"></i>Home Navigation Rail
                    </a>
                </li>
                <li class=" {{is_active_url(route('content-navigation-rail.index'))}}">
                    <a class="menu-item" href="{{ route('content-navigation-rail.index') }}">
                        <i class="la la-paper-plane"></i>Content Navigation Rail
                    </a>
                </li>
                <li class=" {{is_active_url(route('popup-sequence.index'))}}">
                    <a class="menu-item" href="{{ route('popup-sequence.index') }}">
                        <i class="la la-paper-plane"></i>Popup Sequence
                    </a>
                </li>
            </ul>
        </li>
    @endif

    <li class="{{ is_active_url('content-deeplink') }} nav-item"><a href="{{route('content-deeplink.index')}}"><i
                class="la la-fighter-jet"></i>
            <span class="menu-title" data-i18n="nav.dash.main">Content & Course Deeplink</span></a>
    </li>
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
                    <a class="menu-item" href="{{ route('smsOffer.index') }}"
                       data-i18n="nav.templates.vert.classic_menu">
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
                    <a class="menu-item" href="{{ route('amarOffer.index') }}"
                       data-i18n="nav.templates.vert.classic_menu">
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

                <li class="{{is_active_url('special-pack/filter/create')}}">
                    <a class="menu-item" href="{{ route('special-pack.filter.create') }} "
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="ft-phone-call"></i> Special call rate Filter
                    </a>
                </li>
                <li class="{{ is_active_url('internetOffer')}} {{is_active_url('recharge-pack/filter/create')}}">
                    <a class="menu-item" href="{{ route('recharge-pack.filter.create') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-globe"></i> Recharge Offer</a>
                </li>
            </ul>
        </li>
    @endif


    @if( auth()->user()->can_view('Otp') )
        <li class=" nav-item"><a href="#"><i class="la la-cogs"></i>
                <span class="menu-title">Config</span></a>
            <ul class="menu-content">
                <li class="{{ is_active_url('otp-config') . is_active_url('otp-config/create')}}">
                    <a class="menu-item" href="{{ route('otp-config.index') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-cog"></i>OTP Config</a>
                </li>

                <li class="{{ is_active_url('sms-languages') . is_active_url('sms-languages/create') . is_active_route('sms-languages.edit')}}">
                    <a class="menu-item" href="{{ route('sms-languages.index') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-cog"></i>SMS Language Config</a>
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
                        <i class="la la-legal"></i><span class="menu-title">Balance Transfer</span>
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
                <li class="{{ is_active_url(route('products-deep-link-report')) }}">
                    <a class="menu-item" href="{{ route('products-deep-link-report') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-comment-o"></i>Product Deeplink</a>
                </li>

                <li class="{{ is_active_url('deeplink-analytic') }}">
                    <a class="menu-item" href="{{ url('deeplink-analytic') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-comment-o"></i>Deeplink Analytic</a>
                </li>
            </ul>
        </li>
    @endif

    @if (Auth::user()->hasRole('developer'))
        <li class=" nav-item"><a href="#"><i class="la la-comment"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Debug Panel</span></a>
            <ul class="menu-content">
                <li class="{{ is_active_url('developer/api/debug') }}">
                    <a class="menu-item" href="{{ route('mybl.api.debug') }}">
                        <i class="la la-code-fork"></i> BL Msisdn Log</a>
                </li>

                <li class="{{ is_active_url(route('guest-user-track-list')) }}">
                    <a class="menu-item" href="{{ route('guest-user-track-list') }}">
                        <i class="la la-code-fork"></i> Guest User Log</a>
                </li>
            </ul>
        </li>
    @endif

    <li class="{{ is_active_url(route('support-message')) }}">
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
    </li>

    <!-- Others Menu -->
    <li class=" nav-item"><a href="#"><i class="la la-adjust"></i>
            <span class="menu-title" data-i18n="nav.templates.main">Others</span></a>
        <ul class="menu-content">
            <li class=" nav-item"><a href="#"><i class="la la-adjust"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">USIM Eligibility</span></a>
                <ul class="menu-content">
                    <li class=" {{is_active_url('usim-eligibility')}}">
                        <a class="menu-item" href="{{ route('usim-eligibility.index') }} "
                           data-i18n="nav.templates.vert.classic_menu">
                            <i class="la la-simplybuilt"></i>Landing Page
                        </a>
                    </li>
                    <li class=" {{is_active_url('usim-eligibility-massage')}}">
                        <a class="menu-item" href="{{ route('usim-eligibility.show.massage') }} "
                           data-i18n="nav.templates.vert.classic_menu">
                            <i class="la la-file-text"></i>Eligibility Massage
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>

    <!-- Transaction Status Report Menu -->
    <li class=" nav-item"><a href="#"><i class="la la-list"></i>
            <span class="menu-title" data-i18n="nav.templates.main">Transaction Report</span></a>
        <ul class="menu-content">
            <li class="{{is_active_url('mybl/course-transaction-status-report-view')}}">
                <a class="menu-item" href="{{ route('mybl.transaction-status.course') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-list"></i>Course Transaction
                </a>
            </li>
            <li class="{{is_active_url('mybl/music-transaction-status-report-view')}}">
                <a class="menu-item" href="{{ route('mybl.transaction-status.music') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-list"></i>Music Transaction
                </a>
            </li>
            <li class="{{is_active_url('mybl/sharetrip-transaction-status-report-view')}}">
                <a class="menu-item" href="{{ route('mybl.transaction-status.sharetrip') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-list"></i>ShareTrip Transaction
                </a>
            </li>
            <li class="{{is_active_url('commerce-bill-status-view')}}">
                <a class="menu-item" href="{{ route('commerce-bill-status-view') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-list"></i>Commerce Bill Status
                </a>
            </li>
            <li class="{{is_active_url('mybl/doctime-transaction-status-report-view')}}">
                <a class="menu-item" href="{{ route('mybl.transaction-status.doctime') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-list"></i>DocTime Transaction
                </a>
            </li>
        </ul>
    </li>

    <!-- Gift -->
    <li class=" nav-item"><a href="#"><i class="la la-list"></i>
            <span class="menu-title" data-i18n="nav.templates.main">Gift</span></a>
        <ul class="menu-content">
            <li class="{{is_active_url('internet-gift-content')}}">
                <a class="menu-item" href="{{ url('internet-gift-content') }} "
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-list"></i>Internet Gift Content
                </a>
            </li>
        </ul>
    </li>

@endif

<li class="{{ is_active_url('developer/api/debug') }}">
    <a class="menu-item" href="{{ route('support-message') }}">
        <i class="la la-code-fork"></i>Support Messages</a>
</li>
{{--------------------------------------------------------------------------------------------------------------------}}
{{---------------------------------------------------------My-BL App End----------------------------------------------}}
{{--------------------------------------------------------------------------------------------------------------------}}
