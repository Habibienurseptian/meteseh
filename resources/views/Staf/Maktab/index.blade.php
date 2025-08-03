@extends('layouts.app')

@section('title', 'Daftar Maktab')

@section('breadcrumb')
    <li class="flex items-center">
        <span class="text-gray-900">Maktab</span>
    </li>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-6 sm:mb-8 border-b-2 border-indigo-500 pb-4">
            Daftar Maktab
        </h2>

        {{-- Pesan Sukses (jika ada) --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        
        {{-- Tombol Tambah dan Form Pencarian --}}
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 space-y-4 md:space-y-0">
            <a href="{{ route('staf.maktab.create') }}" class="inline-flex items-center justify-center w-full md:w-auto px-4 py-2 sm:px-6 sm:py-3 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-sm sm:text-base">
                <i class="fas fa-plus mr-2"></i> Tambah Maktab Baru
            </a>
            
            <form action="{{ route('staf.maktab.index') }}" method="GET" class="w-full md:w-auto">
                <div class="flex items-center">
                    <input type="text" name="search" placeholder="Cari lokasi atau nama pemilik..." value="{{ request('search') }}" class="border-gray-300 rounded-lg shadow-sm w-full md:w-64 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 text-sm">
                    <button type="submit" class="ml-2 bg-gray-200 text-gray-700 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-300 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        {{-- Tabel Daftar Maktab --}}
        <div class="overflow-x-auto rounded-lg shadow-sm border border-gray-200">
            <table class="min-w-full bg-white divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-3 sm:px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Lokasi Rumah</th>
                        <th class="px-3 py-3 sm:px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Nama Pemilik</th>
                        <th class="px-3 py-3 sm:px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Nomor Telepon</th>
                        <th class="hidden lg:table-cell px-3 py-3 sm:px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Map</th>
                        <th class="px-3 py-3 sm:px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($maktabs as $maktab)
                        <tr>
                            <td class="px-3 py-4 sm:px-6 text-sm text-gray-900 break-words">{{ $maktab->lokasi_rumah }}</td>
                            <td class="px-3 py-4 sm:px-6 text-sm text-gray-900 whitespace-nowrap">{{ $maktab->nama_pemilik }}</td>
                            <td class="px-3 py-4 sm:px-6 text-sm text-gray-900 whitespace-nowrap">{{ $maktab->nomor_telepon ?? '-' }}</td>
                            <td class="hidden lg:table-cell px-3 py-4 sm:px-6 text-sm text-gray-900">
                                @if ($maktab->lokasi_rumah)
                                    <iframe
                                        src="https://www.google.com/maps?q={{ urlencode($maktab->lokasi_rumah) }}&output=embed"
                                        width="200"
                                        height="150"
                                        style="border:0;"
                                        allowfullscreen=""
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                @else
                                    <span class="text-gray-500">Tidak tersedia</span>
                                @endif
                            </td>
                            <td class="px-3 py-4 sm:px-6 text-sm font-medium whitespace-nowrap">
                                <a href="{{ route('staf.maktab.show', $maktab->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2 sm:mr-3">Detail</a>
                                <a href="{{ route('staf.maktab.edit', $maktab->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2 sm:mr-3">Edit</a>
                                <form action="{{ route('staf.maktab.destroy', $maktab->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-sm text-gray-500 text-center">Tidak ada data maktab.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination Links --}}
        @if ($maktabs->hasPages())
            <div class="mt-6 flex justify-center">
                {{-- Panggil komponen --}}
                @include('components.pagination', ['paginator' => $maktabs])
            </div>
        @endif
    </div>
</div>
@endsection
