
<nav>
    <div class="d-flex flex-column p-3 text-white bg-dark" style="width: 18vw; ">
        <a href="/bts-project" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">Aplikasi</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
            <a href="/admin" class="nav-link text-white {{ Request::is('admin') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            </li>
            <li>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                    <h2 class="accordion-header bg-dark fs-6 fw-normal" id="flush-headingOne">
                        <a href="#" class="dropdown-toggle collapsed text-white text-decoration-none nav-link {{ Request::is('bts') || Request::is('operator') || Request::is('monitoring') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            <i class="bi bi-file-bar-graph"></i> Master Data
                        </a> 
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body bg-dark d-flex flex-column">
                            <a class="text-white text-decoration-none border-bottom pb-2 mb-2" href="/bts">Data BTS</a>
                            <a class="text-white text-decoration-none border-bottom pb-2 mb-2" href="/operator">Data Operator</a>
                            <a class="text-white text-decoration-none border-bottom pb-2 mb-2" href="/user">Data User</a>
                            <a class="text-white text-decoration-none border-bottom pb-2 mb-2" href="/monitoring">Data Monitoring</a>
                        </div>
                    </div>
                    </div>
                </div>
            </li>
            <li>
                <a href="/kuesioner" class="nav-link text-white {{ Request::is('kuesioner') ? 'active' : '' }}">
                    <i class="bi bi-journal-check"></i> Kuesioner
                </a>
            </li>
            <li>
            <a href="/maps" class="nav-link text-white {{ Request::is('maps') ? 'active' : '' }}">
                <i class="bi bi-pin-map"></i> Maps
            </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                <strong class="ps-2">{{ auth()->user()->name }}</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(0px, -34px, 0px);" data-popper-placement="top-start">
                <li><a class="dropdown-item" href="/profile">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="/profile/{{ auth()->user()->id }}/change-password">Change Password</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">Sign out</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
