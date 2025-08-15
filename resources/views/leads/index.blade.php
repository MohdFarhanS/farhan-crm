<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Daftar Calon Customer (Leads)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-white">Data Leads</h3>
                        @if (auth()->user()->role === 'sales')
                            <a href="{{ route('leads.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-200">
                                Tambah Calon Customer
                            </a>
                        @endif
                    </div>
                    
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
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr class="bg-gray-700">
                                    <th class="px-5 py-3 border-b-2 border-gray-600 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                        Nama
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-600 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-600 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                        Telepon
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-600 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-600">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($leads as $lead)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-700 text-sm">
                                            {{ $lead->nama }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-700 text-sm">
                                            {{ $lead->email }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-700 text-sm">
                                            {{ $lead->telepon }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-700 text-sm">
                                            @if ($lead->status === 'Baru')
                                                <span class="relative inline-block px-3 py-1 font-semibold text-yellow-900 leading-tight">
                                                    <span aria-hidden="true" class="absolute inset-0 bg-yellow-200 opacity-50 rounded-full"></span>
                                                    <span class="relative text-yellow-800">{{ $lead->status }} 1</span>
                                                </span>
                                            @elseif ($lead->status === 'Diproses')
                                                <span class="relative inline-block px-3 py-1 font-semibold text-blue-900 leading-tight">
                                                    <span aria-hidden="true" class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                                                    <span class="relative text-blue-800">{{ $lead->status }} 2</span>
                                                </span>
                                            @else
                                                @if ($lead->status === 'Ditolak')
                                                    <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                        <span aria-hidden="true" class="absolute inset-0 bg-red-200 dark:bg-red-700 opacity-50 rounded-full"></span>
                                                        <span class="relative text-red-800 dark:text-red-200">{{ $lead->status }}</span>
                                                    </span>
                                                @else
                                                    <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                        <span aria-hidden="true" class="absolute inset-0 bg-green-200 dark:bg-green-700 opacity-50 rounded-full"></span>
                                                        <span class="relative text-green-800 dark:text-green-200">{{ $lead->status }}</span>
                                                    </span>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-700 text-sm text-right space-x-2">
                                            @if (auth()->user()->role === 'manager' && $lead->status === 'Baru')
                                                <a href="{{ route('projects.create', $lead->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-lg transition-colors duration-200">Proses</a>
                                            @endif
                                            @if (auth()->user()->role === 'sales' && $lead->status === 'Baru')
                                                <a href="{{ route('leads.edit', $lead->id) }}" class="text-indigo-400 hover:text-indigo-200 font-bold text-sm">Edit</a>
                                            @endif
                                            <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-200 font-bold text-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-5 py-5 text-center text-gray-500 text-sm">
                                            Belum ada calon customer.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
