@extends('layouts.app')

@section('title', 'Detail Maktab')

@section('breadcrumb')
    <li class="flex items-center">
        <a href="{{ route('staf.bookings.index') }}" class="text-blue-600 hover:text-blue-800">Bookings</a>
        <span class="mx-2 text-gray-400">/</span>
    </li>
    <li class="flex items-center">
        <span class="text-gray-900">Detail Maktab</span>
    </li>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8">
        {{-- Menyesuaikan ukuran font dan padding untuk mobile --}}
        <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-6 sm:mb-8 border-b-2 border-indigo-500 pb-4">
            Detail Maktab
        </h2>

        {{-- Mengatur jarak antar grid yang lebih optimal --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 sm:gap-x-8 gap-y-4 sm:gap-y-6 mb-8">
            <div class="col-span-full">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-building mr-3 text-indigo-500"></i> Informasi Maktab
                </h3>
            </div>
            <div class="flex flex-col">
                <p class="text-sm font-medium text-gray-500">Nama Pemilik</p>
                <p class="text-lg font-semibold text-gray-900">{{ $maktab->nama_pemilik ?? 'N/A' }}</p>
            </div>
            <div class="flex flex-col">
                <p class="text-sm font-medium text-gray-500">Nomor Telepon</p>
                <p class="text-lg font-semibold text-gray-900">{{ $maktab->nomor_telepon ?? 'N/A' }}</p>
            </div>
            <div class="flex flex-col">
                <p class="text-sm font-medium text-gray-500">Lokasi Rumah</p>
                <p class="text-lg font-semibold text-gray-900">{{ $maktab->lokasi_rumah ?? 'N/A' }}</p>
            </div>
            
            {{-- Menggunakan col-span-full untuk memastikan peta selalu full-width --}}
            <div class="col-span-full">
                <p class="text-sm font-medium text-gray-500">Peta Lokasi</p>
                @if ($maktab->lokasi_rumah)
                    <div class="mt-2 rounded-lg overflow-hidden shadow-md border">
                        <iframe
                            src="https://www.google.com/maps?q={{ urlencode($maktab->lokasi_rumah) }}&output=embed"
                            class="w-full"
                            height="300"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <p class="mt-2 text-sm text-gray-700 italic">{{ $maktab->lokasi_rumah }}</p>
                @else
                    <p class="text-lg font-semibold text-gray-900">Tidak tersedia</p>
                @endif
            </div>
        </div>

        {{-- Timestamps dengan jarak yang disesuaikan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 sm:gap-x-8 gap-y-4 sm:gap-y-6 pt-6 border-t border-gray-200">
            <div class="flex flex-col">
                <p class="text-sm font-medium text-gray-500">Dibuat Pada</p>
                <p class="text-lg font-semibold text-gray-900">
                    {{ \Carbon\Carbon::parse($maktab->created_at)->format('d M Y, H:i A') }}
                </p>
            </div>
            <div class="flex flex-col">
                <p class="text-sm font-medium text-gray-500">Terakhir Diperbarui</p>
                <p class="text-lg font-semibold text-gray-900">
                    {{ \Carbon\Carbon::parse($maktab->updated_at)->format('d M Y, H:i A') }}
                </p>
            </div>
        </div>

        {{-- Mengubah tata letak tombol menjadi tumpuk di mobile dan sejajar di desktop --}}
        <div class="mt-8 sm:mt-10 flex flex-col sm:flex-row sm:justify-end gap-3 sm:gap-4">
            <a href="{{ URL::previous() }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
            <a href="{{ route('staf.maktab.edit', ['maktab' => $maktab->id]) }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="fas fa-edit mr-2"></i> Edit Maktab
            </a>
        </div>
    </div>
</div>
@endsection
