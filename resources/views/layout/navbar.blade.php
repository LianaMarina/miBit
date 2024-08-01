<nav class="navbar navbar-dark text-center">
    <div class="container">
      <a class="navbar-brand" href="{{ route('welcome') }}"><img src="{{ asset('public\img\logo.png') }}" alt="logo"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-start px-2 py-3 text-bg-dark" tabindex="-1" data-bs-backdrop="static" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header d-flex justify-content-end">
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel"><img src="{{ asset('public\img\logo.png') }}" alt="logo"></h5>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('show_search_page') }}">Поиск</a>
            </li>
            @guest
                <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('show_registration') }}">Регистрация</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('show_auth') }}">Авторизация</a>
            </li>
            @endguest
            @auth
            @if(Auth()->user()->role == 1)
              <li class="nav-item">
                <a class="nav-link active" href="{{ route('show_admin_genres') }}">ЖАНРЫ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="{{ route('show_admin_users') }}">ПОЛЬЗОВАТЕЛИ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="{{ route('show_admin_tracks') }}">ТРЕКИ</a>
              </li>
            @endif
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('show_profile') }}">Мой профиль</a>
            </li>
              <li class="nav-item">
                <a class="nav-link active" href="{{ route('exit') }}">Выход</a>
              </li>
            @endauth
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>