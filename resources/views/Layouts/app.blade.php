<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAFMeteseh | 2025</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Jika menggunakan .png -->
    <link rel="icon" href="{{ asset('images/webicon.png') }}" type="image/png">

    <!-- Jika ingin dukungan Apple -->
    <link rel="apple-touch-icon" href="{{ asset('images/webicon.png') }}">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex h-screen">
        {{-- Sidebar for Desktop and Tablet (Included from another file) --}}
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            @php
                use Illuminate\Support\Facades\Auth;
                $user = Auth::user();
            @endphp
            <header class="flex justify-between items-center bg-white shadow-sm py-4 px-6">
                {{-- Hamburger Menu Button for Mobile/Tablet --}}
                {{-- Tombol ini sekarang akan muncul hingga layar 'lg' (1024px) --}}
                <div class="block lg:hidden">
                    <button id="mobile-menu-button" class="text-gray-500 hover:text-gray-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
                <h1 class="text-xl lg:text-3xl font-bold text-gray-800">@yield('title')</h1>
            </header>

            {{-- Main Content --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                {{-- Breadcrumb Section --}}
                <nav class="text-sm font-medium text-gray-500 mb-4" aria-label="breadcrumb">
                    <ol class="list-none p-0 inline-flex">
                        <li class="flex items-center">
                            @if (request()->is('staf*'))
                                <a href="{{ route('staf.index') }}" class="text-blue-600 hover:text-blue-800">Dashboard</a>
                            @else
                                <a href="{{ route('tamu.index') }}" class="text-blue-600 hover:text-blue-800">Dashboard</a>
                            @endif
                            <span class="mx-2 text-gray-400">/</span>
                        </li>
                        @yield('breadcrumb')
                    </ol>
                </nav>

                @yield('content')
            </main>
        </div>
    </div>
    
    {{-- Overlay for Mobile Sidebar --}}
    <div id="sidebar-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-40 hidden md:hidden"></div>

    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const closeSidebarButton = document.getElementById('close-sidebar-button');

        mobileMenuButton.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
        });

        closeSidebarButton.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });
    </script>
</body>
</html>