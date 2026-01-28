<!DOCTYPE html>
<html lang="zxx">


@include('layouts.head')

<body class="bg-body-bg">
    <!-- Start Preloader Area -->
    <div class="preloader" id="preloader">
        <div class="preloader">
            <div class="waviy position-relative">
                <span class="d-inline-block">
                    S
                </span>
                <span class="d-inline-block">
                    I
                </span>
                <span class="d-inline-block">
                    M
                </span>
                <span class="d-inline-block">
                    A
                </span>
                <span class="d-inline-block">
                    S
                </span>
            </div>
        </div>
    </div>

    @include('partials.sidebar')

    <div class="container-fluid">
        <div class="main-content d-flex flex-column">
            @include('partials.navbar')
            @yield('content')
            @include('layouts.footer')
        </div>
    </div>


    @include('layouts.scripts')
    @stack('scripts')
</body>

</html>
