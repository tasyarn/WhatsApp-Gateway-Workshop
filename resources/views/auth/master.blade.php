<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="/assets/compiled/svg/favicon.svg" type="image/x-icon" />
    <link rel="stylesheet" href="/assets/compiled/css/app.css" />
    <link rel="stylesheet" href="/assets/compiled/css/auth.css" />
</head>

<body>
    <div id="auth">
        @yield('konten')
    </div>
</body>

<script src="/assets/compiled/js/app.js"></script>
<script src="/assets/extensions/jquery/jquery.min.js"></script>
<script src="/assets/extensions/parsleyjs/parsley.min.js"></script>
<script src="/assets/static/js/pages/parsley.js"></script>

</html>
