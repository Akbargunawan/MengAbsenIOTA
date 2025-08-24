<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lupa Password - MengABSEN</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

        <!-- Kotak Kiri (border kanan lurus) -->
        <div class="bg-white shadow-lg flex flex-col items-center justify-center p-8 w-[540px] rounded-l-lg rounded-r-none">
            <div class="text-center">
                <h2 class="text-xl font-bold mb-4">Lupa Password?</h2>
                <img src="{{ asset('images/forgotpassword.svg') }}" alt="Forgot Password" class="w-80 mx-auto">
            </div>
        </div>

        <!-- Kotak Kanan (border kiri lurus) -->
        <div class="bg-white shadow-lg p-8 w-[320px] flex flex-col justify-center rounded-r-lg rounded-l-none">
            <h2 class="text-lg font-bold mb-6">Tolong Masukan Email Anda.</h2>

            @if (session('status'))
                <div class="mb-4 text-green-600 text-sm">
                    {{ session('status') }}
                </div>
            @endif

           <form method="GET" action="{{ route('new-password') }}" class="flex flex-col flex-1">
    <!-- Email Input -->
    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-[#E87F2D]">
        @error('email')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <p class="text-sm text-gray-500 mb-4">
        Apakah Anda yakin ingin mengirim email untuk mereset password?
    </p>

    <!-- Buttons -->
    <div class="flex gap-3 mt-auto">
        <a href="{{ route('login') }}" 
           class="flex-1 border border-[#E87F2D] text-[#E87F2D] text-center py-2 rounded hover:bg-orange-50">
            Batal
        </a>
        <button type="submit"
                class="flex-1 bg-[#E87F2D] text-white py-2 rounded hover:bg-[#c96c1f]">
            Kirim
        </button>
    </div>
</form>


        </div>

    </div>

</body>
</html>
