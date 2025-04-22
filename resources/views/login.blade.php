<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sampah Pintarku') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#27a67a] font-sans antialiased flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-2xl shadow-lg flex overflow-hidden max-w-4xl w-full">
        <!-- Left Section -->
        <div class="w-1/2 p-8 flex flex-col justify-center">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-[#27a67a]">Selamat Datang</h1>
                <p class="mt-2 text-gray-600 text-sm">Masuk untuk melanjutkan ke dashboard Anda</p>
            </div>

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-5 mt-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required placeholder="Masukkan email Anda"
                        class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:border-[#27a67a] focus:ring-[#27a67a] text-gray-700">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                    <input type="password" id="password" name="password" required placeholder="Masukkan kata sandi Anda"
                        class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:border-[#27a67a] focus:ring-[#27a67a] text-gray-700">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center text-sm text-gray-600">
                        <input type="checkbox" id="remember-me" name="remember"
                            class="w-4 h-4 text-[#27a67a] border-gray-300 rounded focus:ring-[#27a67a]">
                        <span class="ml-2">Ingat saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-[#27a67a] text-white py-3 rounded-lg font-semibold text-sm hover:bg-[#21976d] transition duration-200">
                    Masuk
                </button>
            </form>

            <!-- Divider -->
            <div class="flex items-center my-4">
                <hr class="flex-grow border-gray-300">
                <span class="px-2 text-sm text-gray-500">atau</span>
                <hr class="flex-grow border-gray-300">
            </div>

            <!-- Google Login Button -->
            <a href="{{ route('google.login') }}"
                class="w-full flex items-center justify-center bg-[#27a67a] text-white py-3 rounded-lg font-semibold text-sm hover:bg-[#21976d] transition duration-200">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                    <path fill="#ffffff" d="M24 9.5c3.5 0 6.6 1.3 9 3.4l6.7-6.7C35.6 2.7 30.1 0 24 0 14.6 0 6.4 5.8 2.5 14.2l7.8 6.1C12.1 13.2 17.6 9.5 24 9.5z"/>
                    <path fill="#ffffff" d="M46.5 24c0-1.6-.2-3.2-.5-4.7H24v9h12.7c-1.1 3.2-3.3 5.9-6.2 7.7l7.8 6.1c4.6-4.3 7.2-10.6 7.2-18.1z"/>
                    <path fill="#ffffff" d="M10.3 28.3c-1.1-3.2-1.1-6.8 0-10l-7.8-6.1C.7 16.8 0 20.3 0 24s.7 7.2 2.5 10.2l7.8-6.1z"/>
                    <path fill="#ffffff" d="M24 48c6.5 0 12-2.1 16-5.7l-7.8-6.1c-2.2 1.5-5 2.4-8.2 2.4-6.4 0-11.9-3.7-14.5-9l-7.8 6.1C6.4 42.2 14.6 48 24 48z"/>
                    <path fill="none" d="M0 0h48v48H0z"/>
                </svg>
                Masuk dengan Google
            </a>
        </div>

        <!-- Right Section -->
        <div class="w-1/2">
            <img src="{{ asset('images/login.svg') }}" alt="Illustration" class="w-full h-full object-cover">
        </div>
    </div>
</body>
</html>
