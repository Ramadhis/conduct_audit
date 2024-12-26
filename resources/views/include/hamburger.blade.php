<!-- Navbar with Hamburger Menu -->
<nav class="navbar navbar-light bg-white shadow-sm">
  <button class="btn btn-outline-primary" id="menu-toggle"><i class="fas fa-bars"></i> Menu</button>

  <!-- Authentication Links -->
  @guest
  @if (Route::has('login'))
  <!-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> -->
  <a href="{{ route('login') }}" class="btn btn-outline-success ml-auto">Login</a>
  @endif

  @if (Route::has('register'))
  <li class="nav-item">
    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
  </li>
  @endif
  @else
  <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
    aria-expanded="false" v-pre>
    Hello {{ Auth::user()->name }}
  </a>
  <!-- <a href="{{ route('logout') }}" class="btn btn-outline-danger ml-auto">Logout</a> -->

  <!-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
      </a> -->
  <!-- <button class="btn btn-outline-danger ml-auto" href="{{ route('logout') }}">Logout</button>

      <button class="btn btn-outline-danger ml-auto" href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form> -->

  <a class="btn btn-outline-danger ml-auto" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
    {{ __('Logout') }}
  </a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
  @endguest
</nav>