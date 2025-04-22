<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
        <script src="https://unpkg.com/preline@latest"></script>
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
        <script src="https://cdn.jsdelivr.net/npm/lodash/lodash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.21.0/ckeditor.js" integrity="sha512-ff67djVavIxfsnP13CZtuHqf7VyX62ZAObYle+JlObWZvS4/VQkNVaFBOO6eyx2cum8WtiZ0pqyxLCQKC7bjcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
        <!-- Scripts -->
        <link rel="stylesheet" href="https://preline.co/assets/css/main.min.css">
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


        <div class="min-h-screen bg-white dark:bg-gray-900">
            @include('layouts.navigation')


            <!-- Page Content -->
            <main class="bg-white dark:bg-white">
                {{ $slot }}          
            </main>
        </div>
            <!-- JS Implementing Plugins -->
    <!-- JS PLUGINS -->
    <!-- Required plugins -->
    <script src="https://cdn.jsdelivr.net/npm/preline/dist/index.js"></script>
    
    <!-- Apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/lodash/lodash.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts/dist/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/preline/dist/helper-apexcharts.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/lodash/lodash.min.js"></script>
    <script>
        const html = document.querySelector('html');
        const theme = localStorage.getItem('hs_theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    
        if (theme === 'dark' || (theme === 'auto' && prefersDark)) {
          html.classList.add('dark');
          html.classList.remove('light');
        } else {
          html.classList.add('light');
          html.classList.remove('dark');
        }
      </script>
    </body>
</html>
