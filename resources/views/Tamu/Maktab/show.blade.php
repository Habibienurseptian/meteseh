@extends('layouts.app')

@section('title', 'Detail Maktab')

@section('breadcrumb')
    <li class="flex items-center">
        <span class="text-gray-900">#{{ $booking->booking_code }}</span>
    </li>
    <span class="mx-2 text-gray-400">/</span>
    <li class="flex items-center">
        <span class="text-gray-900">Detail Maktab</span>
    </li>
@endsection


@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-8 border-b-2 border-indigo-500 pb-4">
            Detail Maktab
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 mb-10">
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
            <div class="flex flex-col">
                <p class="text-sm font-medium text-gray-500">Kapasitas Penghuni</p>
                <p class="text-lg font-semibold text-gray-900">{{ $maktab->kapasitas_penghuni ?? 'N/A' }}</p>
            </div>
            
            <div class="flex flex-col md:col-span-2">
                <p class="text-sm font-medium text-gray-500">Lokasi Rumah</p>
                @if ($maktab->lokasi_rumah)
                    <div class="mt-2 rounded overflow-hidden shadow-md border">
                        <iframe
                            src="https://www.google.com/maps?q={{ urlencode($maktab->lokasi_rumah) }}&output=embed"
                            width="100%"
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

        {{-- Timestamps --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 pt-6 border-t border-gray-200">
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

        {{-- Action Buttons --}}
        <div class="mt-10 flex justify-end space-x-4">
            {{-- Link untuk kembali ke halaman Booking sebelumnya --}}
            <a href="{{ URL::previous() }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection