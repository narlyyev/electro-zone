<nav class="sb-topnav navbar navbar-expand navbar-dark bg-white">
    <!-- Navbar Brand-->
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
        <div class="ps-4">
            <img src="{{ asset('img/techno-logo.svg') }}" alt="" class="img-fluid" style="width: 130px;">
        </div>
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="bi-list h4 text-black"></i></button>
    <ul class="navbar-nav ms-auto me-3 me-lg-4">
        <div>
            <a class="nav-link text-black fw-semibold pb-0 {{ request()->routeIs('home') ? 'text-primary' : 'text-black'}}" target="_blank"
               href="{{ route('home') }}">
                <i class="bi-house ps-1 pe-1"></i>Baş sahypa
            </a>
        </div>
        <li class="nav-item dropdown text-end">
            <a class="nav-link dropdown-toggle text-black" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li>
                    <form action="{{ route('admin.logout') }}" method="post">
                        @csrf
                        <button class="border-0 bg-white ps-3">
                            Logout
                        </button>
                    </form>
                </li>
                <li class="ps-3 hb fw-normal">
                    <a href="#" class="text-black text-decoration-none">
                        Edit
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<style>
    .nav-link.dropdown-toggle.text-black:after {
        display: none;
    }
</style>