@extends('layouts.app')

@section('title', 'Edit Booking')

@section('breadcrumb')
    <li class="flex items-center">
        <a href="{{ route('staf.bookings.index') }}" class="text-blue-600 hover:text-blue-800">Bookings</a>
        <span class="mx-2 text-gray-400">/</span>
    </li>
    <li class="flex items-center">
        <span class="text-gray-900">Edit Booking #{{ $booking->booking_code }}</span>
    </li>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8">
        {{-- Mengubah ukuran font H2 agar lebih kecil di mobile --}}
        <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-6 sm:mb-8 border-b-2 border-indigo-500 pb-4">
            Edit Booking #{{ $booking->booking_code }}
        </h2>

        <form action="{{ route('staf.bookings.update', ['booking' => $booking->id]) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Menyesuaikan gap antar kolom dan baris --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 sm:gap-x-8 gap-y-5 sm:gap-y-6 mb-6">

                {{-- ID Booking (Readonly) --}}
                <div>
                    <label for="id" class="block text-sm font-medium text-gray-700">Booking Code</label>
                    <input type="text" name="id" id="id" value="{{ $booking->booking_code }}" class="mt-1 block w-full px-3 py-2 shadow-sm sm:text-sm border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                </div>

                {{-- Wilayah --}}
                <div>
                    <label for="region" class="block text-sm font-medium text-gray-700">Wilayah</label>
                    <input type="text" name="region" id="region" value="{{ old('region', $booking->region) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('region') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Jenis Kendaraan --}}
                <div>
                    <label for="vehicle_type" class="block text-sm font-medium text-gray-700">Jenis Kendaraan</label>
                    <input type="text" name="vehicle_type" id="vehicle_type" value="{{ old('vehicle_type', $booking->vehicle_type) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('vehicle_type') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Status Booking --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status Booking</label>
                    <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Tertunda</option>
                        <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    @error('status') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Status Penjemputan --}}
                <div>
                    <label for="pickup_status" class="block text-sm font-medium text-gray-700">Status Penjemputan</label>
                    <select id="pickup_status" name="pickup_status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">-- Pilih Status Penjemputan --</option>
                        <option value="Menunggu Penjemputan" {{ old('pickup_status', $booking->pickup_status) == 'Menunggu Penjemputan' ? 'selected' : '' }}>Menunggu Penjemputan</option>
                        <option value="Sudah Dijemput" {{ old('pickup_status', $booking->pickup_status) == 'Sudah Dijemput' ? 'selected' : '' }}>Sudah Dijemput</option>
                        <option value="Dibatalkan" {{ old('pickup_status', $booking->pickup_status) == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    @error('pickup_status') 
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p> 
                    @enderror
                </div>

                {{-- Nama Rombongan --}}
                <div>
                    <label for="group_name" class="block text-sm font-medium text-gray-700">Nama Rombongan</label>
                    <input type="text" name="group_name" id="group_name" value="{{ old('group_name', $booking->group_name) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('group_name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Alamat Rombongan --}}
                <div class="col-span-full"> {{-- Menggunakan col-span-full agar textarea mengambil seluruh lebar di semua layar --}}
                    <label for="group_address" class="block text-sm font-medium text-gray-700">Alamat Rombongan</label>
                    <textarea id="group_address" name="group_address" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('group_address', $booking->group_address) }}</textarea>
                    @error('group_address') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Jumlah Jamaah --}}
                <div>
                    <label for="number_of_pilgrims" class="block text-sm font-medium text-gray-700">Jumlah Jamaah</label>
                    <input type="number" name="number_of_pilgrims" id="number_of_pilgrims" value="{{ old('number_of_pilgrims', $booking->number_of_pilgrims) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('number_of_pilgrims') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Jumlah Kendaraan --}}
                <div>
                    <label for="number_of_vehicles" class="block text-sm font-medium text-gray-700">Jumlah Kendaraan</label>
                    <input type="number" name="number_of_vehicles" id="number_of_vehicles" value="{{ old('number_of_vehicles', $booking->number_of_vehicles) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('number_of_vehicles') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Nama Ketua --}}
                <div>
                    <label for="leader_name" class="block text-sm font-medium text-gray-700">Nama Ketua</label>
                    <input type="text" name="leader_name" id="leader_name" value="{{ old('leader_name', $booking->leader_name) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('leader_name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Nomor Kontak --}}
                <div>
                    <label for="contact_number" class="block text-sm font-medium text-gray-700">Nomor Kontak</label>
                    <input type="tel" name="contact_number" id="contact_number" value="{{ old('contact_number', $booking->contact_number) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('contact_number') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Waktu Kedatangan --}}
                <div>
                    <label for="arrival_time" class="block text-sm font-medium text-gray-700">Waktu Kedatangan</label>
                    <input type="datetime-local" name="arrival_time" id="arrival_time" value="{{ old('arrival_time', \Carbon\Carbon::parse($booking->arrival_time)->format('Y-m-d\TH:i')) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('arrival_time') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Waktu Keberangkatan --}}
                <div>
                    <label for="departure_time" class="block text-sm font-medium text-gray-700">Waktu Keberangkatan</label>
                    <input type="datetime-local" name="departure_time" id="departure_time" value="{{ old('departure_time', \Carbon\Carbon::parse($booking->departure_time)->format('Y-m-d\TH:i')) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('departure_time') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Maktab --}}
                <div>
                    <label for="maktab_id" class="block text-sm font-medium text-gray-700">Maktab</label>
                    <select id="maktab_id" name="maktab_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow-sm">
                        <option value="">Pilih Maktab</option>
                        @foreach($maktabs as $maktabOption)
                            <option value="{{ $maktabOption->id }}" {{ old('maktab_id', $booking->maktab_id ?? '') == $maktabOption->id ? 'selected' : '' }}>
                                {{ $maktabOption->nama_pemilik }} ({{ $maktabOption->lokasi_rumah }})
                            </option>
                        @endforeach
                    </select>
                    @error('maktab_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Catatan --}}
                <div class="col-span-full">
                    <label for="notes" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea id="notes" name="notes" rows="5" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('notes', $booking->notes) }}</textarea>
                    @error('notes') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Mengatur agar tombol menjadi satu kolom dan full-width di mobile --}}
            <div class="mt-8 flex flex-col-reverse sm:flex-row sm:justify-end gap-3 sm:gap-4">
                <a href="{{ route('staf.bookings.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-arrow-left mr-2"></i> Batal
                </a>
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>
        {{-- Script JavaScript dipertahankan --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const statusSelect = document.getElementById('status');
                const maktabSelect = document.getElementById('maktab_id');
                const form = document.querySelector('form');

                form.addEventListener('submit', function (e) {
                    const status = statusSelect.value;
                    const maktab = maktabSelect.value;

                    // Jika status = confirmed tapi maktab kosong
                    if (status === 'confirmed' && !maktab) {
                        e.preventDefault();
                        alert('Anda harus memilih maktab jika status dikonfirmasi.');
                        maktabSelect.focus();
                        return;
                    }

                    // Jika maktab dipilih tapi status bukan confirmed
                    if (maktab && status !== 'confirmed') {
                        e.preventDefault();
                        alert('Status harus dikonfirmasi jika maktab dipilih.');
                        statusSelect.focus();
                        return;
                    }
                });
            });
        </script>
    </div>
</div>
@endsection