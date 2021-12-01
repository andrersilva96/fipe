<nav class="navbar navbar-inverse navbar-embossed navbar-expand-lg rounded-0" role="navigation">
    <a class="navbar-brand" href="{{ route('home') }}">{{ env('APP_NAME') }}</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-01"></button>
    <div class="collapse navbar-collapse" id="navbar-collapse-01">
        <ul class="nav navbar-nav mr-auto">

        </ul>
        <form class="navbar-form form-inline my-2 my-lg-0" action="#" role="search">
            <div class="form-group">
                <div class="input-group">
                    <input class="form-control" id="navbarInput-01" type="search" placeholder="Pesquisar">
                    <span class="input-group-btn">
                        <button type="submit" class="btn"><span class="fui-search"></span></button>
                    </span>
                </div>
            </div>
        </form>
        <div class="d-flex justify-content-lg-end">
            <ul class="nav navbar-nav mr-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link pointer">{{ Auth::user()->name }}</a>
                    </li>

                    <li class="nav-item pointer" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <a class="nav-link">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>

    </div>
</nav>
