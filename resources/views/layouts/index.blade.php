<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kiky Web Information</title>

    <!-- Style -->
    @include('layouts._style')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        @include('layouts._loading')
        <!-- Navbar -->
        @include('layouts._navbar')
        <!-- Sidebar -->
        @include('layouts._sidebar')
        <!-- Content -->
        @include('layouts._content')
        <!-- Footer -->
        @include('layouts._footer')
    </div>

    <!-- Script -->
    @include('layouts._script')
</body>

</html>
