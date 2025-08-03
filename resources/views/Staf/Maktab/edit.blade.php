@extends('layouts.app')

@section('title', 'Edit Maktab')

@section('breadcrumb')
    <li class="flex items-center">
        <a href="{{ route('staf.maktab.index') }}" class="text-blue-600 hover:text-blue-800">Maktab</a>
        <span class="mx-2 text-gray-400">/</span>
    </li>
    <li class="flex items-center">
        <span class="text-gray-900">Edit</span>
    </li>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-6 sm:mb-8 border-b-2 border-indigo-500 pb-4">
            Edit Detail Maktab
        </h2>

        <form action="{{ route('staf.maktab.update', $maktab->id) }}" method="POST" class="space-y-5 sm:space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="nama_pemilik" class="block text-sm font-medium text-gray-700">Nama Pemilik <span class="text-red-500">*</span></label>
                <input type="text" id="nama_pemilik" name="nama_pemilik"
                       value="{{ old('nama_pemilik', $maktab->nama_pemilik) }}" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('nama_pemilik')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nomor_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon <span class="text-red-500">*</span></label>
                <input type="text" id="nomor_telepon" name="nomor_telepon"
                       value="{{ old('nomor_telepon', $maktab->nomor_telepon) }}" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('nomor_telepon')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="kapasitas_penghuni" class="block text-sm font-medium text-gray-700">Kapasitas Penghuni <span class="text-red-500">*</span></label>
                <input type="number" id="kapasitas_penghuni" name="kapasitas_penghuni"
                       value="{{ old('kapasitas_penghuni', $maktab->kapasitas_penghuni) }}" required min="1"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('kapasitas_penghuni')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="lokasi_rumah" class="block text-sm font-medium text-gray-700">Lokasi Rumah <span class="text-red-500">*</span></label>
                <input type="text" id="lokasi_rumah" name="lokasi_rumah"
                       value="{{ old('lokasi_rumah', $maktab->lokasi_rumah) }}" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       oninput="updateMapPreview()">
                @error('lokasi_rumah')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <div class="mt-4 rounded-lg overflow-hidden shadow-md border">
                    <iframe
                        id="mapPreview"
                        src="https://www.google.com/maps?q={{ urlencode(old('lokasi_rumah', $maktab->lokasi_rumah)) }}&output=embed"
                        class="w-full"
                        height="300"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <div class="mt-8 flex flex-col-reverse sm:flex-row-reverse sm:justify-end gap-3 sm:gap-4">
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>

                <a href="{{ route('staf.maktab.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function updateMapPreview() {
        const input = document.getElementById('lokasi_rumah');
        const iframe = document.getElementById('mapPreview');
        const query = encodeURIComponent(input.value);
        iframe.src = `https://www.google.com/maps?q=${query}&output=embed`;
    }
</script>
@endsection
