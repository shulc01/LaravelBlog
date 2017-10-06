    @extends('Layouts.site')

    @section('content')

        <div style="float: right;">
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endguest
            </ul>
        </div>


        <div class="navbar-nav-scroll">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('Admin') }}" target="_blank" >Admin</a>
                </li>
                <li><a href = "{{ route('Allcategories') }}" target="_blank">All categories</a>
                    <ul class = "submenu">
                        <li><a href = "{{ route('SingleCat', 1) }}">Football</a></li>
                        <li><a href = "{{ route('SingleCat', 2) }}">Biathlon</a></li>
                        <li><a href = "{{ route('SingleCat', 3) }}">Tennis</a></li>
                        <li><a href = "{{ route('SingleCat', 4) }}">Hockey</a></li>
                        <li><a href = "{{ route('SingleCat', 5) }}">Basketball</a></li>
                    </ul>
                </li>
                <li>
                    <a href = "{{ route('Articles') }}" target="_blank">All articles</a>
                </li>
            </ul>
        </div>

    @yield('content2')

    @endsection