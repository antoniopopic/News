<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" id="navbar">
  <div class="container">
  <a class="navbar-brand" href="{{ route('posts.index') }}">
      {{ config('app.name', 'News') }}
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto" id="navbarStyle">
      <!-- <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li> -->
      <li class="{{ Request::is('/') ? 'active nav-item' : '' }}">
        <a class="nav-link" href="{{ url('/')}}">Home</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">Home</a>
      </li> -->
      <li class="{{ Request::is('posts') ? 'active nav-item' : '' }}">
        <a class="nav-link" href="{{ route('posts.index') }}">Posts</a>
      </li>
      @if (!Auth::guest() && Auth::user()->hasRole('admin'))
      <li class="{{ Request::is('users') ? 'active nav-item' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">Users</a>  
      </li>
      @endif
      @foreach($categories as $category)
        <li class="{{ Request::is('posts/categories/'.$category->name) ? 'active nav-item' : '' }}">
          <a class="nav-link" href="{{ route('categories', $category) }}">{{ $category->name }}</a>
        </li>
      @endforeach    
    </ul>
    
    <ul class="navbar-nav ml-auto">
    <form class="form-inline my-2 my-lg-0" action="/search" method="GET">
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search Posts" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="searchButtonNavbar">Search</button>
    </form>
        <!-- Authentication Links -->
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->username }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
  </div>
  </div>
</nav>
