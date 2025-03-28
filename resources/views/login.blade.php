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
    <body class="font-sans antialiased bg-neutral-900 flex items-center justify-center min-h-screen px-4">

        <div class="w-full max-w-md bg-neutral-800 border border-neutral-700 rounded-xl shadow-lg p-6">
            <div class="text-center">
                <h1 class="text-2xl font-bold text-yellow-400">Masuk</h1>
                <p class="mt-2 text-sm text-gray-400">
                    Selamat Datang Pada Sistem Tempat Sampah
                </p>
            </div>
    
            <div class="mt-5">
                <!-- Tombol Login dengan Google -->
                <a href="{{ route('google.login') }}" class="w-full py-3 px-4 flex items-center justify-center gap-x-2 text-sm font-medium rounded-lg border border-yellow-400 bg-neutral-700 text-gray-200 hover:bg-neutral-600">
                    <svg class="w-4 h-auto" width="46" height="47" viewBox="0 0 46 47" fill="none">
                        <path d="M46 24.0287C46 22.09 45.8533 20.68 45.5013 19.2112H23.4694V27.9356H36.4069C36.1429 30.1094 34.7347 33.37 31.5957 35.5731L31.5663 35.8669L38.5191 41.2719L38.9885 41.3306C43.4477 37.2181 46 31.1669 46 24.0287Z" fill="#4285F4"/>
                        <path d="M23.4694 47C29.8061 47 35.1161 44.9144 39.0179 41.3012L31.625 35.5437C29.6301 36.9244 26.9898 37.8937 23.4987 37.8937C17.2793 37.8937 12.0281 33.7812 10.1505 28.1412L9.88649 28.1706L2.61097 33.7812L2.52296 34.0456C6.36608 41.7125 14.287 47 23.4694 47Z" fill="#34A853"/>
                        <path d="M10.1212 28.1413C9.62245 26.6725 9.32908 25.1156 9.32908 23.5C9.32908 21.8844 9.62245 20.3275 10.0918 18.8588V18.5356L2.75765 12.8369L2.52296 12.9544C0.909439 16.1269 0 19.7106 0 23.5C0 27.2894 0.909439 30.8731 2.49362 34.0456L10.1212 28.1413Z" fill="#FBBC05"/>
                        <path d="M23.4694 9.07688C27.8699 9.07688 30.8622 10.9863 32.5344 12.5725L39.1645 6.11C35.0867 2.32063 29.8061 0 23.4694 0C14.287 0 6.36607 5.2875 2.49362 12.9544L10.0918 18.8588C11.9987 13.1894 17.25 9.07688 23.4694 9.07688Z" fill="#EB4335"/>
                    </svg>
                    Masuk dengan Google
                </a>
    
                <div class="py-3 flex items-center text-xs text-gray-400 uppercase before:flex-1 before:border-t before:border-gray-600 after:flex-1 after:border-t after:border-gray-600">Atau</div>
    
                <!-- Form -->
                <form>
                    <div class="grid gap-y-4">
                        <!-- Input Email -->
                        <div>
                            <label for="email" class="block text-sm text-gray-300">Email</label>
                            <input type="email" id="email" name="email" class="py-2.5 px-4 w-full border border-neutral-600 bg-neutral-700 rounded-lg text-gray-300 focus:ring-yellow-400 focus:border-yellow-400" required>
                        </div>
    
                        <!-- Input Password -->
                        <div>
                            <label for="password" class="block text-sm text-gray-300">Kata Sandi</label>
                            <input type="password" id="password" name="password" class="py-2.5 px-4 w-full border border-neutral-600 bg-neutral-700 rounded-lg text-gray-300 focus:ring-yellow-400 focus:border-yellow-400" required>
                        </div>
    
                        <!-- Checkbox -->
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" class="w-4 h-4 border border-gray-600 rounded text-yellow-400 focus:ring-yellow-500">
                            <label for="remember-me" class="ml-2 text-sm text-gray-300">Ingat saya</label>
                        </div>
    
                        <!-- Tombol Login -->
                        <button type="submit" class="w-full py-3 px-4 text-sm font-medium rounded-lg bg-yellow-400 text-gray-900 hover:bg-yellow-300 focus:ring-2 focus:ring-yellow-500">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    
    </body>
</html>
