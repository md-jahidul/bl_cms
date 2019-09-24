<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="{{route('home')}}">
                        <img class="brand-logo" alt="MyBL CMS" src="{{asset('logo/logo.png')}}">
                        <h3 class="brand-text">@if(Auth::user()->role_id == '1'|| Auth::user()->role_id == '2') MyBL @else AssetLite @endif CMS</h3>
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content float-right">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">

                            <span class="avatar avatar-online">
                         <img src="{{ asset('theme/images/portrait/small/avatar-s-19.png') }}" alt="x"><i></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="ft-phone-off"></i> Logout</a>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ft-power"></i> {{ __(' Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>

                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
