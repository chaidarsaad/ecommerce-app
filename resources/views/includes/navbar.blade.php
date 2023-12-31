<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
        <a class="navbar-brand" href="{{ route('cart') }}">
            {{-- <img src="/images/logo.svg" alt="" /> --}}
            @php
                $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
            @endphp
            @if ($carts > 0)
                <img src="/images/icon-cart-filled.svg" alt="" />
                <div class="cart-badge">{{ $carts }}</div>
            @else
                <img src="/images/icon-cart-empty.svg" alt="" />
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item {{ request()->is('categories') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('categories') }}">Kategori</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('wishlist') }}">

                        @php
                            $wishlists = \App\Models\Wishlist::where('users_id', Auth::user()->id)->count();
                        @endphp
                        @if ($wishlists > 0)
                            <i class="fa-solid fa-heart fa-xl"></i>
                            <div class="cart-badge">{{ $wishlists }}</div>
                        @else
                            <i class="fa-solid fa-heart fa-xl"></i>
                        @endif
                    </a>
                </li> --}}
                @guest
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Daftar</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-success nav-link px-4 text-white">Masuk</a>
                    </li>
                @endguest
            </ul>

            @auth()
                <!-- Desktop Menu -->
                <ul class="navbar-nav d-none d-lg-flex">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                            Halo, {{ Auth::user()->name }}
                            <img src="/images/icon-user.png" alt="" class="rounded-circle ml-3 profile-picture" />
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                            <a href="{{ route('dashboard-account') }}" class="dropdown-item">
                                Akun Saya
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>

                </ul>

                <ul class="navbar-nav d-block d-lg-none">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            {{-- Halo, {{ Auth::user()->name }} --}}
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            @endauth

        </div>
    </div>
</nav>
