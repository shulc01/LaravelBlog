    @extends('layouts.site')

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
                <li><a href = "{{ route('ShowAllCategories') }}" target="_blank">All categories</a>
                    <ul class = "submenu">

                        @foreach ($categories as $category)

                         <li><a href = "{{ route('ShowCategory', $category->id_cat) }}">{{ $category->category_name }}</a></li>

                        @endforeach

                    </ul>
                </li>
                <li>
                    <a href = "{{ route('ShowAllArticles') }}" target="_blank">All articles</a>
                </li>
            </ul>
        </div>

    @yield('content2')

    @endsection