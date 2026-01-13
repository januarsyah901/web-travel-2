<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard - Fabi Abadi Travel')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/icon/favicon.png') }}" type="image/png">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- External CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css"/>
    <!-- Font Awesome sudah di-include via Vite build -->

    <!-- Global Styles -->
    @include('admin.layouts.partials.styles')

    <!-- Page Specific Styles -->
    @stack('styles')
</head>
<body class="bg-gray-100">

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu-overlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col overflow-hidden w-full">

            <!-- Header -->
            @include('admin.layouts.header')

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50">

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

