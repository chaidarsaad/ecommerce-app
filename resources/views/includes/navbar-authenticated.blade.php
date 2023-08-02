<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="/images/logo.svg" alt="" />
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
                <li class="nav-item">
                    <a href="{{ route('register') }}"
                        class="nav-link {{ request()->is('register') ? 'active' : '' }}">Daftar</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="btn btn-success nav-link px-4 text-white">Masuk</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
