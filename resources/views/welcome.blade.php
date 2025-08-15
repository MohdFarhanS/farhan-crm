<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PT. Smart - CRM</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <svg viewBox="0 0 651 379" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-16 w-auto text-gray-700 dark:text-gray-300">
                    <g clip-path="url(#clip0)" fill="#FF2D20">
                        <path d="M608.2 367.3c-.6 0-1 0-1.5.1-1.3.1-2.6.2-3.8.3-8.8.9-17.7 1.4-26.6 1.4-15.6 0-31.3-1.1-46.7-3.4-15.7-2.3-31.3-5.4-46.4-9.3-34-8.8-66.9-20.3-98.3-34.8-16.3-7.5-31.9-15.6-47.1-24.1-12.2-6.8-24.1-13.8-35.7-21.2-16.9-10.9-33-22.3-48.4-34-21.2-16.5-41.2-34-59.4-52.7-12.7-12.9-24.3-26.5-34.9-40.8-1.5-2.1-2.9-4.2-4.3-6.4C87 210.6 71.9 187 63.8 161.4c-1.5-4.8-2.9-9.5-4.2-14.3-1.5-5.2-2.8-10.4-3.9-15.6-2.1-10.1-3.6-20.2-4.3-30.4-.4-5.3-.6-10.6-.6-15.9 0-8.9.7-17.8 2-26.7 1.2-8.9 3.2-17.6 5.6-26.2 3-10.8 7.1-21.3 12.1-31.2 5.1-10 11.1-19.5 17.8-28.5 7.6-10.4 16.5-19.8 26.4-28.1 10.3-8.5 21.6-16 33.7-22.3 13.9-7.2 28.6-12.9 44-17.2 16-4.5 32.7-7.4 50-8.8 8.7-.7 17.5-1.1 26.4-1.1 12.6 0 25.1.8 37.6 2.5 13.1 1.8 25.9 4.3 38.4 7.5 24.6 6.3 48.1 15.3 70.3 27.2 11.5 6.2 22.4 13.1 32.7 20.6 15.5 11.6 29.8 24.1 42.6 37.6 24.3 25.8 45.4 53.6 62.9 83.9 8.2 14.8 15.2 30.2 21.1 46.1 2.9 7.8 5.4 15.6 7.3 23.5 2.1 8.8 3.5 17.6 4.3 26.5.7 8.9 1 17.7 1 26.7 0 10.9-1.2 21.7-3.2 32.6-2.1 11-5.1 21.7-9 32.2-4.1 11.4-9.2 22.4-15.3 32.8-6.1 10.5-13.4 20.3-21.7 29.3-9.5 10.3-20.5 19.2-32.6 26.6-13.2 8-27.7 14.3-43.2 18.9-16.1 4.8-33 8.1-50.6 9.8-13.3 1.3-26.8 2-40.4 2zM151.8 376.6c-1.3-.1-2.5-.2-3.8-.3-8.8-.9-17.7-1.4-26.6-1.4-15.6 0-31.3 1.1-46.7 3.4-15.7 2.3-31.3 5.4-46.4 9.3-34 8.8-66.9 20.3-98.3 34.8-16.3 7.5-31.9 15.6-47.1 24.1-12.2 6.8-24.1 13.8-35.7 21.2-16.9 10.9-33 22.3-48.4 34-21.2 16.5-41.2 34-59.4 52.7-12.7 12.9-24.3 26.5-34.9 40.8-1.5 2.1-2.9 4.2-4.3 6.4-11.7 17.6-26.8 41.2-34.9 66.8-1.5 4.8-2.9 9.5-4.2 14.3-1.5 5.2-2.8 10.4-3.9 15.6-2.1 10.1-3.6 20.2-4.3 30.4-.4 5.3-.6 10.6-.6 15.9 0 8.9.7 17.8 2 26.7 1.2 8.9 3.2 17.6 5.6 26.2 3 10.8 7.1 21.3 12.1 31.2 5.1 10 11.1 19.5 17.8 28.5 7.6 10.4 16.5 19.8 26.4 28.1 10.3 8.5 21.6 16 33.7 22.3 13.9 7.2 28.6 12.9 44 17.2 16 4.5 32.7 7.4 50 8.8 8.7.7 17.5 1.1 26.4 1.1 12.6 0 25.1-.8 37.6-2.5 13.1-1.8 25.9-4.3 38.4-7.5 24.6-6.3 48.1-15.3 70.3-27.2 11.5-6.2 22.4-13.1 32.7-20.6 15.5-11.6 29.8-24.1 42.6-37.6 24.3-25.8 45.4-53.6 62.9-83.9 8.2-14.8 15.2-30.2 21.1-46.1 2.9-7.8 5.4-15.6 7.3-23.5 2.1-8.8 3.5-17.6 4.3-26.5.7-8.9 1-17.7 1-26.7 0-10.9-1.2-21.7-3.2-32.6-2.1-11-5.1-21.7-9-32.2-4.1-11.4-9.2-22.4-15.3-32.8-6.1-10.5-13.4-20.3-21.7-29.3-9.5-10.3-20.5-19.2-32.6-26.6-13.2-8-27.7-14.3-43.2-18.9-16.1-4.8-33-8.1-50.6-9.8-13.3-1.3-26.8-2-40.4-2z"/>
                    </g>
                    <defs>
                        <clipPath id="clip0">
                            <path fill="#fff" d="M0 0h651v379H0z"/>
                        </clipPath>
                    </defs>
                </svg>
            </div>
        </div>
    </div>
</body>
</html>