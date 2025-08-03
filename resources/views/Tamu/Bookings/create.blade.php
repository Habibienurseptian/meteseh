@extends('layouts.app')

@section('title', 'Tambah Booking Baru')

@section('breadcrumb')
    <li class="flex items-center">
        <span class="text-gray-900">Tambah Baru</span>
    </li>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-8 border-b-2 border-indigo-500 pb-4">
            Tambah Booking Baru
        </h2>

        <form action="{{ route('tamu.bookings.store') }}" method="POST" class="space-y-8">
            @csrf

            {{-- Card for Informasi Booking --}}
            <div class="bg-gray-50 rounded-lg shadow-sm p-6 border border-gray-200">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Informasi Booking</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="region" class="block text-sm font-medium text-gray-700">Wilayah <span class="text-red-500">*</span></label>
                        <select id="region" name="region" required
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow-sm">
                            <option value="">Pilih Wilayah</option>
                            @foreach($regions as $region)
                                <option value="{{ $region }}" {{ old('region') == $region ? 'selected' : '' }}>{{ $region }}</option>
                            @endforeach
                        </select>
                        @error('region')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="vehicle_type" class="block text-sm font-medium text-gray-700">Jenis Kendaraan</label>
                        <select id="vehicle_type" name="vehicle_type"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow-sm">
                            <option value="">Pilih Jenis Kendaraan</option>
                            @foreach($vehicleTypes as $type)
                                <option value="{{ $type }}" {{ old('vehicle_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                        @error('vehicle_type')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Card for Informasi Rombongan --}}
            <div class="bg-gray-50 rounded-lg shadow-sm p-6 border border-gray-200">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Informasi Rombongan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="group_name" class="block text-sm font-medium text-gray-700">Nama Rombongan <span class="text-red-500">*</span></label>
                        <input type="text" id="group_name" name="group_name" value="{{ old('group_name') }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('group_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="group_address" class="block text-sm font-medium text-gray-700">Alamat Rombongan <span class="text-red-500">*</span></label>
                        <input type="text" id="group_address" name="group_address" value="{{ old('group_address') }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('group_address')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="number_of_pilgrims" class="block text-sm font-medium text-gray-700">Jumlah Jamaah <span class="text-red-500">*</span></label>
                        <input type="number" id="number_of_pilgrims" name="number_of_pilgrims" value="{{ old('number_of_pilgrims') }}" required min="1"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('number_of_pilgrims')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="number_of_vehicles" class="block text-sm font-medium text-gray-700">Jumlah Kendaraan</label>
                        <input type="number" id="number_of_vehicles" name="number_of_vehicles" value="{{ old('number_of_vehicles') }}" min="0"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('number_of_vehicles')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Card for Kontak Person & Jadwal --}}
            <div class="bg-gray-50 rounded-lg shadow-sm p-6 border border-gray-200">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Kontak Person & Jadwal</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="leader_name" class="block text-sm font-medium text-gray-700">Nama Ketua <span class="text-red-500">*</span></label>
                        <input type="text" id="leader_name" name="leader_name" value="{{ old('leader_name') }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('leader_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="contact_number" class="block text-sm font-medium text-gray-700">Nomor Kontak <span class="text-red-500">*</span></label>
                        <input type="text" id="contact_number" name="contact_number" value="{{ old('contact_number') }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('contact_number')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="arrival_time" class="block text-sm font-medium text-gray-700">Waktu Kedatangan <span class="text-red-500">*</span></label>
                        <input type="datetime-local" id="arrival_time" name="arrival_time" value="{{ old('arrival_time') }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('arrival_time')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="departure_time" class="block text-sm font-medium text-gray-700">Waktu Keberangkatan <span class="text-red-500">*</span></label>
                        <input type="datetime-local" id="departure_time" name="departure_time" value="{{ old('departure_time') }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('departure_time')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Card for Catatan --}}
            <div class="bg-gray-50 rounded-lg shadow-sm p-6 border border-gray-200">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Catatan Tambahan</h3>
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea id="notes" name="notes" rows="4"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-4 mt-8">
                <a href="{{ route('tamu.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-save mr-2"></i> Simpan Booking
                </button>
            </div>
        </form>
    </div>
</div>
@endsection