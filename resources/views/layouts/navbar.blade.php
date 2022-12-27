<nav class="navbar navbar-expand-lg navbar-dark navbar-custom {{ Request::is('/') ? 'fixed-top' : 'sticky-top' }}" >
    <div class="container px-5">
        <a class="navbar-brand" href="/">HOME</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <div class="navbar-nav">
                <a class="nav-link {{ Request::is('v/bts') ? 'active' : '' }}" href="/v/bts">BTS</a>
                <a class="nav-link {{ Request::is('v/maps') ? 'active' : '' }}" href="/v/maps">Maps</a>
                @can('surveyor')
                    <a class="nav-link {{ Request::is('v/monitoring') ? 'active' : '' }}" href="/v/monitoring">Monitoring</a>
                @endcan
            </div>
            @auth
                <div class="dropdown ms-auto">
                    <a class="dropdown-toggle text-decoration-none fw-bold text-white" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </a>
                    
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li class="mx-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/profile-pic.png') }}" alt="Profile pic" width="48px">
                                <p class="my-0 ms-3">{{ auth()->user()->name }}</p>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/signup">Sign Up</a></li>
                    <li class="nav-item"><a class="nav-link" href="/login">Log In</a></li>
                </ul>
            @endauth
        </div>
    </div>
</nav>