@if ($paginator->hasPages())
    <div class="mt-6 flex justify-center">
        <nav class="inline-flex items-center space-x-1 text-sm">
            {{-- Tombol Sebelumnya --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 rounded-lg bg-gray-200 text-gray-500 cursor-not-allowed">
                    <i class="fas fa-angle-left"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 rounded-lg bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 transition">
                    <i class="fas fa-angle-left"></i>
                </a>
            @endif

            {{-- Halaman pertama --}}
            <a href="{{ $paginator->url(1) }}" class="px-4 py-2 rounded-lg {{ $paginator->currentPage() === 1 ? 'bg-indigo-600 text-white font-semibold shadow' : 'bg-white border border-gray-300 hover:bg-gray-100 text-gray-700' }} transition">
                1
            </a>

            {{-- Ellipsis jika halaman sekarang > 3 --}}
            @if ($paginator->currentPage() > 3)
                <span class="px-2 py-2 text-gray-500">...</span>
            @endif

            {{-- Halaman aktif (jika bukan halaman 1 atau terakhir) --}}
            @if ($paginator->currentPage() !== 1 && $paginator->currentPage() !== $paginator->lastPage())
                <span class="px-4 py-2 rounded-lg bg-indigo-600 text-white font-semibold shadow">
                    {{ $paginator->currentPage() }}
                </span>
            @endif

            {{-- Ellipsis jika masih jauh dari halaman terakhir --}}
            @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                <span class="px-2 py-2 text-gray-500">...</span>
            @endif

            {{-- Halaman terakhir --}}
            @if ($paginator->lastPage() > 1)
                <a href="{{ $paginator->url($paginator->lastPage()) }}" class="px-4 py-2 rounded-lg {{ $paginator->currentPage() === $paginator->lastPage() ? 'bg-indigo-600 text-white font-semibold shadow' : 'bg-white border border-gray-300 hover:bg-gray-100 text-gray-700' }} transition">
                    {{ $paginator->lastPage() }}
                </a>
            @endif

            {{-- Tombol Selanjutnya --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 rounded-lg bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 transition">
                    <i class="fas fa-angle-right"></i>
                </a>
            @else
                <span class="px-3 py-2 rounded-lg bg-gray-200 text-gray-500 cursor-not-allowed">
                    <i class="fas fa-angle-right"></i>
                </span>
            @endif
        </nav>
    </div>
@endif
