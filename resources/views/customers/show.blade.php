<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Customer: ') . $customer->nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h3 class="text-lg font-bold mb-4">Informasi Customer</h3>
                    <div class="mb-4">
                        <p><strong>Nama:</strong> {{ $customer->nama }}</p>
                        <p><strong>Email:</strong> {{ $customer->email }}</p>
                        <p><strong>Telepon:</strong> {{ $customer->telepon }}</p>
                        <p><strong>Alamat:</strong> {{ $customer->alamat }}</p>
                    </div>

                    <h3 class="text-lg font-bold mb-4 mt-8">Daftar Layanan</h3>
                    @if ($customer->products->isEmpty())
                        <p class="text-gray-500 dark:text-gray-400">Customer ini belum memiliki layanan.</p>
                    @else
                        @php
                            $totalHarga = 0;
                        @endphp
                        <ul>
                            @foreach ($customer->products as $product)
                                @php
                                    $totalHarga += $product->harga;
                                @endphp
                                <li class="py-2 border-b border-gray-200 dark:border-gray-700">
                                    <strong>{{ $product->nama_layanan }}</strong> - Rp {{ number_format($product->harga, 0, ',', '.') }}
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $product->deskripsi }}</p>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-4 pt-4 border-t-2 border-gray-300 dark:border-gray-600">
                            <p class="text-lg font-bold">Total Harga: Rp {{ number_format($totalHarga, 0, ',', '.') }}</p>
                        </div>
                    @endif
                    
                    @if (Gate::allows('is-sales'))
                    <h3 class="text-lg font-bold mb-4 mt-8">Tambahkan Layanan Baru</h3>
                    <form action="{{ route('customers.add-product', $customer->id) }}" method="POST">
                        @csrf
                        <div class="flex items-center space-x-4">
                            <select name="product_id" required class="block w-full max-w-xs rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                                <option value="">Pilih Layanan</option>
                                @foreach ($availableProducts as $product)
                                    <option value="{{ $product->id }}">{{ $product->nama_layanan }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-200">
                                Tambah
                            </button>
                        </div>
                        @error('product_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
