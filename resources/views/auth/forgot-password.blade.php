<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - PT. Smart CRM</title>
    
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
                <h1 class="text-3xl font-bold text-indigo-500">Lupa Password</h1>
                <p class="mt-2 text-sm text-gray-400">Masukkan alamat emailmu untuk mereset password.</p>
            </div>

            <!-- Tampilkan pesan status jika ada (misalnya, password reset link sudah dikirim) -->
            @if (session('status'))
                <div class="mb-4 bg-green-500 text-white text-sm p-3 rounded">
                    {{ session('status') }}
                </div>
            @endif

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

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Input -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Kirim Link Reset Password -->
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition-colors duration-200">
                    Kirim Link Reset Password
                </button>
            </form>

            <p class="mt-4 text-center text-sm">
                <a href="{{ route('login') }}" class="underline hover:text-indigo-500">Kembali ke halaman login</a>
            </p>
        </div>
    </div>
</body>
</html>
