<aside id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg p-6 flex-col items-center z-50 transform -translate-x-full transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0 lg:flex">
  <div class="flex justify-between items-center w-full mb-8">
    <div class="text-2xl font-semibold text-gray-800">HAF Meteseh</div>
    <button id="close-sidebar-button" class="lg:hidden text-gray-500 hover:text-gray-600 focus:outline-none">
      <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>
  <nav class="w-full flex-1 flex flex-col">
    {{-- ... Konten menu tetap sama ... --}}
    @guest
      <a href="{{ route('tamu.index') }}" class="flex items-center text-gray-700 hover:bg-blue-500 hover:text-white px-4 py-2 rounded-lg transition-colors duration-200 mb-2">
        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m0 0l7 7m-7-7v10a1 1 0 001 1h3" />
        </svg>
        Dashboard
      </a>
    @endguest
    @auth
      <a href="{{ route('staf.index') }}" class="flex items-center text-gray-700 hover:bg-blue-500 hover:text-white px-4 py-2 rounded-lg transition-colors duration-200 mb-2">
        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m0 0l7 7m-7-7v10a1 1 0 001 1h3" />
        </svg>
        Dashboard
      </a>
      <a href="{{ route('staf.bookings.index') }}" class="flex items-center text-gray-700 hover:bg-blue-500 hover:text-white px-4 py-2 rounded-lg transition-colors duration-200 mb-2">
        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        Bookings
      </a>
      <a href="{{ route('staf.maktab.index') }}" class="flex items-center text-gray-700 hover:bg-blue-500 hover:text-white px-4 py-2 rounded-lg transition-colors duration-200 mb-2">
        <i class="fas fa-building mr-3 h-5 w-5"></i>
        Maktab
      </a>
      <a href="{{ route('staf.register.form') }}" class="flex items-center text-gray-700 hover:bg-blue-500 hover:text-white px-4 py-2 rounded-lg transition-colors duration-200 mb-2">
          <i class="fas fa-user-plus mr-3 h-5 w-5"></i>
          Buat Akun
      </a>
      <ul class="navbar-nav w-full">
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full justify-center px-4 py-2 bg-red-100 text-red-600 hover:bg-red-600 hover:text-white rounded-lg transition-colors duration-200">
              <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
          </form>
        </li>
      </ul>
    @endauth
  </nav>
</aside>