<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak - 403</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white shadow-xl rounded-2xl p-8 sm:p-12 max-w-lg w-full text-center transform transition-all duration-300 hover:scale-105">
        <div class="mb-6">
            <svg class="h-24 w-24 text-indigo-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
            </svg>
        </div>
        <div class="text-gray-900 text-6xl font-extrabold mb-4 animate-pulse">403</div>
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Akses Ditolak</h1>
        <p class="text-gray-500 mb-8 max-w-sm mx-auto">
            Maaf, Anda tidak memiliki izin untuk mengakses halaman yang Anda minta.
        </p>
        <!-- <a href="{{ url()->previous() ?? url('/') }}" class="inline-block bg-indigo-600 text-white font-semibold text-lg px-8 py-3 rounded-full shadow-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-2xl">
            Kembali ke Halaman Sebelumnya
        </a> -->
    </div>

</body>
</html>