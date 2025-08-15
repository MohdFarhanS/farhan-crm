<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6 text-gray-200">
                    <h3 class="text-lg font-bold mb-6">Ringkasan Proyek</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                        <div class="bg-indigo-600 rounded-lg p-6 text-white shadow-lg flex items-center justify-between">
                            <div>
                                <div class="text-sm font-light">Total Proyek</div>
                                <div class="text-4xl font-bold mt-2">{{ $totalProjects }}</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-200 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>

                        <div class="bg-yellow-500 rounded-lg p-6 text-white shadow-lg flex items-center justify-between">
                            <div>
                                <div class="text-sm font-light">Menunggu Persetujuan</div>
                                <div class="text-4xl font-bold mt-2">{{ $pendingProjects }}</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-yellow-200 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                        <div class="bg-green-500 rounded-lg p-6 text-white shadow-lg flex items-center justify-between">
                            <div>
                                <div class="text-sm font-light">Disetujui</div>
                                <div class="text-4xl font-bold mt-2">{{ $approvedProjects }}</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-200 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                        <div class="bg-red-500 rounded-lg p-6 text-white shadow-lg flex items-center justify-between">
                            <div>
                                <div class="text-sm font-light">Ditolak</div>
                                <div class="text-4xl font-bold mt-2">{{ $rejectedProjects }}</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-200 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        
                        <div class="bg-teal-500 rounded-lg p-6 text-white shadow-lg flex items-center justify-between col-span-full md:col-span-2 lg:col-span-1">
                            <div>
                                <div class="text-sm font-light">Pendapatan Bulan Ini</div>
                                <div class="text-4xl font-bold mt-2">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-teal-200 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 6v2m0 4v2m-6 0h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
