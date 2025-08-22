<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Buat Password Baru - MengABSEN</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-[#E87F2D] flex items-center justify-center relative overflow-hidden">

    <!-- Dua lingkaran di pojok kiri atas -->
    <div class="absolute top-0 left-0 z-0">
        <div class="relative">
            <!-- Lingkaran besar warna E8B58A -->
            <div class="absolute -top-40 -left-40 w-[420px] h-[420px] bg-[#E8B58A] rounded-full"></div>
            <!-- Lingkaran kecil warna E8D7CA -->
            <div class="absolute -top-28 -left-28 w-[340px] h-[340px] bg-[#E8D7CA] rounded-full"></div>
        </div>
    </div>

    <!-- Logo di atas lingkaran -->
    <img src="{{ asset('images/Logo.svg') }}" alt="MengABSEN Logo" 
         class="absolute top-8 left-8 z-10 w-24">

    <!-- Container dua kotak (items-stretch supaya tinggi sama) -->
    <div class="flex gap-8 z-10 relative items-stretch">

        <!-- Kotak Kiri: Form Input Password Baru -->
        <div class="bg-white rounded-l-lg shadow-lg flex flex-col justify-center p-8 w-[320px]">
            <h2 class="text-lg font-bold mb-6 text-center">Isilah data berikut.</h2>

            @if (session('status'))
                <div class="mb-4 text-green-600 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form method="GET" action="{{ route('login') }}" class="flex flex-col flex-1">
    @csrf
    <input type="hidden" name="token" value="dummy-token">

    <!-- Password Baru -->
    <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
        <input id="password" type="password" name="password" required
            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-[#E87F2D]">
    </div>

    <!-- Konfirmasi Password -->
    <div class="mb-4">
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required
            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-[#E87F2D]">
    </div>

    <!-- Info Kriteria Password -->
    <p class="text-sm text-red-500 mb-1">Minimal 8 karakter, maksimal 10 karakter.</p>
    <p class="text-sm text-red-500 mb-4">Kombinasi dari huruf, angka, dan simbol.</p>

    <!-- Strength Bar -->
    <label for="strength" class="text-sm">Kekuatan:</label>
    <progress id="strength" max="100" value="0" class="w-full mb-4"></progress>

    <!-- Button -->
    <button type="submit"
            class="bg-[#E87F2D] text-white py-2 rounded hover:bg-[#c96c1f]">
        Simpan Password Baru
    </button>
</form>
        </div>

        <!-- Kotak Kanan: Ilustrasi -->
        <div class="bg-white rounded-r-lg shadow-lg flex flex-col items-center justify-center p-8 w-[540px]">
            <div class="text-center">
                <h2 class="text-xl font-bold mb-4">Buat Password Baru</h2>
                <img src="{{ asset('images/newpassword.svg') }}" alt="New Password Illustration" class="w-80 mx-auto">
            </div>
        </div>

    </div>

</body>
</html>
