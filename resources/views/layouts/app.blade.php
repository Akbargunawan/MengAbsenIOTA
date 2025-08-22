<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MengABSEN')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#DB7E2A] min-h-screen flex">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Wrapper abu-abu + konten putih --}}
    <div id="contentWrapper" class="flex-1 p-4 overflow-hidden">
        {{-- Abu-abu sebagai background konten --}}
        <div id="slideContent" class="bg-gray-100 w-full h-full rounded-2xl p-4 flex flex-col
                                    transform -translate-x-full opacity-0 transition-all duration-500 ease-in-out"
             style="height: calc(100vh - 32px);">

            {{-- Top Bar: Breadcrumb + User Info --}}
            <div class="mb-4 flex items-center justify-between shrink-0 relative">

                {{-- Breadcrumb otomatis --}}
                @php
                    $breadcrumbs = [];
                    $breadcrumbs[] = ['title' => 'MengABSEN', 'url' => route('dashboard')];

                    $currentRoute = Route::currentRouteName();
                    $orangePages = ['Dashboard', 'User', 'Menu', 'Role', 'Permission', 'Create'];

                    $menuMap = [
                        'dashboard' => ['parent' => null, 'url' => null],
                        'user.index' => ['parent' => 'User Management', 'url' => '#'],
                        'user.create' => ['parent' => 'User Management', 'url' => route('user.index')],
                        'menu.index' => ['parent' => 'User Management', 'url' => '#'],
                        'role.index' => ['parent' => 'User Management', 'url' => '#'],
                        'permission.index' => ['parent' => 'User Management', 'url' => '#'],
                        'master.index' => ['parent' => null, 'url' => null],
                    ];

                    if(isset($menuMap[$currentRoute])){
                        $parent = $menuMap[$currentRoute]['parent'];
                        $parentUrl = $menuMap[$currentRoute]['url'];

                        if($parent){
                            $breadcrumbs[] = ['title' => $parent, 'url' => $parentUrl];
                        }

                        if($currentRoute === 'user.create'){
                            $breadcrumbs[] = ['title' => 'User', 'url' => route('user.index')];
                            $breadcrumbs[] = ['title' => 'Create', 'url' => null];
                        } else {
                            $breadcrumbs[] = ['title' => ucfirst(explode('.', $currentRoute)[0]), 'url' => null];
                        }
                    } else {
                        $breadcrumbs[] = ['title' => ucfirst(explode('.', $currentRoute)[0]), 'url' => null];
                    }
                @endphp

                <div class="text-sm">
                    @foreach($breadcrumbs as $key => $crumb)
                        @php $isOrange = in_array($crumb['title'], $orangePages); @endphp

                        @if($crumb['url'])
                            <a href="{{ $crumb['url'] }}" class="hover:underline {{ $isOrange ? 'text-[#DB7E2A]' : 'text-gray-600' }}">
                                {{ $crumb['title'] }}
                            </a>
                        @else
                            <span class="font-semibold {{ $isOrange ? 'text-[#DB7E2A]' : 'text-gray-600' }}">
                                {{ $crumb['title'] }}
                            </span>
                        @endif

                        @if($key < count($breadcrumbs) - 1)
                            <span class="mx-1 text-gray-400">></span>
                        @endif
                    @endforeach
                </div>

                {{-- User Info Horizontal --}}
                <div class="flex items-center space-x-3 relative">
                    <span class="text-sm font-semibold">
                        {{ Auth::user()->name ?? 'Username' }}
                        <span class="text-black">({{ Auth::user()->role ?? 'Role' }})</span>
                    </span>
                    <button id="profileButton">
                        <img src="{{ asset('images/profil.png') }}" alt="Profile" class="w-10 h-10 rounded-full border border-gray-300">
                    </button>

                    {{-- Popup --}}
                    <div id="profilePopup" class="hidden absolute top-12 right-0 w-64 bg-[#DB7E2A] text-white rounded-lg shadow-lg p-4 z-50">
                        <div class="mb-2 font-semibold">{{ Auth::user()->name ?? 'Username' }}</div>
                        <div class="mb-3 text-sm text-white">{{ Auth::user()->role ?? 'Role' }}</div>
                        <div class="border-t border-white mb-3"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="px-4 py-2 text-white border border-white rounded hover:bg-white hover:text-black transition flex items-center justify-start">
                                <img src="{{ asset('images/LogoSidebar/Toggle right.svg') }}" alt="Logout Icon" class="w-5 h-5">
                                <span class="ml-2">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Garis hitam tipis --}}
            <div class="border-t border-black mb-4"></div>

            {{-- Konten putih scrollable --}}
            <div class="bg-white w-full rounded-2xl shadow p-6 flex-1 overflow-y-auto">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- Script toggle animasi slide --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slide = document.getElementById('slideContent');
            setTimeout(() => {
                slide.classList.remove('-translate-x-full', 'opacity-0');
                slide.classList.add('translate-x-0', 'opacity-100');
            }, 100);
        });
    </script>

    {{-- Script toggle popup profile --}}
    <script>
        document.getElementById('profileButton').addEventListener('click', function () {
            document.getElementById('profilePopup').classList.toggle('hidden');
        });

        document.addEventListener('click', function(e) {
            const popup = document.getElementById('profilePopup');
            const button = document.getElementById('profileButton');
            if (!popup.contains(e.target) && !button.contains(e.target)) {
                popup.classList.add('hidden');
            }
        });
    </script>

</body>
</html>
