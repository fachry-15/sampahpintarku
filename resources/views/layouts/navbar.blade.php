<!-- ========== HEADER ========== -->
<header class="sticky top-4 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full ">
    <nav class="relative max-w-[66rem] w-full bg-neutral-800 rounded-[28px] py-3 ps-5 pe-2 md:flex md:items-center md:justify-between md:py-0 mx-2 lg:mx-auto" aria-label="Global">
      <div class="flex items-center justify-between">
        <!-- Logo -->
        <a class="flex-none rounded-md text-xl inline-block font-semibold focus:outline-none focus:opacity-80" href="../../templates/agency/index.html" aria-label="Preline">
          <img src="{{ asset('icons/logo-dark.svg') }}" alt="Logo" class="w-24 h-auto">
        </a>
        <!-- End Logo -->

        <div class="md:hidden">
          <button type="button" class="hs-collapse-toggle size-8 flex justify-center items-center text-sm font-semibold rounded-full bg-neutral-800 text-white disabled:opacity-50 disabled:pointer-events-none" data-hs-collapse="#navbar-collapse" aria-controls="navbar-collapse" aria-label="Toggle navigation">
            <svg class="hs-collapse-open:hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="3" x2="21" y1="6" y2="6" />
              <line x1="3" x2="21" y1="12" y2="12" />
              <line x1="3" x2="21" y1="18" y2="18" />
            </svg>
            <svg class="hs-collapse-open:block hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 6 6 18" />
              <path d="m6 6 12 12" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Collapse -->
      <div id="navbar-collapse" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block">
        <div class="flex flex-col gap-y-4 gap-x-0 mt-5 md:flex-row md:items-center md:justify-end md:gap-y-0 md:gap-x-7 md:mt-0 md:ps-7">
          <a class="text-sm text-white hover:text-neutral-300 md:py-4 focus:outline-none focus:text-neutral-300" href="{{ route('dashboard') }}" aria-current="page">Dashboard</a>
          <a class="text-sm text-white hover:text-neutral-300 md:py-4 focus:outline-none focus:text-neutral-300" href="#">Tentang</a>
          <a class="text-sm text-white hover:text-neutral-300 md:py-4 focus:outline-none focus:text-neutral-300" href="#">Layanan</a>
          <a class="text-sm text-white hover:text-neutral-300 md:py-4 focus:outline-none focus:text-neutral-300" href="#">Kontak</a>
          @auth
          <a class="text-sm text-white hover:text-neutral-300 md:py-4 focus:outline-none focus:text-neutral-300" href="{{ route('dashboard') }}">Pusat Monitoring</a>
          @endauth
        <div>
          <div class="flex items-center gap-2">
            <!-- Tombol Light/Dark Mode -->
            <button type="button" 
        class="hs-dark-mode-active:hidden block hs-dark-mode font-medium text-neutral-200 rounded-full 
              hover:text-neutral-900 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 
              transition-all duration-300" 
        data-hs-theme-click-value="dark">
        <span class="group inline-flex shrink-0 justify-center items-center size-9">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
              stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
          </svg>
        </span>
      </button>
    
      <button type="button" 
        class="hs-dark-mode-active:block hidden hs-dark-mode font-medium text-neutral-200 rounded-full 
              hover:text-neutral-900 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 
              transition-all duration-300" 
        data-hs-theme-click-value="light">
        <span class="group inline-flex shrink-0 justify-center items-center size-9">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
              stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="4"></circle>
            <path d="M12 2v2"></path>
            <path d="M12 20v2"></path>
            <path d="m4.93 4.93 1.41 1.41"></path>
            <path d="m17.66 17.66 1.41 1.41"></path>
            <path d="M2 12h2"></path>
            <path d="M20 12h2"></path>
            <path d="m6.34 17.66-1.41 1.41"></path>
            <path d="m19.07 4.93-1.41 1.41"></path>
          </svg>
        </span>
      </button>
        
            <!-- Tombol Masuk -->
            @auth
            <p class="group inline-flex items-center gap-x-2 py-2 px-3 bg-[#1a6d4e] font-medium text-sm text-white rounded-full focus:outline-none">
              {{ explode(' ', Auth::user()->name)[0] }}
            </p>
          @else
            <a class="group inline-flex items-center gap-x-2 py-2 px-3 bg-[#1a6d4e] font-medium text-sm text-white rounded-full focus:outline-none" href="{{ route('login') }}">
              Masuk
            </a>
          @endauth
        </div>
    
          </div>
        </div>
      </div>
      <!-- End Collapse -->
    </nav>
  </header>
  <!-- ========== END HEADER ========== -->