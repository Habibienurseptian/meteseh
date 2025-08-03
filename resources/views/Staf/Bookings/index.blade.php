@extends('layouts.app')

@section('title', 'Bookings')

@section('breadcrumb')
    <li class="flex items-center">
        <span class="text-gray-900">Bookings</span>
    </li>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg mb-6">
        {{-- Flex container untuk judul dan tombol "Tambah Booking" --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Manajemen Booking</h2>
            <a href="{{ route('staf.bookings.create')}}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out w-full md:w-auto text-center">
                <i class="fas fa-plus mr-2"></i> Tambah Booking Baru
            </a>
        </div>

        {{-- Bagian Filter dan Pencarian --}}
        <div class="mb-6 flex flex-col md:flex-row gap-4 items-center">
            <form action="{{ route('staf.bookings.index') }}" method="GET" class="w-full md:w-auto flex-grow flex items-center space-x-2">
                <div class="relative flex-1">
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

            <form action="{{ route('staf.bookings.index') }}" method="GET" class="w-full md:w-auto">
                <select name="status_filter" onchange="this.form.submit()" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    <option value="">Semua Status</option>
                    <option value="confirmed" {{ request('status_filter') == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                    <option value="pending" {{ request('status_filter') == 'pending' ? 'selected' : '' }}>Tertunda</option>
                    <option value="cancelled" {{ request('status_filter') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </form>
        </div>

        {{-- Tabel Daftar Booking --}}
        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Kode Booking</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap hidden sm:table-cell">Wilayah</th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Nama Rombongan</th>
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
                    {{-- Loop melalui data booking Anda di sini --}}
                    @forelse($bookings as $booking)
                        <tr>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800">{{ $booking->booking_code ?? 'N/A' }}</td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 hidden sm:table-cell">{{ $booking->region ?? 'N/A' }}</td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800">{{ $booking->group_name ?? 'N/A' }}</td>
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
                                    {{-- Menggunakan 'booking' sebagai nama parameter --}}
                                    <a href="{{ route('staf.bookings.show', ['booking' => $booking->id]) }}" class="text-blue-600 hover:text-blue-800 transition-colors duration-200" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('staf.bookings.edit', ['booking' => $booking->id]) }}" class="text-indigo-600 hover:text-indigo-800 transition-colors duration-200" title="Edit Booking"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('staf.bookings.destroy', ['booking' => $booking->id]) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition-colors duration-200" title="Batalkan Booking" onclick="return confirm('Apakah Anda yakin ingin menghapus booking ini?');">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            {{-- colspan disesuaikan dengan jumlah kolom yang terlihat di layar terkecil --}}
                            <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Tidak ada booking yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($bookings->hasPages())
            <div class="mt-6 flex justify-center">
                {{-- Panggil komponen --}}
                @include('components.pagination', ['paginator' => $bookings])
            </div>
        @endif
    </div>
</div>
@endsection
