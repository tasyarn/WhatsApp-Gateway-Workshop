<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="/assets/compiled/svg/favicon.svg" type="image/x-icon" />
    @yield('style')
    <link rel="stylesheet" href="/assets/compiled/css/app.css" />
</head>

<body>
    <div id="app">
        <div id="sidebar">
            @yield('sidebar')
        </div>
        <div id="main" class="layout-navbar navbar-fixed">
            <header class="mb-3">
                @include('layout.navbar')
            </header>
            <div id="main-content">
                @yield('konten')
            </div>
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2023 &copy; {{ $companyname }}</p>
                    </div>
                    <div class="float-end">
                        <p>
                            Crafted with
                            <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                            in Surabaya</a>
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @yield('script')
    <script src="/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="/assets/compiled/js/app.js"></script>
</body>

</html>
