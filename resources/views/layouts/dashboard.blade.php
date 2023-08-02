<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @stack('prepend-style')
    <link href="{{ url('/style/aosdashboard.css') }}" rel="stylesheet" />
    <link href="{{ url('/style/main.css') }}" rel="stylesheet" />
    @stack('addon-style')
</head>

<body>
    <div class="page-dashboard">
        <div class="d-flex" id="wrapper" data-aos="fade-right">
            <!-- Sidebar -->
            <div class="border-right" id="sidebar-wrapper">
                <div class="sidebar-heading text-center">
                    <img src="/images/dashboard-store-logo.svg" alt="" class="my-4" />
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('dashboard') }}"
                        class="list-group-item list-group-item-action {{ request()->is('dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('dashboard-transaction') }}"
                        class="list-group-item list-group-item-action {{ request()->is('dashboard/transactions*') ? 'active' : '' }}">
                        Transaksi
                    </a>
                    <a href="{{ route('dashboard-account') }}"
                        class="list-group-item list-group-item-action {{ request()->is('dashboard/accounts*') ? 'active' : '' }}">
                        Akun Saya
                    </a>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                        class="list-group-item list-group-item-action">
                        Keluar dari akun
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top" data-aos="fade-down">
                    <div class="container-fluid">
                        <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle">
                            &laquo; Menu
                        </button>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Desktop Menu -->
                            <ul class="navbar-nav d-none d-lg-flex ml-auto">
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link" id="navbarDropdown" role="button"
                                        data-toggle="dropdown">
                                        Halo, {{ Auth::user()->name }}
                                        <img src="/images/icon-user.png" alt=""
                                            class="rounded-circle ml-2 profile-picture" />
                                    </a>
                                    <div class="dropdown-menu">
                                        {{-- <a href="" class="dropdown-item">Dashboard</a> --}}
                                        <a href="{{ route('home') }}" class="dropdown-item">
                                            Home
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                                        @php
                                            $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                                        @endphp
                                        @if ($carts > 0)
                                            <img src="/images/icon-cart-filled.svg" alt="" />
                                            <div class="cart-badge">0</div>
                                        @else
                                            <img src="/images/icon-cart-empty.svg" alt="" />
                                        @endif
                                    </a>
                                </li>
                            </ul>

                            <ul class="navbar-nav d-block d-lg-none">
                                <li class="nav-item">
                                    <a href="{{ route('dashboard-account') }}" class="nav-link">
                                        Halo, {{ Auth::user()->name }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('home') }}" class="nav-link d-inline-block">
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('cart') }}" class="nav-link d-inline-block">
                                        Cart
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                {{-- Content --}}
                @yield('content')

            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    @stack('prepend-script')
    <script src="{{ url('/vendor/jquery/jquery.slim.min.js') }}"></script>
    <script src="{{ url('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('/vendor/aos/aos.js') }}"></script>
    <script>
        AOS.init();
    </script>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/647a1c6ead80445890f0b337/1h1ufu4da';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

    @stack('addon-script')
</body>

</html>
