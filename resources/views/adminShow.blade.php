@extends ('Layouts.site')

@section('content')

    @if (isset(Auth::user()->name) && Auth::user()->name == 'admin')


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
                        <a class="nav-link" href="{{ route('AddArticle') }}" target="_blank" >Add Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('AddCat') }}" target="_blank" >Add category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('Articles') }}" target="_blank" >Go to site</a>
                    </li>
                </ul>
            </div>
            <h2 class = "cat_title">ALL NEWS</h2>

        <script>

            function confirmDelete(id){

                var x = confirm ("Are you sure want to delete?");

                if (x) return window.location.href='/admin/delete/' + id;

                else false;

            }

        </script>

            <form action = "{{ route('EditArticle')  }}" method = "">

                @foreach($allarticles as $article)

                    <input type="button" value="Delete" onclick = " return confirmDelete({{ $article->id}})"/>

                    <input type = "checkbox" name = "article" value = "{{  $article->id  }}"/>

                    <a href = "{{ route('showArticle', $article->id) }}" target = "_blank">{{ $article->title }}</a>
                    <a href = "{{ route('SingleCat', $article->id_cat) }}" target = "_blank">({{ $article->category_name  }})</a><br /><br />

                @endforeach

                <input type="submit" value = "Edit"/>

            </form>

    @else

        <h1> YOU NO ADMIN!!! </h1>

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

    @endif

@endsection