<x-app-layout>
    <!-- Content -->
    <div class="w-full lg:ps-64">
      <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
        @if (Auth::check() && Auth::user()->status == 0)
<!-- Hero -->
<div class="relative overflow-hidden">
  <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
    <div class="mx-auto max-w-4xl text-center space-y-5 sm:space-y-10">
      <p class="text-xs font-semibold text-gray-500 uppercase mb-3 dark:text-neutral-200">
        Informasi untuk anda
      </p>
      <h1 class="text-3xl text-gray-800 font-bold sm:text-5xl lg:text-6xl lg:leading-tight dark:text-neutral-200 relative z-20">
        Akun belum aktif <br><span class="text-blue-500">Klik tombol di bawah</span>
      </h1>
      <a href="" class=" inline-flex items-center justify-center px-5 py-3 text-sm font-medium text-white bg-blue-600 rounded-full shadow-lg hover:bg-blue-700 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-transform transform hover:scale-105 hover:translate-y-1 hover:translate-x-1 relative z-20">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 me-2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
        </svg>          
        Aktivasi Akun
      </a>
    </div>
  </div>
</div>

      @else
          <!-- Grid -->
          <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <!-- Card -->
            <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
              <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2">
                  <p class="text-xs font-bold uppercase text-gray-500 dark:text-neutral-500">
                    Debit Sampah Organik
                  </p>
                  <div class="hs-tooltip">
                    <div class="hs-tooltip-toggle">
                      <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                        <path d="M12 17h.01" />
                      </svg>
                      <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-md shadow-2xs dark:bg-neutral-700" role="tooltip">
                        Jumlah debit sampah organik terakhir saat ini
                      </span>
                    </div>
                  </div>
                </div>
    
                <div class="mt-1 flex items-center gap-x-2">
                  <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                    @if ($detail && $detail->debit_organik)
                      {{$detail->debit_organik}} %
                    @else
                      Belum ada
                    @endif
                  </h3>
                  </span>
                </div>
              </div>
            </div>
            <!-- End Card -->
    
            <!-- Card -->
            <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
              <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2">
                  <p class="text-xs font-bold uppercase text-gray-500 dark:text-neutral-500">
                    Debit Sampah Anorganik
                  </p>
                  <div class="hs-tooltip">
                    <div class="hs-tooltip-toggle">
                      <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                        <path d="M12 17h.01" />
                      </svg>
                      <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-md shadow-2xs dark:bg-neutral-700" role="tooltip">
                        Jumlah debit sampah anorganik terakhir saat ini
                      </span>
                    </div>
                  </div>
                </div>
    
                <div class="mt-1 flex items-center gap-x-2">
                  <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                      @if ($detail && $detail->debit_anorganik)
                      {{$detail->debit_anorganik}} %
                      @else
                      Belum ada
                      @endif
                  </h3>
                  </span>
                </div>
              </div>
            </div>
            <!-- End Card -->
    
            <!-- Card -->
            <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
              <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2">
                  <p class="text-xs font-bold uppercase text-gray-500 dark:text-neutral-500">
                    Jadwal Pengambilan Terdekat
                  </p>
                </div>
    
                <div class="mt-1 flex items-center gap-x-2">
                    @if ($jadwal && $jadwal->waktu_pengambilan)
                    <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                        {{ \Carbon\Carbon::parse($jadwal->waktu_pengambilan)->locale('id')->translatedFormat('D, d F') }}
                    </h3>
                    @else
                    <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                      Belum ada
                    </h3>
                    @endif
                </div>
              </div>
            </div>
            <!-- End Card -->
    
            <!-- Card -->
            <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
              <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2">
                  <p class="text-xs font-bold uppercase text-gray-500 dark:text-neutral-500">
                    Pesan Belum Dibalas
                  </p>
                </div>
    
                <div class="mt-1 flex items-center gap-x-2">
                  <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                    1 Pesan
                  </h3>
                </div>
              </div>
            </div>
            <!-- End Card -->
          </div>
          <!-- End Grid -->
    
          <div class="grid lg:grid-cols-1 gap-4 sm:gap-6">
          
            <!-- Card -->
            <div class="p-4 md:p-5 min-h-102.5 flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
              <!-- Header -->
              <div class="flex flex-wrap justify-between items-center gap-2">
                <div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <h2 class="text-sm text-gray-500 dark:text-neutral-500">
                  Debit Sampah Organik
                </h2>
                  <p class="text-xl sm:text-2xl font-medium">
                  @if ($detail && $detail->debit_organik > 60)
                    <span class="text-red-600 dark:text-red-400">
                    {{$detail->debit_organik}} %
                    </span>
                  @elseif ($detail && $detail->debit_organik > 40)
                    <span class="text-yellow-600 dark:text-yellow-400">
                    {{$detail->debit_organik}} %
                    </span>
                  @elseif ($detail)
                    <span class="text-green-600 dark:text-green-400">
                    {{$detail->debit_organik}} %
                    </span>
                  @else
                    <span class="text-gray-500 dark:text-neutral-500">
                    Belum ada data
                    </span>
                  @endif
                  </p>
              </div>
              <div>
                <h2 class="text-sm text-gray-500 dark:text-neutral-500">
                  Debit Sampah Anorganik
                </h2>
                <p class="text-xl sm:text-2xl font-medium text-blue-600 dark:text-blue-400">
                  @if ($detail && $detail->debit_anorganik > 60)
                    <span class="text-red-600 dark:text-red-400">
                    {{$detail->debit_anorganik}} %
                    </span>
                  @elseif ($detail && $detail->debit_anorganik > 40)
                    <span class="text-yellow-600 dark:text-yellow-400">
                    {{$detail->debit_anorganik}} %
                    </span>
                  @elseif ($detail)
                    <span class="text-green-600 dark:text-green-400">
                    {{$detail->debit_anorganik}} %
                    </span>
                  @else
                    <span class="text-gray-500 dark:text-neutral-500">
                    Belum ada data
                    </span>
                  @endif
                </p>
              </div>
            </div>
                </div>
              </div>
              <!-- End Header -->
          
              <div id="hs-single-area-chart"></div>
            </div>
            <!-- End Card -->
          </div>
    
          <!-- Card users -->
          <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
              <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">
                  <!-- Header -->
                  <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                    <div>
                      <h2 class="text-2xl font-bold text-gray-800 dark:text-neutral-200">
                        Data Pengguna
                      </h2>
                      <p class="text-sm text-gray-600 dark:text-neutral-400">
                        Data pengguna yang terdaftar pada sistem
                      </p>
                    </div>
    
                    <div>
                    </div>
                  </div>
                  <!-- End Header -->
    
                  <!-- Table users -->
                  <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                    <thead class="bg-gray-50 dark:bg-neutral-800">
                      <tr>
                        <th scope="col" class="ps-6 py-3 text-start">
                          <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                            No.
                          </span>
                        </th>
    
                        <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                          <div class="flex items-center gap-x-2">
                            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                              Nama
                            </span>
                          </div>
                        </th>
    
                        <th scope="col" class="px-6 py-3 text-start">
                          <div class="flex items-center gap-x-2">
                            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                              Role
                            </span>
                          </div>
                        </th>
    
                        <th scope="col" class="px-6 py-3 text-start">
                          <div class="flex items-center gap-x-2">
                            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                              Status
                            </span>
                          </div>
                        </th>
    
                        <th scope="col" class="px-6 py-3 text-start">
                          <div class="flex items-center gap-x-2">
                            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                              Ditambahkan
                            </span>
                          </div>
                        </th>
    
                        <th scope="col" class="px-6 py-3 text-start">
                          <div class="flex items-center gap-x-2">
                            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                              Action
                            </span>
                          </div>
                        </th>
                      </tr>
                    </thead>
    
                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                      @foreach ($users as $user)
                      <tr>
                        <td class="size-px whitespace-nowrap">
                          <div class="ps-6 py-3">
                              <span class="text-sm text-gray-800 dark:text-neutral-200">{{ $loop->iteration }}.</span>
                          </div>
                        </td>
                        <td class="size-px whitespace-nowrap">
                          <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
                            <div class="flex items-center gap-x-3">
                              @if ($user->avatar_url)
                                <img class="inline-block size-9.5 rounded-full" src="{{ $user->avatar_url }}" alt="Avatar">
                              @else
                                  <svg class="size-8 text-gray-300" width="12" height="12" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <rect x="0.62854" y="0.359985" width="15" height="15" rx="7.5" fill="white"></rect>
                                  <path d="M8.12421 7.20374C9.21151 7.20374 10.093 6.32229 10.093 5.23499C10.093 4.14767 9.21151 3.26624 8.12421 3.26624C7.0369 3.26624 6.15546 4.14767 6.15546 5.23499C6.15546 6.32229 7.0369 7.20374 8.12421 7.20374Z" fill="currentColor"></path>
                                  <path d="M11.818 10.5975C10.2992 12.6412 7.42106 13.0631 5.37731 11.5537C5.01171 11.2818 4.69296 10.9631 4.42107 10.5975C4.28982 10.4006 4.27107 10.1475 4.37419 9.94123L4.51482 9.65059C4.84296 8.95684 5.53671 8.51624 6.30546 8.51624H9.95231C10.7023 8.51624 11.3867 8.94749 11.7242 9.62249L11.8742 9.93184C11.968 10.1475 11.9586 10.4006 11.818 10.5975Z" fill="currentColor"></path>
                                  </svg>
                              @endif
                              <div class="grow">
                                <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $user->name }}</span>
                                <span class="block text-sm text-gray-500 dark:text-neutral-500">{{ $user->email }}</span>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td class="h-px w-72 whitespace-nowrap">
                          <div class="px-6 py-3">
                            @if ($user->getRoleNames()->isEmpty())
                              <span class="block text-sm text-gray-500 dark:text-neutral-500">Belum ada role</span>
                            @else
                              <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $user->getRoleNames()->join(', ') }}</span>
                            @endif
                          </div>
                        </td>
                        <td class="size-px whitespace-nowrap">
                          <div class="px-6 py-3">
                            @if ($user->status == 1)
                              <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                </svg>
                                Aktif
                              </span>
                            @else
                              <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500">
                                <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                                Tidak Aktif
                              </span>
                            @endif
                          </div>
                        </td>
                        <td class="size-px whitespace-nowrap">
                          <div class="px-6 py-3">
                            <span class="text-sm text-gray-500 dark:text-neutral-500">{{ $user->created_at->format('d M, H:i') }}</span>
                          </div>
                        </td>
                        <td class="size-px whitespace-nowrap">
                          <div class="px-6 py-1.5 flex gap-2">
                            <button type="button" class="py-3 px-4 flex justify-center items-center size-11 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                              <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                              </svg>    
                            </button>
                            <button type="button" class="py-3 px-4 flex justify-center items-center size-11 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                              <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                              </svg>  
                            </button>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <!-- End Table users -->
    
                  <!-- Footer -->
                  <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
                    <div>
                      <p class="text-sm text-gray-600 dark:text-neutral-400">
                        <span class="font-semibold text-gray-800 dark:text-neutral-200">10</span> Data pengguna terakhir
                      </p>
                    </div>
                  </div>
                  <!-- End Footer -->
                </div>
              </div>
            </div>
          </div>
          <!-- End Card users -->
  
           <!-- Card users -->
           <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
              <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">
                  <!-- Header -->
                  <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                    <div>
                      <h2 class="text-2xl font-bold text-gray-800 dark:text-neutral-200">
                        Data Histori Sampah
                      </h2>
                      <p class="text-sm text-gray-600 dark:text-neutral-400">
                        Data histori debit sampah anda 10 hari terakhir
                      </p>
                    </div>
    
                    <div>
            
                    </div>
                  </div>
                  <!-- End Header -->
    
                  <!-- Table users -->
                  <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                    <thead class="bg-gray-50 dark:bg-neutral-800">
                    <tr>
                      <th scope="col" class="ps-6 py-3 text-start">
                      <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                        No.
                      </span>
                      </th>
            
                      <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                      <div class="flex items-center gap-x-2">
                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                        Debit Sampah Organik
                        </span>
                      </div>
                      </th>
            
                      <th scope="col" class="px-6 py-3 text-start">
                      <div class="flex items-center gap-x-2">
                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                        Debit Sampah Anorganik
                        </span>
                      </div>
                      </th>
  
                      <th scope="col" class="px-6 py-3 text-start">
                      <div class="flex items-center gap-x-2">
                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                        Waktu 
                        </span>
                      </div>
                      </th>
                    </tr>
                    </thead>
            
                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                    @if ($history->isEmpty())
                    <tr>
                    <td colspan="4" class="text-center py-6">
                      <div class="flex flex-col items-center">
                      <svg class="w-12 h-12 text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                      </svg>
                      <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">Mohon maaf, belum ada data debit sampah yang masuk.</p>
                      </div>
                    </td>
                    </tr>
                    @else
                    @foreach ($grafik as $data)
                    <tr>
                      <td class="size-px whitespace-nowrap">
                      <div class="ps-6 py-3">
                        <span class="text-sm text-gray-800 dark:text-neutral-200">{{ $loop->iteration }}.</span>
                      </div>
                      </td>
                      <td class="h-px w-72 whitespace-nowrap">
                      <div class="px-6 py-3">
                        <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $data->debit_organik }} %</span>
                      </div>
                      </td>
                      <td class="h-px w-72 whitespace-nowrap">
                      <div class="px-6 py-3">
                        <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $data->debit_anorganik }} %</span>
                      </div>
                      </td>
                      <td class="size-px whitespace-nowrap">
                      <div class="px-6 py-3">
                          <span class="text-sm text-gray-500 dark:text-neutral-500">{{ $data->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</span>
                      </div>
                      </td>
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                  </table>
                  <!-- End Table users -->
    
                  <!-- Footer -->
                  <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
                    <div>
                      <p class="text-sm text-gray-600 dark:text-neutral-400">
                        <span class="font-semibold text-gray-800 dark:text-neutral-200">10</span> Data terakhir Sampah Anda
                      </p>
                    </div>
    
                    <div>
                    </div>
                  </div>
                  <!-- End Footer -->
                </div>
              </div>
            </div>
          </div>
          <!-- End Card users -->
      @endif
      
      </div>
    </div>
    <!-- End Content -->
    <script>
      window.addEventListener("load", () => {
        (function () {
          buildChart(
            "#hs-single-area-chart",
            (mode) => ({
              chart: {
                height: 300,
                type: "area",
                toolbar: {
                  show: false,
                },
                zoom: {
                  enabled: false,
                },
              },
             series: [
  {
    name: "Debit Organik",
    data: [
      @foreach ($grafik as $item)
        {{ $item->debit_organik }},
      @endforeach
    ],
  },
  {
    name: "Debit Anorganik",
    data: [
      @foreach ($grafik as $item)
        {{ $item->debit_anorganik }},
      @endforeach
    ],
  },
],

              legend: {
                show: false,
              },
              dataLabels: {
                enabled: false,
              },
              stroke: {
                curve: "straight",
                width: 2,
              },
              grid: {
                strokeDashArray: 2,
              },
              fill: {
                type: "gradient",
                gradient: {
                  type: "vertical",
                  shadeIntensity: 1,
                  opacityFrom: 0.1,
                  opacityTo: 0.8,
                },
              },
              xaxis: {
                type: "category",
                tickPlacement: "on",
                categories: [
                  @foreach ($grafik as $item)
                  "{{ $item->created_at->format('d F Y') }}",
                  @endforeach
                ],
                axisBorder: {
                  show: false,
                },
                axisTicks: {
                  show: false,
                },
                crosshairs: {
                  stroke: {
                    dashArray: 0,
                  },
                  dropShadow: {
                    show: false,
                  },
                },
                tooltip: {
                  enabled: false,
                },
                labels: {
                  style: {
                    colors: "#9ca3af",
                    fontSize: "13px",
                    fontFamily: "Inter, ui-sans-serif",
                    fontWeight: 400,
                  },
                  formatter: (title) => {
                    let t = title;
  
                    if (t) {
                      const newT = t.split(" ");
                      t = `${newT[0]} ${newT[1].slice(0, 3)}`;
                    }
  
                    return t;
                  },
                },
              },
              yaxis: {
                labels: {
                  align: "left",
                  minWidth: 0,
                  maxWidth: 140,
                  style: {
                    colors: "#9ca3af",
                    fontSize: "13px",
                    fontFamily: "Inter, ui-sans-serif",
                    fontWeight: 400,
                  },
                  formatter: (value) => (value >= 1000 ? `${value / 1000}k` : value),
                },
              },
              tooltip: {
                x: {
                  format: "MMMM yyyy",
                },
                y: {
                  formatter: (value) =>
                    `${value >= 1000 ? `${value / 1000}k` : value}`,
                },
                custom: function (props) {
                  const { categories } = props.ctx.opts.xaxis;
                  const { dataPointIndex } = props;
                  const title = categories[dataPointIndex].split(" ");
                  const newTitle = `${title[0]} ${title[1]}`;
  
                  return buildTooltip(props, {
                    title: newTitle,
                    mode,
                    valuePrefix: "",
                    hasTextLabel: true,
                    markerExtClasses: "rounded-sm!",
                    wrapperExtClasses: "min-w-28",
                  });
                },
              },
              responsive: [
                {
                  breakpoint: 568,
                  options: {
                    chart: {
                      height: 300,
                    },
                    labels: {
                      style: {
                        colors: "#9ca3af",
                        fontSize: "11px",
                        fontFamily: "Inter, ui-sans-serif",
                        fontWeight: 400,
                      },
                      offsetX: -2,
                      formatter: (title) => title.slice(0, 3),
                    },
                    yaxis: {
                      labels: {
                        align: "left",
                        minWidth: 0,
                        maxWidth: 140,
                        style: {
                          colors: "#9ca3af",
                          fontSize: "11px",
                          fontFamily: "Inter, ui-sans-serif",
                          fontWeight: 400,
                        },
                        formatter: (value) =>
                          value >= 1000 ? `${value / 1000}k` : value,
                      },
                    },
                  },
                },
              ],
            }),
            {
              colors: ["#2563eb", "#9333ea"],
              fill: {
                gradient: {
                  stops: [0, 90, 100],
                },
              },
              grid: {
                borderColor: "#e5e7eb",
              },
            },
            {
              colors: ["#3b82f6", "#a855f7"],
              fill: {
                gradient: {
                  stops: [100, 90, 0],
                },
              },
              grid: {
                borderColor: "#404040",
              },
            }
          );
        })();
      });
    </script>
</x-app-layout>
