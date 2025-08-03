@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    {{-- Grid untuk kartu ringkasan --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Total Bookings Card --}}
        <div class="bg-white p-6 rounded-xl shadow-md flex flex-col justify-between items-start transition-transform duration-200 hover:scale-105">
            <div class="flex items-center justify-between w-full mb-2">
                <h3 class="text-gray-500 text-sm font-medium uppercase">Total Bookings</h3>
                <i class="fas fa-calendar-check text-blue-500 text-2xl"></i>
            </div>
            <p class="text-4xl font-extrabold text-gray-900">{{ $totalBookings }}</p>
        </div>

        {{-- Total Orang Card --}}
        <div class="bg-white p-6 rounded-xl shadow-md flex flex-col justify-between items-start transition-transform duration-200 hover:scale-105">
            <div class="flex items-center justify-between w-full mb-2">
                <h3 class="text-gray-500 text-sm font-medium uppercase">Total Orang</h3>
                <i class="fas fa-users text-green-500 text-2xl"></i>
            </div>
            <p class="text-4xl font-extrabold text-gray-900">{{ $totalOrang }}</p>
        </div>

        {{-- Total Kendaraan Card --}}
        <div class="bg-white p-6 rounded-xl shadow-md flex flex-col justify-between items-start transition-transform duration-200 hover:scale-105">
            <div class="flex items-center justify-between w-full mb-2">
                <h3 class="text-gray-500 text-sm font-medium uppercase">Total Kendaraan</h3>
                <i class="fas fa-car text-yellow-500 text-2xl"></i>
            </div>
            <p class="text-4xl font-extrabold text-gray-900">{{ $totalKendaraan }}</p>
        </div>

        {{-- Total Rumah Card --}}
        <div class="bg-white p-6 rounded-xl shadow-md flex flex-col justify-between items-start transition-transform duration-200 hover:scale-105">
            <div class="flex items-center justify-between w-full mb-2">
                <h3 class="text-gray-500 text-sm font-medium uppercase">Total Maktab</h3>
                <i class="fas fa-home text-red-500 text-2xl"></i>
            </div>
            <p class="text-4xl font-extrabold text-gray-900">{{ $totalMaktab }}</p>
        </div>
    </div>

    <div class="bg-white p-8 rounded-xl shadow-lg">
        {{-- Judul, form pencarian, dan tombol "Tambah Booking" --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Maktab Bookings</h2>
            <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4 w-full md:w-auto">
                {{-- Search Form --}}
                <form action="{{ route('tamu.index') }}" method="GET" class="w-full md:w-auto flex items-center space-x-2">
                    <div class="relative flex-grow">
                        <input
                            type="text"
                            name="search"
                            placeholder="Cari booking..."
                            value="{{ request('search') }}"
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full text-sm shadow-sm"
                        >
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out flex-shrink-0">
                        Cari
                    </button>
                </form>
                {{-- Add Booking Button --}}
                <a href="{{ route('tamu.bookings.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out w-full md:w-auto text-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Booking
                </a>
            </div>
        </div>

        {{-- Tabel Recent Bookings --}}
        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Kode Booking</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap hidden sm:table-cell">Wilayah</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Nama Rombongan</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap hidden lg:table-cell">Alamat Rombongan</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap hidden md:table-cell">Nama Ketua</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap hidden lg:table-cell">Jumlah Jamaah</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap hidden md:table-cell">Waktu Kedatangan</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Status</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap hidden xl:table-cell">Penjemputan</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap hidden sm:table-cell">Maktab</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentBookings as $booking)
                        <tr>
                            <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $booking->booking_code }}</td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 hidden sm:table-cell">{{ $booking->region ?? 'N/A' }}</td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800">{{ $booking->group_name ?? 'N/A' }}</td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 hidden lg:table-cell">{{ $booking->group_address ?? 'N/A' }}</td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 hidden md:table-cell">{{ $booking->leader_name ?? 'N/A' }}</td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 hidden lg:table-cell">{{ $booking->number_of_pilgrims ?? 'N/A' }}</td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 hidden md:table-cell">{{ \Carbon\Carbon::parse($booking->arrival_time)->format('Y-m-d H:i A') ?? 'N/A' }}</td>
                            <td class="px-3 py-4 whitespace-nowrap">
                                @if($booking->status == 'confirmed')
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Dikonfirmasi</span>
                                @elseif($booking->status == 'pending')
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Tertunda</span>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Dibatalkan</span>
                                @endif
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 hidden xl:table-cell">{{ $booking->pickup_status ?? 'N/A' }}</td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900 hidden sm:table-cell">
                                @if ($booking->maktab)
                                    {{ $booking->maktab->nama_pemilik }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('tamu.bookings.show', ['id' => $booking->id]) }}" class="text-blue-600 hover:text-blue-800 transition-colors duration-200" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            {{-- colspan disesuaikan dengan jumlah kolom yang terlihat di layar terkecil (5 kolom) --}}
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Tidak ada booking terbaru yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($recentBookings->hasPages())
            <div class="mt-6 flex justify-center">
                {{-- Panggil komponen --}}
                @include('components.pagination', ['paginator' => $recentBookings])
            </div>
        @endif
    </div>
</div>
@endsection
