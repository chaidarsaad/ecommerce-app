<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    {{-- Style --}}
    @stack('prepend-style')
    @include('includes.style-admin')
    @stack('addon-style')

</head>

<body>
    <div id="app">
        {{-- sidebar --}}
        @include('includes.sidebar')
        {{-- end sidebar --}}

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            {{-- content --}}
            @yield('content')
            {{-- end content --}}

            {{-- Footer --}}
            {{-- @include('includes.footer-admin') --}}
        </div>
    </div>

    {{-- Script --}}
    @stack('prepend-script')
    @include('includes.script-admin')
    @stack('addon-script')
</body>

</html>
