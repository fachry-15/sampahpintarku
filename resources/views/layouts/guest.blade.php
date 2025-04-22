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
    <body class="font-sans antialiased">
        @if (session('notify.message'))
        <div id="alert-box" class="fixed top-5 right-5 z-50 w-full max-w-sm mx-auto transition-opacity duration-500 opacity-0">
            @php
                $type = session('notify.type');
                $message = session('notify.message');
            @endphp
    
            @if ($type === 'success')
                <div class="bg-teal-50 border-t-2 border-teal-500 rounded-lg p-4 dark:bg-teal-800/30 shadow-lg" role="alert" tabindex="-1" aria-labelledby="hs-bordered-success-style-label">
                    <div class="flex">
                        <div class="shrink-0">
                            <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-teal-100 bg-teal-200 text-teal-800 dark:border-teal-900 dark:bg-teal-800 dark:text-teal-400">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                                    <path d="m9 12 2 2 4-4"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="ms-3">
                            <h3 class="text-gray-800 font-semibold dark:text-white">Sukses!</h3>
                            <p class="text-sm text-gray-700 dark:text-neutral-400">{{ $message }}</p>
                        </div>
                    </div>
                </div>
            @elseif ($type === 'error')
                <div class="bg-red-50 border-s-4 border-red-500 p-4 dark:bg-red-800/30 shadow-lg" role="alert" tabindex="-1" aria-labelledby="hs-bordered-red-style-label">
                    <div class="flex">
                        <div class="shrink-0">
                            <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-red-100 bg-red-200 text-red-800 dark:border-red-900 dark:bg-red-800 dark:text-red-400">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="ms-3">
                            <h3 class="text-gray-800 font-semibold dark:text-white">Gagal!</h3>
                            <p class="text-sm text-gray-700 dark:text-neutral-400">{{ $message }}</p>
                        </div>
                    </div>
                </div>
            @endif
    
            <script>
                const box = document.getElementById('alert-box');
                if (box) {
                    // Fade-in
                    setTimeout(() => {
                        box.classList.remove('opacity-0');
                        box.classList.add('opacity-100');
                    }, 100);
    
                    // Fade-out after 3s
                    setTimeout(() => {
                        box.classList.remove('opacity-100');
                        box.classList.add('opacity-0');
                    }, 3100);
    
                    // Remove after fade-out
                    setTimeout(() => {
                        box.remove();
                    }, 3600);
                }
            </script>
        </div>
    @endif
        <div class="min-h-screen bg-neutral-900 dark:bg-white">
             @include('layouts.navbar')

            <!-- Page Content -->
            <main class="bg-neutral-900 dark:bg-white">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
