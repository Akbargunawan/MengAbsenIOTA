<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - MengABSEN</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex">

    <!-- Left side -->
    <div class="flex-1 bg-white flex items-center justify-center">
        <div class="text-center">
            <img src="{{ asset('images/Logo.svg') }}" alt="MengABSEN Logo" class="w-80 mx-auto" />
        </div>
    </div>

    <!-- Right side with curve -->
    <div class="relative flex-1 bg-[#DB7E2A] flex items-center justify-center">
        <svg class="absolute top-0 -left-0 h-full w-40 text-white" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0,0 C60,50 60,50 0,100 L0,0 Z" fill="currentColor" />
        </svg>

        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm relative z-10">
            <h2 class="text-xl font-semibold mb-6">Sign In</h2>

            <form method="POST" action="{{ route('login.submit') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm mb-1">Username</label>
                    <input type="text" name="username" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#DB7E2A]" required>
                </div>
                <div>
                    <label class="block text-sm mb-1">Password</label>
                    <input type="password" name="password" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#DB7E2A]" required>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" class="mr-2"> Ingat Saya
                    </label>
                    <a href="{{ route('password.request') }}" class="text-red-500 hover:underline">Lupa Password?</a>
                </div>

                @if($errors->any())
                    <div class="text-red-500 text-sm mb-2">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button type="submit" class="w-full bg-[#DB7E2A] text-white py-2 rounded hover:bg-[#c67121]">
                    Login
                </button>
            </form>
        </div>
    </div>

</body>
</html>
