<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAF Meteseh 2025</title>
    <!-- Tailwind CSS CDN untuk styling yang mudah dan responsif -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Mengimpor font Inter dari Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <!-- Tambahkan Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Jika menggunakan .png -->
    <link rel="icon" href="{{ asset('images/webicon.png') }}" type="image/png">

    <!-- Jika ingin dukungan Apple -->
    <link rel="apple-touch-icon" href="{{ asset('images/webicon.png') }}">
        
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Header / Navbar -->
    <header class="bg-white shadow-md">
        <nav class="container mx-auto p-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/webicon.png') }}" alt="Logo" class="h-10 w-10 rounded-full">
                <span class="text-1xl font-bold text-black">HAF Meteseh 2025</span>
            </div>

            <!-- <div id="main-menu" class="hidden md:flex items-center space-x-6">
                <a href="{{ route('tamu.index') }}" class="text-gray-600 hover:text-indigo-700 font-medium transition-colors">Dashboard</a>
            </div> -->

            <div class="flex items-center space-x-4">
                <!-- <a href="{{ route('staf.register.form') }}" class="text-gray-600 hover:text-indigo-700 transition-colors hidden md:block">Register</a> -->
                <a href="{{ route('login') }}" class="bg-gray-800 text-white font-semibold py-2 px-5 rounded-lg shadow-lg hover:bg-gray-900 transition-colors">Login</a>
            </div>
        </nav>
    </header>

    <!-- Konten Utama -->
    <main class="container mx-auto p-8">
        
        <!-- Bagian Pencarian Utama -->
        <section class="text-center my-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Temukan Maktab Anda</h1>
            <p class="text-gray-600 mb-6">Cari dengan HAF Meteseh ID, nama rombongan, atau kontak ketua</p>
            <form action="/" method="GET" class="relative w-full max-w-2xl mx-auto">
                <input type="text" name="search" placeholder="Cari detail pemesanan..." value="{{ $search ?? '' }}" class="w-full pl-12 pr-28 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-shadow">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <button type="submit" class="absolute inset-y-0 right-0 px-6 py-2 bg-gray-800 text-white rounded-r-lg font-medium hover:bg-gray-900 transition-colors">Cari</button>
            </form>
        </section>

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

        <!-- Bagian Hasil Pencarian yang Ditingkatkan -->
        @if ($search)
        <section class="my-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Hasil Pencarian untuk "{{ $search }}"</h2>
            <div class="bg-white p-6 rounded-xl shadow-md overflow-x-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-gray-500 uppercase border-b bg-gray-50">
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
                        @forelse($bookings as $booking)
                        <tr class="text-gray-700 hover:bg-gray-100">
                            <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $booking->booking_code }}</td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 hidden sm:table-cell">{{ $booking->region ?? 'N/A' }}</td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800">{{ $booking->group_name ?? 'N/A' }}</td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 hidden md:table-cell">{{ $booking->leader_name ?? 'N/A' }}</td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 hidden lg:table-cell">{{ $booking->number_of_pilgrims ?? 'N/A' }}</td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 hidden md:table-cell">{{ $booking->arrival_time ?? 'N/A' }}</td>
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
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900 hidden sm:table-cell">@if ($booking->maktab)
                                    {{ $booking->maktab->nama_pemilik }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('guest.detail', ['id' => $booking->id]) }}" class="text-blue-600 hover:text-blue-800 transition-colors duration-200" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Tidak ada hasil ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Tombol untuk menghapus filter pencarian -->
            <div class="text-center mt-6">
                <a href="/" class="text-blue-600 hover:underline">Hapus Pencarian</a>
            </div>
        </section>
        @endif
    </main>

    <!-- Footer -->
    <footer class="text-center text-sm text-gray-500 py-6">
        <p>Terakhir Diperbarui: {{ $lastUpdated }}</p>
    </footer>

</body>
</html>
