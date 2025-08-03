<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="icon" href="{{ asset('images/webicon.png') }}" type="image/png">

    <link rel="apple-touch-icon" href="{{ asset('images/webicon.png') }}">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-6 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-6 border-b-2 border-indigo-500 pb-4 text-center md:text-left">
                Detail Booking #{{ $booking->booking_code }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 mb-8">
                <div class="col-span-full">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle mr-3 text-indigo-500"></i> Informasi Booking
                    </h3>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Booking Code</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $booking->booking_code }}</p>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Wilayah</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $booking->region ?? 'N/A' }}</p>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Jenis Kendaraan</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $booking->vehicle_type ?? 'N/A' }}</p>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Status Booking</p>
                    <p class="text-lg font-semibold text-gray-900">
                        @if($booking->status == 'confirmed')
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">Dikonfirmasi</span>
                        @elseif($booking->status == 'pending')
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Tertunda</span>
                        @else
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">Dibatalkan</span>
                        @endif
                    </p>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Status Penjemputan</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $booking->pickup_status ?? 'N/A' }}</p>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Maktab</p>
                    <p class="text-lg font-semibold text-gray-900">
                        @if ($booking->maktab)
                            <a href="{{ route('guest.maktab', $maktab->id) }}"
                            class="text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-200"
                            title="Lihat Detail Maktab">
                                {{ $booking->maktab->nama_pemilik }} ({{ $booking->maktab->lokasi_rumah }})
                            </a>
                        @else
                            N/A
                        @endif
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 mb-8">
                <div class="col-span-full">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-users mr-3 text-indigo-500"></i> Informasi Rombongan
                    </h3>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Nama Rombongan</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $booking->group_name ?? 'N/A' }}</p>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Alamat Rombongan</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $booking->group_address ?? 'N/A' }}</p>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Jumlah Jamaah</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $booking->number_of_pilgrims ?? 'N/A' }}</p>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Jumlah Kendaraan</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $booking->number_of_vehicles ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 mb-8">
                <div class="col-span-full">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-user-tie mr-3 text-indigo-500"></i> Kontak Person
                    </h3>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Nama Ketua</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $booking->leader_name ?? 'N/A' }}</p>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Nomor Kontak</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $booking->contact_number ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 mb-8">
                <div class="col-span-full">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-clock mr-3 text-indigo-500"></i> Jadwal
                    </h3>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Waktu Kedatangan</p>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ \Carbon\Carbon::parse($booking->arrival_time)->format('d M Y, H:i A') ?? 'N/A' }}
                    </p>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Waktu Keberangkatan</p>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ \Carbon\Carbon::parse($booking->departure_time)->format('d M Y, H:i A') ?? 'N/A' }}
                    </p>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-sticky-note mr-3 text-indigo-500"></i> Catatan
                </h3>
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <p class="text-base text-gray-700 leading-relaxed">{{ $booking->notes ?? 'Tidak ada catatan.' }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 pt-6 border-t border-gray-200">
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Dibuat Pada</p>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y, H:i A') }}
                    </p>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Terakhir Diperbarui</p>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ \Carbon\Carbon::parse($booking->updated_at)->format('d M Y, H:i A') }}
                    </p>
                </div>
            </div>

            <div class="mt-8 flex flex-col sm:flex-row justify-end space-y-4 sm:space-y-0 sm:space-x-4">
                @php
                    $editLink = route('tamu.bookings.edit', [
                        'booking_code' => $booking->booking_code,
                        'token' => $booking->edit_token
                    ]);
                @endphp

                <a href="{{ route('guest.welcome') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</body>
</html>