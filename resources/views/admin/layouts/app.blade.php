<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard - Fabi Abadi Travel')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/icon/favicon.png') }}" type="image/png">

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- External CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css"/>

    <!-- Global Styles -->
    @include('admin.layouts.partials.styles')

    <!-- Page Specific Styles -->
    @stack('styles')
</head>
<body class="dub-body">

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu-overlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

    <div class="dub-shell">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Main Content Wrapper -->
        <div class="dub-main">

            <!-- Header -->
            @include('admin.layouts.header')

            <!-- Content Area -->
            <main class="dub-content">

                <!-- Alert Messages -->
                @include('admin.layouts.partials.alerts')

                <!-- Page Content -->
                @yield('content')

            </main>

        </div>
    </div>

    <!-- Custom Alert Modal -->
    @include('admin.layouts.partials.custom-alert')

    <!-- Global Scripts -->
    @include('admin.layouts.partials.scripts')

    <!-- Page Specific Scripts -->
    @stack('scripts')

</body>
</html>
