{{--------------------------------------------------------------------------------------------------------------------}}
{{---------------------------------------------------------Asset Lite-------------------------------------------------}}
{{--------------------------------------------------------------------------------------------------------------------}}
@if(Auth::user()->type == 'assetlite')
    <li class="nav-item">
        <a href="#">
            <i class="la la la-cogs"></i><span class="menu-title"
                                               data-i18n="nav.templates.main">Settings & Others</span>
        </a>
        <ul class="menu-content">

            @if( auth()->user()->can_view('Config') )
                <li class="{{ is_active_url('/config') }} nav-item"><a href="{{ url('config')}}"><i
                            class="la la-cogs"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">General Setup</span></a>
                </li>
            @endif

            @if( auth()->user()->can_view('User') || auth()->user()->can_view('Role') || auth()->user()->can_view('Permissions') )
                <li class="nav-item">
                    <a href="#"><i class="la la-users"></i>
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


            <li class="nav-item">
                <a href="#"><i class="la la-align-justify"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Menu & Quick-launch</span></a>
                <ul class="menu-content">
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
                        <li class="{{ is_active_url('/sub-footer') }} nav-item"><a href="{{ url('sub-footer') }}"><i
                                    class="la la-futbol-o"></i>
                                <span class="menu-title" data-i18n="nav.templates.main">Sub Footer</span></a>
                        </li>
                    @endif

                    @if( auth()->user()->can_view('QuickLaunch') )
                        <li class="{{ is_active_url('quick-launch/panel') }} nav-item"><a
                                href="{{ url('quick-launch/panel') }}"><i
                                    class="la la-automobile"></i>
                                <span class="menu-title" data-i18n="nav.templates.main">Quick launch Panel</span></a>
                        </li>

                        <li class="{{ is_active_url('quick-launch/button') }} nav-item"><a
                                href="{{ url('quick-launch/button') }}"><i
                                    class="la la-automobile"></i>
                                <span class="menu-title" data-i18n="nav.templates.main">Quick launch Button</span></a>
                        </li>
                    @endif
                </ul>
            </li>
            <li class="{{ is_active_url('tag-category') }}">
                <a class="menu-item" href="{{ url('tag-category') }}" data-i18n="nav.templates.vert.classic_menu"><i
                        class="la la-tags"></i> Tag</a>
            </li>


            <li class="{{ is_active_match(route('dynamic-url-redirection.index')) }}">
                <a class="menu-item" href="{{ route('dynamic-url-redirection.index') }}"
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-tags"></i>URL Redirection</a>
            </li>
        </ul>
    </li>


    @if( auth()->user()->can_view('Product') || auth()->user()->can_view('Product-core'))
        <li class="nav-item">
            <a href="#"><i class="la la-gift"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Product Management</span></a>
            <ul class="menu-content">

            <!--                <li class="{{ is_active_url('sim-categories') }}">
                    <a class="menu-item" href="{{ route('sim-categories.index') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-file"></i> Package</a>
                </li>-->

                <li class="{{ is_active_url('offer-categories') }}">
                    <a class="menu-item" href="{{ route('offer-categories.index') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-phone-square"></i>SIM & Offer

                    </a>
                </li>

                <li class="{{ is_active_url('duration-categories') }}">
                    <a class="menu-item" href="{{ route('duration-categories.index') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-calendar-times-o"></i> Duration

                    </a>
                </li>

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
                <li class="{{is_active_url('al-internet-offer-category')}}">
                    <a class="menu-item" href="{{ route('al-internet-offer-category') }} "
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-align-center"></i> Product Categories
                    </a>
                </li>
                <li class="{{is_active_url('excel.upload')}}">
                    <a class="menu-item" href="{{ route('excel.upload') }} "
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-align-center"></i>Category sync with Product
                    </a>
                </li>
                <li class="{{ is_active_url('product-price/slabs') }}">
                    <a class="menu-item" href="{{ url('product-price/slabs') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-magic"></i> Product Price Slab</a>
                </li>

                <li class="nav-item"><a href="#"><i class="la la-briefcase"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">Roaming</span></a>
                    <ul class="menu-content">

                        <li class="{{ is_active_url('roaming-general') }}">
                            <a class="menu-item" href="{{ url('roaming-general') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-caret-right"></i>Category & Pages</a>
                        </li>
                        <li class="{{ is_active_url('roaming-offers') }}">
                            <a class="menu-item" href="{{ url('roaming-offers') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-caret-right"></i> Offers</a>
                        </li>


                        <li class="{{ is_active_url('roaming-info-tips') }}">
                            <a class="menu-item" href="{{ url('roaming-info-tips') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-caret-right"></i> Info & Tips</a>
                        </li>


                        <li class="{{ is_active_url('roaming/operators') }}">
                            <a class="menu-item" href="{{ url('roaming/operators') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-caret-right"></i> Roaming Operators</a>
                        </li>

                        <li class="{{ is_active_url('roaming/bundle') }}">
                            <a class="menu-item" href="{{ url('roaming/bundle') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-caret-right"></i> Roaming Bundle</a>
                        </li>

                        <li class="{{ is_active_url('roaming/rates') }}">
                            <a class="menu-item" href="{{ url('roaming/rates') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-caret-right"></i> Roaming Rates</a>
                        </li>

                    </ul>
                </li>

                @if( auth()->user()->can_view('Product-core') )
                    <li class="{{ is_active_url('product-core') . is_active_url('product-core') }}">
                        <a class="menu-item" href="{{ route('product.core.list') }}"
                           data-i18n="nav.templates.vert.classic_menu"><i
                                class="la la-magic"></i> Core Products</a>
                    </li>
                @endif

                <li class="{{ is_active_url('amaroffer/details') . is_active_url('amaroffer/create') }}">
                    <a class="menu-item" href="{{ route('amaroffer.list') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-magic"></i> Amar Offer Details</a>
                </li>

                <li class="{{ is_active_url('/device-offer') }} nav-item">
                    <a href="{{ url('device-offer') }}">
                        <i class="la la-credit-card"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">Device Offers</span>
                    </a>
                </li>

            </ul>
        </li>
    @endif

    @if( auth()->user()->can_view('BusinessGeneral') ||
         auth()->user()->can_view('BusinessPackage') ||
         auth()->user()->can_view('BusinessInternet') ||
         auth()->user()->can_view('BusinessOthers')
        )
        <li class="nav-item">
            <a href="#"><i class="la la-briefcase"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Business</span></a>
            <ul class="menu-content">
                <li class="{{ is_active_url('business-general') }}">
                    <a class="menu-item" href="{{ url('business-general') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-caret-right"></i>Home & General Setup</a>
                </li>
                <li class="{{ is_active_url('business-package') }}">
                    <a class="menu-item" href="{{ url('business-package') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-caret-right"></i> Package</a>
                </li>

                <li class="{{ is_active_url('business-internet') }}">
                    <a class="menu-item" href="{{ url('business-internet') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-caret-right"></i> Internet</a>
                </li>

                <li class="{{ is_active_url('business-other-services') }}">
                    <a class="menu-item" href="{{ route('business.other.services') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-caret-right"></i> Enterprise Solution</a>
                </li>

            </ul>
        </li>
    @endif

    @if( auth()->user()->can_view('AppServiceTab') ||
         auth()->user()->can_view('AppServiceCategory') ||
         auth()->user()->can_view('AppServiceVendorApi') ||
         auth()->user()->can_view('AppServiceProduct') ||
         auth()->user()->can_view('EasyPaymentCard')
       )
        <li class="nav-item">
            <a href="#"><i class="la la-apple"></i>
                <span class="menu-title" data-i18n="nav.templates.main">App & Service</span></a>
            <ul class="menu-content">

                <li class="{{ is_active_url('app-service/tabs') }}">
                    <a class="menu-item" href="{{ route('tabs.index') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-caret-right"></i> App & Service Tab</a>
                </li>

                <li class="{{ is_active_url('app-service/category') }}">
                    <a class="menu-item" href="{{ route('category.index') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-caret-right"></i> App & Service Category</a>
                </li>

                <li class="{{ is_active_url('app-service/vendor-api') }}">
                    <a class="menu-item" href="{{ route('vendor-api.index') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-caret-right"></i> Vendor API</a>
                </li>

                <li class="{{ is_active_url('app-service-product') }}">
                    <a class="menu-item" href="{{ route('app-service-product.index') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-caret-right"></i> App Service Products</a>
                </li>

                <li class="{{ is_active_url('/easy-payment-card') }} nav-item">
                    <a href="{{ url('easy-payment-card') }}">
                        <i class="la la-credit-card"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">Easy Payment Card</span>
                    </a>
                </li>

                <li class="{{ is_active_url('referral-list') }} nav-item">
                    <a href="{{ url('referral-list') }}">
                        <i class="la la-credit-card"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">Referral List</span>
                    </a>
                </li>
            </ul>
        </li>
    @endif



    @if( auth()->user()->can_view('Partner') )
        <li class="nav-item">
            <a href="#"><i class="la la-gift"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Loyalty</span></a>
            <ul class="menu-content">
                <li class="{{ is_active_url('lms-offer-category') . is_active_url('lms-offer-category/create')}}">
                    <a class="menu-item" href="{{ url('lms-offer-category') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-magic"></i> LMS Offer Categories</a>
                </li>

                <li class="{{ is_active_url('loyalty/tier') . is_active_url('lms-offer-category/create')}}">
                    <a class="menu-item" href="{{ url('loyalty/tier') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i class="la la-magic"></i> LMS Tier</a>
                </li>

                <li class="{{ is_active_url('partners') . is_active_url('partners/create')}}">
                    <a class="menu-item" href="{{ url('partners') }}" data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-magic"></i> Partner and Offers</a>
                </li>

                <li class="{{ is_active_url('/priyojon') }} nav-item"><a href="{{ url('priyojon') }}"><i
                            class="la la-futbol-o"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">Priyojon Landing</span></a>
                </li>

                <li class="{{ is_active_url('about-page/priyojon') }}">
                    <a class="menu-item" href="{{ url('about-page/priyojon') }}"
                       data-i18n="nav.templates.vert.classic_menu">
                        <i class="la la-exclamation-circle"></i>About Priyojon
                    </a>
                </li>
{{--                <li class="{{ is_active_url('lms-about-page/banner-image') }}">--}}
{{--                    <a class="menu-item" href="{{ url('lms-about-page/banner-image') }}"--}}
{{--                       data-i18n="nav.templates.vert.classic_menu">--}}
{{--                        <i class="la la-exclamation-circle"></i>About Page Banner--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="{{ is_active_url('about-page/reward_points')}}">--}}
{{--                    <a class="menu-item" href="{{ url('about-page/reward_points') }}"--}}
{{--                       data-i18n="nav.templates.vert.classic_menu">--}}
{{--                        <i class="la la-exclamation-circle"></i> About Reward Point</a>--}}
{{--                </li>--}}

            </ul>
        </li>

    @endif

    <!-- // eCarrer portal -->
    @if( auth()->user()->can_view('Ecareer', 'generalIndex'))
        <li class="nav-item">
            <a href="#"><i class="la la-bell"></i>
                <span class="menu-title" data-i18n="nav.templates.main">eCareer</span></a>
            <ul class="menu-content">

                {{-- <li class="{{ request()->is('life-at-banglalink/topbanner*') ? 'active' : '' }}">
                    <a class="menu-item" href="{{ route('life.at.banglalink.topbanner') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-cogs"></i> Sections</a>
                </li> --}}

                <li class="{{ request()->is('life-at-banglalink/general*') ? 'active' : '' }}">
                    <a class="menu-item" href="{{ route('product.core.list') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i class="la la-motorcycle"></i> Life at
                        Banglalink</a>
                    <ul class="menu-content">
                        <li class="{{ request()->is('life-at-banglalink/general*') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('life.at.banglalink.general') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-safari"></i> General</a>
                        </li>
                        <li class="{{ request()->is('life-at-banglalink/teams*') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('life.at.banglalink.teams') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-safari"></i> Teams</a>
                        </li>
                        <li class="{{ request()->is('life-at-banglalink/diversity*') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('life.at.banglalink.diversity') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-safari"></i> Diversity</a>
                        </li>
                        <li class="{{ request()->is('life-at-banglalink/events*') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('life.at.banglalink.events') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-safari"></i> Events and Activites</a>
                        </li>

                    </ul>
                </li>
                <li class="{{ is_active_url('programs/progeneral') .' '. is_active_url('programs/progeneral/create') }}">
                    <a class="menu-item" href="#"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-car"></i> Programs</a>
                    <ul class="menu-content">
                        {{-- <li class="{{ request()->is('programs/tab-title*') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('programs.tab.title') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-safari"></i> Tab Title</a>
                        </li> --}}
                        <li class="{{ request()->is('programs/progeneral/news_section*') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('programs.progeneral', ['type' => 'news_section']) }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-safari"></i> Hero section</a>
                        </li>
                        <li class="{{ request()->is('programs/progeneral/steps*') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('programs.progeneral', ['type' => 'steps']) }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-safari"></i> Steps section</a>
                        </li>
                        <li class="{{ request()->is('programs/progeneral/video*') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('programs.progeneral', ['type' => 'video']) }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-safari"></i> Video section</a>
                        </li>
                        {{-- <li class="{{ request()->is('programs/progeneral/events*') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('programs.progeneral', ['type' => 'events']) }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-safari"></i> Events section</a>
                        </li>
                        <li class="{{ request()->is('programs/progeneral/testimonial*') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('programs.progeneral', ['type' => 'testimonial']) }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-safari"></i> Testimonial section</a>
                        </li> --}}

                        <li class="{{ request()->is('programs/proiconbox*') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('programs.proiconbox') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-safari"></i> Box Icon Section</a>
                        </li>
                        <li class="{{ request()->is('programs/photogallery*') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('programs.photogallery') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-safari"></i> Photo Gallery</a>
                        </li>
                        <li class="{{ request()->is('programs/sapbatches*') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('programs.sapbatches') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-safari"></i> SAP Previous Batches</a>
                        </li>
                        <li class="{{ request()->is('programs/ennovatorbatches*') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('programs.ennovatorbatches') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-safari"></i> Ennovators Previous Batches</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ is_active_url('vacancy/pioneer') .' '. is_active_url('vacancy/pioneer') }}">
                    <a class="menu-item" href="#"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-beer"></i> Vacancy</a>

                    <ul class="menu-content">
                        <li class="{{ request()->is('vacancy/pioneer*') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('vacancy.pioneer') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-safari"></i> General</a>
                        </li>
                        <li class="{{ request()->is('vacancy/viconbox*') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('vacancy.viconbox') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i
                                    class="la la-safari"></i> Box Icon Section</a>
                        </li>

                    </ul>
                </li>
                <li class="{{ request()->is('life-at-banglalink/contact*') ? 'active' : '' }}">
                    <a class="menu-item" href="{{ route('life.at.banglalink.contact') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-magic"></i> Contact & Connect us</a>
                </li>

                <li class="{{ request()->is('university') ? 'active' : '' }}">
                    <a class="menu-item" href="{{ route('university.index') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-university"></i> University Uploader</a>
                </li>

            </ul>
        </li>
    @endif






    <li class="nav-item">
        <a href="#"><i class="la la-lemon-o"></i>
            <span class="menu-title" data-i18n="nav.templates.main">Other Modules</span></a>
        <ul class="menu-content">
            @if( auth()->user()->can_view('Slider', 'singleSlider') || auth()->user()->can_view('Slider', 'multiSlider') )
                <li class="nav-item"><a href="#"><i class="la la-sliders"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">Home Page</span></a>
                    <ul class="menu-content">
                        @if( auth()->user()->can_view('Slider', 'singleSlider') )
                            <li class="{{ is_active_url('single-sliders') . is_active_url('sliders/create')}}">
                                <a class="menu-item" href="{{ url('single-sliders') }}"
                                   data-i18n="nav.templates.vert.classic_menu"><i class="la la-file-image-o"></i> Single
                                    slider</a>
                            </li>
                        @endif

                        @if(  auth()->user()->can_view('Slider', 'multiSlider') )
                            <li class="{{ is_active_url('multiple-sliders') . is_active_url('sliders/create')}}">
                                <a class="menu-item" href="{{ url('multiple-sliders/') }}"
                                   data-i18n="nav.templates.vert.classic_menu"><i class="la la-file-image-o"></i>
                                    Multiple
                                    slider</a>
                            </li>
                        @endif

                        {{--                        @if( auth()->user()->can_view('home-page/component') )--}}
                        <li class="{{ is_active_url('home-page/component') }}">
                            <a class="menu-item" href="{{ url('home-page/component') }}"
                               data-i18n="nav.templates.vert.classic_menu">
                                <i class="la la-file-image-o"></i> Home Component
                            </a>
                        </li>
                        {{--                        @endif           --}}

                        <li class="{{ is_active_url('store-locations/entry') }}">
                            <a class="menu-item" href="{{ url('store-locations/entry') }}"
                               data-i18n="nav.templates.vert.classic_menu">
                                <i class="la la-file-image-o"></i> Store Locations
                            </a>
                        </li>

                    </ul>
                </li>
            @endif

            @if( auth()->user()->can_view('AboutUs') )
                <li class="nav-item"><a href="#"><i class="la la-align-justify"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">About Us</span></a>
                    <ul class="menu-content">
                        <li class="{{ is_active_url('about-us') . is_active_url('about-us/create') }}">
                            <a class="menu-item" href="{{ url('about-us') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i class="la la-align-right"></i>About
                                Banglalink</a>
                        </li>

                        <li class="{{ is_active_url('management') . is_active_url('management/create') }}">
                            <a class="menu-item" href="{{ url('management') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i class="la la-align-right"></i> Management</a>
                        </li>

                        <li class="{{ is_active_url('about/career') }}">
                            <a class="menu-item" href="{{ route('about-career.index') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i class="la la-align-right"></i> About
                                Career</a>
                        </li>

                        <li class="{{ is_active_url('about-slider') }}">
                            <a class="menu-item" href="{{ url('about-slider') }}"
                               data-i18n="nav.templates.vert.classic_menu"><i class="la la-align-right"></i>About Slider</a>
                        </li>
                    </ul>
                </li>
            @endif

            {{--            @if( auth()->user()->can_view('FixedPage') )--}}
            <li class="{{ is_active_url('fixed-pages') }}">
                <a class="menu-item" href="{{ url('fixed-pages') }}"
                   data-i18n="nav.templates.vert.classic_menu">
                    <i class="la la-file-image-o"></i> Fixed Page
                </a>
            </li>
            {{--            @endif--}}

            <li class="{{ is_active_url('/dynamic-pages') }} nav-item"><a href="{{ url('/dynamic-pages') }}"><i
                        class="la la-futbol-o"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Dynamic Pages</span></a>
            </li>
            <li class="{{ is_active_url('/popular-search') }} nav-item">
                <a href="{{ url('popular-search') }}">
                    <i class="la la-search"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Search</span>
                </a>
            </li>
            <li class="{{ is_active_url('/faq-categories') }} nav-item"><a href="{{ url('/faq-categories') }}"><i
                        class="la la-question"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Faq</span></a>
            </li>

            <li class="{{ is_active_url('/ethics-compliance') }} nav-item">
                <a href="{{ url('ethics-compliance') }}">
                    <i class="la la-caret-right"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Ethics & Compliance</span>
                </a>
            </li>

            <li class="nav-item"><a href="#"><i class="la la-lemon-o"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Media</span></a>
                <ul class="menu-content">
                    <li class="{{ is_active_url('/press-news-event') }} nav-item">
                        <a href="{{ url('/press-news-event') }}"><i class="la la-futbol-o"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">Press News Event</span>
                        </a>
                    </li>
                    <li class="{{ is_active_url('/tvc-video') }} nav-item">
                        <a href="{{ url('/tvc-video') }}"><i class="la la-futbol-o"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">TVC Video</span>
                        </a>
                    </li>

                    <li class="{{ is_active_url('/landing-page-component') }} nav-item">
                        <a href="{{ url('/landing-page-component') }}"><i class="la la-futbol-o"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">Landing Page</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href="#"><i class="la la-bold"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Blog</span></a>
                <ul class="menu-content">
                    <li class="{{ is_active_url('blog-categories') . is_active_url('blog-categories/create') }} }} nav-item">
                        <a href="{{ url('blog-categories') }}"><i class="la la-send"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">Post Categories</span>
                        </a>
                    </li>
                    <li class="{{ is_active_url('blog-post') . is_active_url('blog-post/create') }} }} nav-item">
                        <a href="{{ url('blog-post') }}"><i class="la la-send"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">Post List</span>
                        </a>
                    </li>
{{--                    <li class="{{ is_active_url('/tvc-video') }} nav-item">--}}
{{--                        <a href="{{ url('/tvc-video') }}"><i class="la la-futbol-o"></i>--}}
{{--                            <span class="menu-title" data-i18n="nav.templates.main">TVC Video</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                    <li class="{{ is_active_url('blog/landing-page-component') . is_active_url('blog/landing-page-component/create') }} nav-item">
                        <a href="{{ url('blog/landing-page-component') }}"><i class="la la-futbol-o"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">Landing Page</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href="#"><i class="la la-star-half-full"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Customer Feedback</span></a>
                <ul class="menu-content">
                    <li class="{{ is_active_url('customer-feedback/questions') }}">
                        <a class="menu-item" href="{{ url('customer-feedback/questions') }}"
                           data-i18n="nav.templates.vert.classic_menu"><i
                                class="la la-list"></i> Questions</a>
                    </li>
                    <li class="{{ is_active_url('customer-feedbacks/list') }}">
                        <a class="menu-item" href="{{ url('customer-feedback/list') }}"
                           data-i18n="nav.templates.vert.classic_menu"><i
                                class="la la-feed"></i> Feedbacks List</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href="#"><i class="la la-signal"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Banglalink 4G</span></a>
                <ul class="menu-content">
                    <li class="{{ is_active_url('/bl-4g-campaign') }} nav-item">
                        <a href="{{ url('/bl-4g-campaign') }}"><i class="la la-bullhorn"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">4G Campaign</span>
                        </a>
                    </li>

                    <li class="{{ is_active_url('/bl-4g-device-tag') }} nav-item">
                        <a href="{{ url('bl-4g-device-tag') }}"><i class="la la-mobile-phone"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">4G Devices Tags</span>
                        </a>
                    </li>

                    <li class="{{ is_active_url('/bl-4g-devices') }} nav-item">
                        <a href="{{ url('bl-4g-devices') }}"><i class="la la-mobile-phone"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">4G Devices</span>
                        </a>
                    </li>

                    <li class="{{ is_active_url('/bl-4g-landing-page') }} nav-item">
                        <a href="{{ url('/bl-4g-landing-page') }}"><i class="la la-futbol-o"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">4G Landing Page</span>
                        </a>
                    </li>

                    <li class="{{ is_active_url('/bl-4g-eligibility-msg') }} nav-item">
                        <a href="{{ url('/bl-4g-eligibility-msg') }}"><i class="la la-futbol-o"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">4G Eligibility Message</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href="#"><i class="la la-signal"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Banglalink 3G</span></a>
                <ul class="menu-content">
                    <li class="{{ is_active_url('/bl-3g-landing-page') }} nav-item">
                        <a href="{{ url('/bl-3g-landing-page') }}"><i class="la la-futbol-o"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">3G Landing Page</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ is_active_url('/be-a-partner') }} nav-item"><a href="{{ url('/be-a-partner') }}">
                    <i class="la la-paragraph"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Be A Partner</span></a>
            </li>
            <li class="{{ is_active_url('/explore-c') }} nav-item"><a href="{{ url('/explore-c') }}">
                    <i class="la la-paragraph"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Explore C's</span></a>
            </li>
        </ul>
    </li>

    @if( auth()->user()->can_view('LeadManagement') )
        <li class="nav-item"><a href="#"><i class="la la-briefcase"></i>
                <span class="menu-title" data-i18n="nav.templates.main">B2B Leads</span></a>
            <ul class="menu-content">
                <li class="{{ is_active_url('lead-product-permission') }}">
                    <a class="menu-item" href="{{ url('lead-product-permission') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-list"></i> Product Permission</a>
                </li>
                <li class="{{ is_active_url('lead-requested-list') }}">
                    <a class="menu-item" href="{{ route('lead-list') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-list"></i> Lead Data List</a>
                </li>
            </ul>
        </li>
    @endif

    @if( auth()->user()->can_view('CorporateRespSection') )
        <li class="nav-item"><a href="#"><i class="la la-briefcase"></i>
                <span class="menu-title" data-i18n="nav.templates.main">Corporate Responsibility</span></a>
            <ul class="menu-content">
                <li class="{{ is_active_url('corporate-resp-section') }}">
                    <a class="menu-item" href="{{ url('corporate-resp-section') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-list"></i>Section</a>
                </li>
                <li class="{{ is_active_url(route('cr-strategy-section.index')) }}">
                    <a class="menu-item" href="{{ route('cr-strategy-section.index') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-list"></i> CR Strategy</a>
                </li>
                <li class="{{ is_active_url(route('initiative-tab.index')) }}">
                    <a class="menu-item" href="{{ route('initiative-tab.index') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-list"></i> Initiative</a>
                </li>

                <li class="{{ is_active_url(route('case-study-section.index')) }}">
                    <a class="menu-item" href="{{ route('case-study-section.index') }}"
                       data-i18n="nav.templates.vert.classic_menu"><i
                            class="la la-list"></i> Case Study and Report</a>
                </li>

                <li class="nav-item"><a href="#"><i class="la la-book"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">Contact Us</span></a>
                    <ul class="menu-content">
                        <li class="{{ is_active_url(route('contact-us-page-info.index')) }} nav-item">
                            <a href="{{ route('contact-us-page-info.index') }}"><i class="la la-pagelines"></i>
                                <span class="menu-title" data-i18n="nav.templates.main">Page Content</span>
                            </a>
                        </li>
                        <li class="{{ is_active_url(route('contact-us-info.list')) }} nav-item">
                            <a href="{{ route('contact-us-info.list') }}"><i class="la la-book"></i>
                                <span class="menu-title" data-i18n="nav.templates.main">Customer Contact Info</span>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </li>
    @endif


    {{--    @if( auth()->user()->can_view('LeadManagement') )--}}
    <li class="{{ is_active_url(route('dynamic-routes.index')) }}">
        <a class="menu-item" href="{{ route('dynamic-routes.index') }}"
           data-i18n="nav.templates.vert.classic_menu"><i
                class="la la-list"></i> Dynamic Routes</a>
    </li>
    {{--    @endif--}}


    <hr>
    <hr>
    <hr>








    {{--        TODO:: Quiz Management using 3nd priority  --}}
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
