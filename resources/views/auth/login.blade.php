<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT. Smart CRM</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 font-sans antialiased text-gray-200">

    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-sm p-8 bg-gray-800 rounded-lg shadow-lg">
            <div class="text-center mb-8">
                <!-- Ganti dengan logo kustommu, atau tetap dengan teks ini -->
                <h1 class="text-3xl font-bold text-indigo-500">PT. Smart CRM</h1>
                <p class="mt-2 text-sm text-gray-400">Silakan login untuk melanjutkan</p>
            </div>

            <!-- Tampilkan pesan error jika ada -->
            @if ($errors->any())
                <div class="mb-4 bg-red-500 text-white text-sm p-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Password Input -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium mb-1">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-6">
                    <label for="remember_me" class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded text-indigo-600 bg-gray-700 border-gray-600 focus:ring-indigo-500">
                        <span class="ms-2 text-sm">Ingat saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm underline hover:text-indigo-500" href="{{ route('password.request') }}">Lupa password?</a>
                    @endif
                </div>

                <!-- Login Button -->
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition-colors duration-200">
                    Login
                </button>
            </form>

            <!-- Register Link -->
            @if (Route::has('register'))
                <p class="mt-4 text-center text-sm">Belum punya akun? 
                    <a href="{{ route('register') }}" class="underline hover:text-indigo-500">Daftar sekarang</a>
                </p>
            @endif
        </div>
    </div>

</body>
</html>
