<div class="w-60 bg-[#DB7E2A] text-white flex flex-col h-screen">
    {{-- Logo --}}
    <div class="flex items-center justify-center py-6 border-b border-orange-300">
        <img src="{{ asset('images/mengabsenadmin-.svg') }}" alt="MengABSEN Logo" class="w-28 h-28">
    </div>

    @php
        // Flag untuk aktifkan SECTION & ITEM User di semua sub-halaman (index, create, edit, dst)
        $isUserCreate = request()->routeIs('user.create') || request()->routeIs('create_user');
        $isUserAny    = request()->routeIs('user.*') || request()->is('user*') || $isUserCreate;

        // Section lain (kalau ingin konsisten pakai route name, tinggal sesuaikan)
        $isMenuAny       = request()->is('menu*');
        $isRoleAny       = request()->is('role*');
        $isPermissionAny = request()->is('permission*');
        $isUserMgmtAny   = $isUserAny || $isMenuAny || $isRoleAny || $isPermissionAny;
    @endphp

    {{-- Menu --}}
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center w-full px-3 py-2 rounded-full
                  {{ request()->routeIs('dashboard') 
                      ? 'bg-gray-100 text-black font-semibold -mr-4' 
                      : 'text-white hover:bg-[#B5692B] hover:text-white' }}">
            <img src="{{ request()->routeIs('dashboard') 
                         ? asset('images/LogoSidebar/Home-active.svg') 
                         : asset('images/LogoSidebar/Home.svg') }}" 
                 alt="Dashboard" class="w-5 h-5 mr-3">
            <span>Dashboard</span>
        </a>

        {{-- User Management with Dropdown --}}
        <div x-data="{ open: {{ $isUserMgmtAny ? 'true' : 'false' }} }" class="relative">
            <button @click="open = !open" 
                    class="flex items-center px-3 py-2 w-full rounded-full
                           {{ $isUserMgmtAny 
                               ? 'bg-gray-100 text-black font-semibold -mr-4' 
                               : 'text-white hover:bg-[#B5692B] hover:text-white' }}">
                <img src="{{ $isUserMgmtAny
                             ? asset('images/LogoSidebar/User-active.svg') 
                             : asset('images/LogoSidebar/User.svg') }}" 
                     alt="User Management" class="w-5 h-5 mr-3">
                <span>User Management</span>
                <svg :class="{'rotate-90': open}" class="ml-auto w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            {{-- Dropdown --}}
            <div x-show="open" x-transition
                 class="mt-2 overflow-hidden bg-[#DB6A1A] border border-[#C46217] rounded-2xl">
                
                {{-- User (aktif juga saat create_user) --}}
                <a href="{{ route('user.index') }}"
                   class="flex items-center gap-3 px-4 py-2 transition duration-200
                          {{ $isUserAny
                              ? 'bg-[#B5692B] text-white font-semibold rounded-t-2xl rounded-b-lg' 
                              : 'text-white hover:bg-[#B5692B] hover:text-white hover:rounded-t-2xl hover:rounded-b-lg' }}">
                    <img src="{{ $isUserAny
                        ? asset('images/LogoSidebar/Users-active.svg') 
                        : asset('images/LogoSidebar/Users.svg') }}" class="w-5 h-5" alt="">
                    User
                </a>

                {{-- Menu --}}
                <a href="/menu"
                   class="flex items-center gap-3 px-4 py-2 transition duration-200
                          {{ $isMenuAny
                              ? 'bg-[#B5692B] text-white font-semibold rounded-lg' 
                              : 'text-white hover:bg-[#B5692B] hover:text-white hover:rounded-lg' }}">
                    <img src="{{ $isMenuAny
                        ? asset('images/LogoSidebar/Menu-active.svg') 
                        : asset('images/LogoSidebar/Menu.svg') }}" class="w-5 h-5" alt="">
                    Menu
                </a>

                {{-- Role --}}
                <a href="/role"
                   class="flex items-center gap-3 px-4 py-2 transition duration-200
                          {{ $isRoleAny
                              ? 'bg-[#B5692B] text-white font-semibold rounded-lg' 
                              : 'text-white hover:bg-[#B5692B] hover:text-white hover:rounded-lg' }}">
                    <img src="{{ $isRoleAny
                        ? asset('images/LogoSidebar/Role-active.svg') 
                        : asset('images/LogoSidebar/Role.svg') }}" class="w-5 h-5" alt="">
                    Role
                </a>

                {{-- Permission --}}
                <a href="/permission"
                   class="flex items-center gap-3 px-4 py-2 transition duration-200
                          {{ $isPermissionAny
                              ? 'bg-[#B5692B] text-white font-semibold rounded-b-2xl rounded-t-lg' 
                              : 'text-white hover:bg-[#B5692B] hover:text-white hover:rounded-b-2xl hover:rounded-t-lg' }}">
                    <img src="{{ $isPermissionAny
                        ? asset('images/LogoSidebar/Permission-active.svg') 
                        : asset('images/LogoSidebar/Permission.svg') }}" class="w-5 h-5" alt="">
                    Permission
                </a>

            </div>
        </div>

      {{-- MASTER --}}
@php
    $isJabatanAny       = request()->is('jabatan*');
    $isJenisIzinAny     = request()->is('jenis-izin*');
    $isReimbursementAny = request()->is('reimbursement*');
    $isRoleMasterAny    = request()->is('role*'); 
    $isSuratTugasAny    = request()->is('surat-tugas*');
    $isUserAnyMaster    = request()->is('user-master*'); // <-- kasih beda prefix biar gak tabrakan sama user mgmt
    $isMasterAny        = $isJabatanAny || $isJenisIzinAny || $isReimbursementAny || $isRoleMasterAny || $isSuratTugasAny || $isUserAnyMaster;
@endphp

<div x-data="{ open: {{ $isMasterAny ? 'true' : 'false' }} }" class="relative">
    <button @click="open = !open" 
            class="flex items-center px-3 py-2 w-full rounded-full
                   {{ $isMasterAny 
                       ? 'bg-gray-100 text-black font-semibold -mr-4' 
                       : 'text-white hover:bg-[#B5692B] hover:text-white' }}">
        <img src="{{ $isMasterAny
                     ? asset('images/LogoSidebar/Folder-active.svg') 
                     : asset('images/LogoMaster/Master.svg') }}" 
             alt="Master" class="w-5 h-5 mr-3">
        <span>Master</span>
        <svg :class="{'rotate-90': open}" class="ml-auto w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>

    {{-- Dropdown --}}
    <div x-show="open" x-transition
         class="mt-2 overflow-hidden bg-[#DB6A1A] border border-[#C46217] rounded-2xl">

        {{-- Jabatan --}}
        <a href="/jabatan"
           class="flex items-center gap-3 px-4 py-2 transition duration-200
                  {{ $isJabatanAny ? 'bg-[#B5692B] text-white font-semibold' : 'text-white hover:bg-[#B5692B] hover:text-white' }}">
            <img src="{{ asset('images/LogoMaster/Jabatan.svg') }}" class="w-5 h-5" alt="">
            Jabatan
        </a>

        {{-- Jenis Izin --}}
        <a href="/jenis-izin"
           class="flex items-center gap-3 px-4 py-2 transition duration-200
                  {{ $isJenisIzinAny ? 'bg-[#B5692B] text-white font-semibold' : 'text-white hover:bg-[#B5692B] hover:text-white' }}">
            <img src="{{ asset('images/LogoMaster/JenisIzin.svg') }}" class="w-5 h-5" alt="">
            Jenis Izin
        </a>

        {{-- Reimbursement --}}
        <a href="/reimbursement"
           class="flex items-center gap-3 px-4 py-2 transition duration-200
                  {{ $isReimbursementAny ? 'bg-[#B5692B] text-white font-semibold' : 'text-white hover:bg-[#B5692B] hover:text-white' }}">
            <img src="{{ asset('images/LogoMaster/Reimbursement.svg') }}" class="w-5 h-5" alt="">
            Reimbursement
        </a>

        {{-- Role --}}
        <a href="/role-master"
           class="flex items-center gap-3 px-4 py-2 transition duration-200
                  {{ $isRoleMasterAny ? 'bg-[#B5692B] text-white font-semibold' : 'text-white hover:bg-[#B5692B] hover:text-white' }}">
            <img src="{{ asset('images/LogoSidebar/Role.svg') }}" class="w-5 h-5" alt="">
            Role
        </a>

        {{-- Surat Tugas --}}
        <a href="/surat-tugas"
           class="flex items-center gap-3 px-4 py-2 transition duration-200
                  {{ $isSuratTugasAny ? 'bg-[#B5692B] text-white font-semibold' : 'text-white hover:bg-[#B5692B] hover:text-white' }}">
            <img src="{{ asset('images/LogoMaster/SuratTugas.svg') }}" class="w-5 h-5" alt="">
            Surat Tugas
        </a>

        {{-- User Master --}}
        <a href="/user-master"
           class="flex items-center gap-3 px-4 py-2 transition duration-200
                  {{ $isUserAnyMaster ? 'bg-[#B5692B] text-white font-semibold' : 'text-white hover:bg-[#B5692B] hover:text-white' }}">
            <img src="{{ asset('images/LogoSidebar/Users.svg') }}" class="w-5 h-5" alt="">
            User
        </a>
    </div>
</div>


    </nav>
</div>

<script src="//unpkg.com/alpinejs" defer></script>
