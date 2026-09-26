<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'PixelKit - Image Optimizer')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-white border-bottom py-3">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ url('/') }}">
                <span class="pk-brand-icon">◆</span>

                <span>
                    PixelKit
                    <small class="d-block text-muted" style="font-size: 8px; margin-top: -4px;">
                        By Saurabh
                    </small>
                </span>
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">

                <ul class="navbar-nav mx-auto gap-lg-3">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Compress
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Resize
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Convert
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            About
                        </a>
                    </li>

                </ul>

                <a href="#" class="btn btn-primary px-4">
                    Get Started
                </a>

            </div>
        </div>
    </nav>


    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>


    {{-- Footer --}}
    <footer class="border-top mt-5 py-5 bg-light">

        <div class="container">

            <div class="row">

                <div class="col-md-6">
                    <h5 class="fw-bold">
                        <span class="text-primary">◆</span>
                        PixelKit
                    </h5>

                    <p class="text-muted mb-0">
                        Fast, simple and reliable image optimization
                        for the modern web.
                    </p>
                </div>

                <div class="col-md-6 text-md-end mt-4 mt-md-0">
                    <p class="text-muted mb-1">
                        Compress · Resize · Convert
                    </p>

                    <small class="text-muted">
                        © {{ date('Y') }} PixelKit. All rights reserved.
                    </small>
                </div>

            </div>

        </div>

    </footer>

    @stack('scripts')

</body>

</html>