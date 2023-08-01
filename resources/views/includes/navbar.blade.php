<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
        <a class="navbar-brand" href="{{ route('cart') }}">
            {{-- <img src="/images/logo.svg" alt="" /> --}}
            <img src="{{ asset('/images/icon-cart-filled.svg') }}" alt="image cart"/>
            <div class="cart-badge">0</div>
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
                <li class="nav-item ">
                    <a class="nav-link" href="#">Favorit</a>
                </li>
                <li class="nav-item {{ request()->is('register') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('register') }}">Daftar</a>
                </li>
                <li class="nav-item {{ request()->is('login') ? 'active' : '' }}">
                    <a class="btn btn-success nav-link px-4 text-white" href="{{ route('login') }}">Masuk</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
