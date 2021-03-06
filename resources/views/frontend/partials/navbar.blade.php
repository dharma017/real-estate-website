<div class="navbar-fixed">
    <nav class="indigo darken-4">
        <div class="container">
            <div class="nav-wrapper">

                <a href="{{ route('home') }}" class="brand-logo">
                    <!-- @if(isset($navbarsettings[0]) && $navbarsettings[0]['name'])
                        {{ $navbarsettings[0]['name'] }}
                    @else
                        Real State
                    @endif
                    <i class="material-icons left">location_city</i> -->
                    <img src="{{ asset('frontend/images/logo.jpg') }}" alt="" class="img-responsive" />
                </a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger">
                    <i class="material-icons">menu</i>
                </a>

                <ul class="right hide-on-med-and-down">
                    <li class="{{ Request::is('/') ? 'active' : '' }}">
                        <a href="{{ route('home') }}">Home</a>
                    </li>

                    <li class="{{ Request::is('about-us*') ? 'active' : '' }}">
                        <a href="{{ route('pages.show', 'about-us') }}">About Us</a>
                    </li>

                    <li class="{{ Request::is('property*') ? 'active' : '' }}">
                        <a class='dropdown-trigger' data-target='dropdown1' href='#'>Property</a>
                        <!-- Dropdown Structure -->
                        <ul id='dropdown1' class='dropdown-content'>
                            @foreach ($features as $feature)
                                <li><a href="{{ route('property.feature', $feature->slug) }}">{{ $feature->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="{{ Request::is('pricing*') ? 'active' : '' }}">
                        <a href="{{ route('pages.show', 'pricing') }}">Pricing</a>
                    </li>

                    <li class="{{ Request::is('service-request*') ? 'active' : '' }}">
                        <a href="{{ route('service-request') }}">Service Request</a>
                    </li>

                    <li class="{{ Request::is('contact') ? 'active' : '' }}">
                        <a href="{{ route('contact') }}">Contact Us</a>
                    </li>

                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Post free</a></li>
                    @else
                        <li>
                            <a class="dropdown-trigger" href="#!" data-target="dropdown-auth-frontend">
                                {{ ucfirst(Auth::user()->username) }}
                                <i class="material-icons right">arrow_drop_down</i>
                            </a>
                        </li>

                        <ul id="dropdown-auth-frontend" class="dropdown-content">
                            <li>
                                @if(Auth::user()->role->id == 1)
                                    <a href="{{ route('admin.dashboard') }}" class="indigo-text">
                                        <i class="material-icons">person</i>Profile
                                    </a>
                                    <a href="{{ route('agents') }}" class="indigo-text">
                                        <i class="material-icons">people</i>Agents
                                    </a>
                                @elseif(Auth::user()->role->id == 2)
                                    <a href="{{ route('agent.dashboard') }}" class="indigo-text">
                                        <i class="material-icons">person</i>Profile
                                    </a>
                                @elseif(Auth::user()->role->id == 3)
                                    <a href="{{ route('user.dashboard') }}" class="indigo-text">
                                        <i class="material-icons">person</i>Profile
                                    </a>
                                @endif
                            </li>
                            <li>
                                <a class="dropdownitem indigo-text" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="material-icons">power_settings_new</i>{{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>

                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
        <li class="{{ Request::is('/') ? 'active' : '' }}">
            <a href="{{ route('home') }}">Home</a>
        </li>

        <li class="{{ Request::is('about-us*') ? 'active' : '' }}">
            <a href="{{ route('pages.show', 'about-us') }}">About Us</a>
        </li>

        <li class="{{ Request::is('property*') ? 'active' : '' }}">
            <a class='dropdown-trigger' data-target='dropdown_mobile' href='#'>Property</a>
            <!-- Dropdown Structure -->
            <ul id='dropdown_mobile' class='dropdown-content'>
                @foreach ($features as $feature)
                    <li><a href="{{ route('property.feature', $feature->slug) }}">{{ $feature->name }}</a></li>
                @endforeach
            </ul>
        </li>

        <li class="{{ Request::is('pricing*') ? 'active' : '' }}">
            <a href="{{ route('pages.show', 'pricing') }}">Pricing</a>
        </li>

        <li class="{{ Request::is('service-request*') ? 'active' : '' }}">
            <a href="{{ route('service-request') }}">Service Request</a>
        </li>

        <li class="{{ Request::is('contact') ? 'active' : '' }}">
            <a href="{{ route('contact') }}">Contact Us</a>
        </li>

        @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Post free</a></li>
        @else
            <li>
                <a class="dropdown-trigger" href="#!" data-target="dropdown-auth-frontend_mobile">
                    {{ ucfirst(Auth::user()->username) }}
                    <i class="material-icons right">arrow_drop_down</i>
                </a>
            </li>

            <ul id="dropdown-auth-frontend_mobile" class="dropdown-content">
                <li>
                    @if(Auth::user()->role->id == 1)
                        <a href="{{ route('admin.dashboard') }}" class="indigo-text">
                            <i class="material-icons">person</i>Profile
                        </a>
                        <a href="{{ route('agents') }}" class="indigo-text">
                            <i class="material-icons">people</i>Agents
                        </a>
                    @elseif(Auth::user()->role->id == 2)
                        <a href="{{ route('agent.dashboard') }}" class="indigo-text">
                            <i class="material-icons">person</i>Profile
                        </a>
                    @elseif(Auth::user()->role->id == 3)
                        <a href="{{ route('user.dashboard') }}" class="indigo-text">
                            <i class="material-icons">person</i>Profile
                        </a>
                    @endif
                </li>
                <li>
                    <a class="dropdownitem indigo-text" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        <i class="material-icons">power_settings_new</i>{{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>

        @endguest
    </ul>

</div>