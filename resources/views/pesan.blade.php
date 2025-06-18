<x-app-layout>
    <div class="w-full lg:ps-64 ">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
        <ol class="flex items-center whitespace-nowrap">
            <li class="inline-flex items-center">
              <a class="flex items-center text-sm text-gray-500 hover:text-blue-600 focus:outline-hidden focus:text-blue-600 dark:text-neutral-500 dark:hover:text-blue-500 dark:focus:text-blue-500" href="#">
                Dashboard
              </a>
              <svg class="shrink-0 mx-2 size-4 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6"></path>
              </svg>
            </li>
            <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-neutral-200" aria-current="page">
              Daftar Pesan
            </li>
          </ol>
        <div class="text-left py-4">
            <h1 class="text-6xl font-extrabold text-gray-800 dark:text-neutral-200">Daftar Pesan dan Laporan</h1>
            <p class="mt-2 text-sm font-normal text-gray-500 dark:text-neutral-400">Berikut adalah daftar pesan dan laporan yang diberikan pengguna</p>
        </div>

          <!-- Table Section -->
<div class="max-w-full mx-auto">
    <!-- Card -->
    <div class="flex flex-col">
      <div class="-m-1.5 overflow-x-auto">
        <div class=" min-w-full inline-block align-middle">
          <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">
            <!-- Header -->
              <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                <!-- Input -->
                <div class="sm:col-span-1">
                  <label for="hs-as-table-product-review-search" class="sr-only">Search</label>
                  <div class="relative">
                    <input type="text" id="hs-as-table-product-review-search" name="hs-as-table-product-review-search" class="py-2 px-3 ps-11 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Search">
                    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4">
                      <svg class="shrink-0 size-4 text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </div>
                  </div>
                </div>
                <!-- End Input -->
  
                <div class="sm:col-span-2 md:grow">
                  <div class="flex justify-end gap-x-2">
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-large-modal" data-hs-overlay="#hs-large-modal">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>  
                         Buat Laporan  
                    </button>
                    
                    <div id="hs-large-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-large-modal-label">
                      <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all lg:max-w-4xl lg:w-full m-3 lg:mx-auto">
                        <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                          <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                            <h3 id="hs-large-modal-label" class="font-bold text-gray-800 dark:text-white">
                              Form Laporan dan Pesan
                            </h3>
                            <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#hs-large-modal">
                              <span class="sr-only">Close</span>
                              <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                              </svg>
                            </button>
                          </div>
                          <div class="p-4 overflow-y-auto">
                            <form action="{{ route('pesan.store') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="grid gap-6">
                                <!-- Judul Laporan -->
                                <div>
                                  <label for="judul-laporan" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">
                                    Judul Laporan <small class="text-red-500">*</small>
                                  </label>
                                  <input type="text" placeholder="Tuliskan judul laporan anda" id="judul-laporan" name="judul_laporan" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" required>
                                </div>

                                <!-- Isi Pesan -->
                                <div>
                                  <label for="isi-pesan" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Isi Pesan <small class="text-red-500">*</small>
                                  </label>
                                  <textarea name="isi_pesan" rows="4" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" required></textarea>
                                </div>

                                <!-- Lampiran -->
                                <div>
                                  <label for="lampiran" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">
                                    Lampiran
                                  </label>
                              
                                  <div data-hs-file-upload>
                                    <!-- preview template Preline (dengan SVG lengkap) -->
                                    <template data-hs-file-upload-preview>
                                      <div class="p-3 bg-white border border-solid border-gray-300 rounded-xl dark:bg-neutral-800 dark:border-neutral-600">
                                        <div class="mb-1 flex justify-between items-center">
                                          <div class="flex items-center gap-x-3">
                                            <span class="size-10 flex justify-center items-center border border-gray-200 text-gray-500 rounded-lg dark:border-neutral-700 dark:text-neutral-500" data-dz-file-thumbnail>
                                              <img class="rounded-lg hidden" data-dz-thumbnail>
                                            </span>
                                            <div>
                                              <p class="text-sm font-medium text-gray-800 dark:text-white">
                                                <span class="truncate inline-block max-w-75 align-bottom" data-dz-name></span>
                                              </p>
                                              <p class="text-xs text-gray-500 dark:text-neutral-500" data-dz-size></p>
                                            </div>
                                          </div>
                                            <div class="flex items-center gap-x-2">
                                            <button type="button" class="text-gray-500 hover:text-gray-800 dark:text-neutral-500" data-dz-remove>
                                              <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 6h18"></path>
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                <line x1="10" x2="10" y1="11" y2="17"></line>
                                                <line x1="14" x2="14" y1="11" y2="17"></line>
                                              </svg>
                                            </button>
                                            </div>
                                        </div>
                                
                                      </div>
                                    </template>
                                
                                    <!-- trigger area Preline -->
                                    <div class="cursor-pointer p-12 flex justify-center bg-white border border-dashed border-gray-300 rounded-xl dark:bg-neutral-800" data-hs-file-upload-trigger>
                                      <div class="text-center">
                                        <span class="inline-flex justify-center items-center size-16 bg-gray-100 text-gray-800 rounded-full dark:bg-neutral-700">
                                          <svg class="shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="17 8 12 3 7 8"></polyline>
                                            <line x1="12" y1="3" x2="12" y2="15"></line>
                                          </svg>
                                        </span>
                                        <div class="mt-4 text-sm text-gray-600">
                                          <span class="font-medium text-gray-800 dark:text-neutral-200">Lampirkan file</span> atau klik
                                        </div>
                                        <p class="mt-1 text-xs text-gray-400 dark:text-neutral-400">Maksimal 2 MB</p>
                                      </div>
                                    </div>
                                
                                    <!-- tempat preview Preline -->
                                    <div class="mt-4 space-y-2" data-hs-file-upload-previews></div>
                                  </div> 
                                  <small class="text-gray-500">* Lampiran bersifat opsional.</small>
                                </div>

                                <!-- Tanggal Mulai dan Tanggal Akhir -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                  <div>
                                    <label for="tanggal-mulai" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">
                                      Tanggal Mulai
                                    </label>
                                    <input type="date" id="tanggal-mulai" name="tanggal_mulai" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                    <small class="text-gray-500">* Tidak wajib diisi.</small>
                                  </div>
                                  <div>
                                    <label for="tanggal-akhir" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">
                                      Tanggal Akhir
                                    </label>
                                    <input type="date" id="tanggal-akhir" name="tanggal_akhir" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                    <small class="text-gray-500">* Tidak wajib diisi.</small>
                                  </div>
                                </div>
                              </div>

                              <!-- Pilih Petugas -->
                              <div class="mt-4">
                                <label for="petugas" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">
                                  Pilih Petugas Sampah <small class="text-red-500">*</small>
                                </label>
                                <select id="petugas" name="phone_number" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" required>
                                  <option value="">-- Pilih Petugas --</option>
                                  @foreach ($petugas as $p)
                                    <option value="{{ $p->phone_number }}">{{ $p->name }} - {{ $p->phone_number}}</option>
                                  @endforeach
                                </select>
                              </div>
                          </div>
                          <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                            <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-large-modal">
                              Close
                            </button>
                            <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                              Buat Laporan
                            </button>
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Header -->
  
            <!-- Table -->
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
              <thead class="bg-gray-50 dark:bg-neutral-800">
                <tr>
                  <th scope="col" class="px-6 py-3 text-start">
                    <div class="flex items-center gap-x-2">
                      <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                        No.
                      </span>
                    </div>
                  </th>
  
                  <th scope="col" class="px-6 py-3 text-start">
                    <div class="flex items-center gap-x-2">
                      <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                        Judul Laporan
                      </span>
                    </div>
                  </th>
  
                  <th scope="col" class="px-6 py-3 text-start">
                    <div class="flex items-center gap-x-2">
                      <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                       Isi Pesan
                      </span>
                    </div>
                  </th>
  
                  <th scope="col" class="px-6 py-3 text-start">
                    <div class="flex items-center gap-x-2">
                      <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                        Tanggal Laporan
                      </span>
                    </div>
                  </th>

                  <th scope="col" class="px-6 py-3 text-start">
                    <div class="flex items-center gap-x-2">
                      <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                        Tanggal Dibalas
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
                        Aksi
                      </span>
                    </div>
                  </th>
                </tr>
              </thead>
  
              <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @if ($pesan->isEmpty())
                <tr>
                  <td colspan="6" class="text-center py-4">
                    <span class="text-sm text-gray-500 dark:text-neutral-500">Mohon maaf, belum terdapat pesan yang anda buat.</span>
                  </td>
                </tr>
                @else
                  @foreach ($pesan as $data)
                  <tr>
                    <td class="size-px whitespace-nowrap">
                      <div class="ps-6 py-3">
                          <span class="text-sm text-gray-800 dark:text-neutral-200">{{ $loop->iteration }}.</span>
                      </div>
                    </td>
                    <td class="h-px w-72 whitespace-nowrap">
                      <div class="px-6 py-3">
                          <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $data->judul }}</span>
                      </div>
                    </td>
                    <td class="h-px w-72 whitespace-nowrap">
                      <div class="px-6 py-3">
                          <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $data->isi }}</span>
                      </div>
                    </td>
                    <td class="size-px whitespace-nowrap">
                      <div class="px-6 py-3">
                        <span class="text-sm text-gray-500 dark:text-neutral-500">{{ $data->created_at->format('d M, H:i') }}</span>
                      </div>
                    </td>
          
                  <td class="size-px whitespace-nowrap">
                    <div class="px-6 py-3">
                      <span class="text-sm text-gray-500 dark:text-neutral-500">Belum ada balasan</span>
                    </div>
                  </td>
                  <td class="size-px whitespace-nowrap">
                    <div class="px-6 py-3">
                      @if ($data->status == 1)
                        <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                          <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                          </svg>
                          Selesai
                        </span>
                      @elseif ($data->status == 2)
                        <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500">
                          <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                          </svg>
                          Ditolak
                        </span>
                      @else
                        <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full dark:bg-yellow-500/10 dark:text-yellow-500">
                          <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                          </svg>
                          Menunggu
                        </span>
                      @endif
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
<button type="button" class="py-3 px-4 flex justify-center items-center size-11 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none transition-colors duration-150" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-balas-modal-{{ $data->id }}" data-hs-overlay="#hs-balas-modal-{{ $data->id }}">
<svg class="shrink-0 size-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3 10v4a1 1 0 001 1h3m10-5V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2m3-5l-4-4m0 0l4 4m-4-4v12" />
</svg>
</button>

<div id="hs-balas-modal-{{ $data->id }}" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-balas-modal-label-{{ $data->id }}">
  <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all lg:max-w-4xl lg:w-full m-3 lg:mx-auto">
    <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
      <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
        <h3 id="hs-balas-modal-label-{{ $data->id }}" class="font-bold text-gray-800 dark:text-white">
          Form Balas Pesan
        </h3>
        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#hs-balas-modal-{{ $data->id }}">
          <span class="sr-only">Close</span>
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </button>
      </div>
      <div class="p-4 overflow-y-auto">
        <div class="mb-4">
          <div class="mb-4">
            <div class="bg-gray-50 dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-lg p-4 flex flex-col sm:flex-row gap-4 items-start">
              <div class="flex-shrink-0 flex flex-col items-center justify-center">
                <div class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 font-bold text-xl">
                  {{ Str::upper(Str::substr($data->user->name ?? 'U', 0, 1)) }}
                </div>
                <span class="mt-2 text-xs text-gray-500 dark:text-neutral-400">Pengirim</span>
              </div>
              <div class="flex-1">
                <div class="mb-1 flex flex-wrap items-center gap-2">
                  <span class="font-semibold text-gray-700 dark:text-neutral-200">Nama:</span>
                  <span class="text-gray-800 dark:text-white">{{ $data->user->name ?? '-' }}</span>
                  <span class="mx-2 text-gray-400">|</span>
                  <span class="font-semibold text-gray-700 dark:text-neutral-200">No. HP:</span>
                  <span class="text-gray-800 dark:text-white">{{ $data->user->phone_number ?? '-' }}</span>
                </div>
                <div class="mb-2">
                  <span class="font-semibold text-gray-700 dark:text-neutral-200">Judul:</span>
                  <span class="text-gray-800 dark:text-white">{{ $data->judul }}</span>
                </div>
                <div class="mb-2">
                  <span class="font-semibold text-gray-700 dark:text-neutral-200">Pesan:</span>
                  <span class="text-gray-800 dark:text-white break-words max-w-xl block">{{ $data->isi }}</span>
                </div>
                <div>
                  <span class="font-semibold text-gray-700 dark:text-neutral-200">Tanggal:</span>
                  @php
                    \Carbon\Carbon::setLocale('id');
                    $wibTime = $data->created_at->copy()->addHours(7);
                  @endphp
                  <span class="text-gray-800 dark:text-white">{{ $wibTime->translatedFormat('d M Y H:i') }} WIB</span>
                </div>
              </div>
            </div>
          </div>
        <form action="{{ route('balasan.store') }}" method="POST" class="space-y-6 mt-4">
          @csrf
          <input type="text" name="pesan_id" value="{{ $data->id }}" hidden>
          <div>
            <label for="balasan-isi-{{ $data->id }}" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
              Balasan Pesan <small class="text-red-500">*</small>
            </label>
            <textarea id="balasan-isi-{{ $data->id }}" name="balasan_isi" rows="4" required
              class="block w-full border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200 transition duration-150 ease-in-out"
              placeholder="Tulis balasan Anda di sini..."></textarea>
          </div>
          <div>
            <label for="balasan-status-{{ $data->id }}" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
              Status Pesan <small class="text-red-500">*</small>
            </label>
            <select id="balasan-status-{{ $data->id }}" name="status" required
              class="block w-full border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200 transition duration-150 ease-in-out">
              <option value="">-- Pilih Status --</option>
              <option value="1" class="bg-teal-100 text-teal-800 dark:bg-teal-500/10 dark:text-teal-400">Selesai</option>
              <option value="2" class="bg-red-100 text-red-800 dark:bg-red-500/10 dark:text-red-400">Ditolak</option>
              <option value="0" class="bg-yellow-100 text-yellow-800 dark:bg-yellow-500/10 dark:text-yellow-400">Menunggu</option>
            </select>
          </div>
          <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
            <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-balas-modal-{{ $data->id }}">
              Tutup
            </button>
            <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none transition-colors duration-150">
               Kirim Balasan
              <svg class="shrink-0 size-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
              </svg>             
            </button>
          </div>
        </form>
    </div>
  </div>
</div>
                    </div>
                  </td>
                </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
            <!-- End Table -->
  
            <!-- Footer -->
            <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
              <div class="max-w-sm space-y-3">
                <select class="py-2 px-3 pe-9 block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option selected>5</option>
                  <option>6</option>
                </select>
              </div>
  
              <div>
                <div class="inline-flex gap-x-2">
                  <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    Prev
                  </button>
  
                  <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                    Next
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                  </button>
                </div>
              </div>
            </div>
            <!-- End Footer -->
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Table Section -->
        </div>
    </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
      <script>
        Dropzone.autoDiscover = false;
        const previewTpl = document.querySelector('template[data-hs-file-upload-preview]').innerHTML;
      
        new Dropzone("[data-hs-file-upload]", {
          url: "#",
          autoProcessQueue: false,
          clickable: "[data-hs-file-upload-trigger]",
          previewsContainer: "[data-hs-file-upload-previews]",
          previewTemplate: previewTpl,
          maxFiles: 1,
          maxFilesize: 2,
          acceptedFiles: "image/*,application/pdf",
          init() {
            this.on("addedfile", file => {
              // langsung full progress & sukses
              this.emit("uploadprogress", file, 100, file.size);
              this.emit("success", file);
              this.emit("complete", file);
            });
      
            const form = this.element.closest('form');
            form.addEventListener('submit', () => {
              this.getAcceptedFiles().forEach(file => {
                const dt = new DataTransfer();
                dt.items.add(file);
                const inp = document.createElement('input');
                inp.type = 'file';
                inp.name = 'lampiran';
                inp.files = dt.files;
                inp.hidden = true;
                form.appendChild(inp);
              });
            });
          }
        });
      </script>
      
    
</x-app-layout>
