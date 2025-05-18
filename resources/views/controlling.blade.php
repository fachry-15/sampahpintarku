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
              Master Control Tempat Sampah
            </li>
          </ol>
        <div class="text-left py-4">
            <h1 class="text-6xl font-extrabold text-gray-800 dark:text-neutral-200">Master Control</h1>
            <p class="mt-2 text-sm font-normal text-gray-500 dark:text-neutral-400">Berikut adalah daftar master kontrol semua alat website.</p>
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
                        Debit Sampah Anorganik
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
                        Aksi
                      </span>
                    </div>
                  </th>
  
                </tr>
              </thead>
  
              <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @if ($master->isEmpty())
                <tr>
                  <td colspan="4" class="text-center py-4">
                    <span class="text-sm text-gray-500 dark:text-neutral-500">Mohon maaf, belum ada data debit sampah yang masuk.</span>
                  </td>
                </tr>
                @else
                  @foreach ($master as $data)
                  <tr>
                    <td class="size-px whitespace-nowrap">
                      <div class="ps-6 py-3">
                          <span class="text-sm text-gray-800 dark:text-neutral-200">{{ $loop->iteration }}.</span>
                      </div>
                    </td>
                    <td class="h-px w-72 whitespace-nowrap">
                      <div class="px-6 py-3">
                          <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $data->debit_max_organik }} %</span>
                      </div>
                    </td>
                    <td class="h-px w-72 whitespace-nowrap">
                      <div class="px-6 py-3">
                          <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $data->debit_max_anorganik }} %</span>
                      </div>
                    </td>
                    <td class="h-px w-72 whitespace-nowrap">
                        <div class="px-6 py-3">
                            <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" onclick="toggleModal('modal-{{ $data->id }}')">
                                Edit
                            </button>

                            <div id="modal-{{ $data->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
                                <div class="flex items-center justify-center min-h-screen px-4">
                                    <div class="bg-white border border-gray-200 shadow-2xs rounded-xl w-full max-w-lg dark:bg-neutral-800 dark:border-neutral-700">
                                        <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                                            <h3 class="font-bold text-gray-800 dark:text-white">
                                                Edit Debit Max
                                            </h3>
                                            <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" onclick="toggleModal('modal-{{ $data->id }}')">
                                                <span class="sr-only">Close</span>
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M18 6 6 18"></path>
                                                    <path d="m6 6 12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="p-4">
                                            <form action="{{ route('master.update', $data->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-4">
                                                    <label for="debit_max_organik_{{ $data->id }}" class="block text-sm font-medium text-gray-700">Debit Max Organik</label>
                                                    <input type="number" id="debit_max_organik_{{ $data->id }}" name="debit_max_organik" value="{{ $data->debit_max_organik }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="debit_max_anorganik_{{ $data->id }}" class="block text-sm font-medium text-gray-700">Debit Max Anorganik</label>
                                                    <input type="number" id="debit_max_anorganik_{{ $data->id }}" name="debit_max_anorganik" value="{{ $data->debit_max_anorganik }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                                </div>
                                                <div class="flex justify-end items-center gap-x-2">
                                                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" onclick="toggleModal('modal-{{ $data->id }}')">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700">
                                                        Perbarui Data
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function toggleModal(id) {
                                    const modal = document.getElementById(id);
                                    modal.classList.toggle('hidden');
                                }
                            </script>
                        </div>
                      </td>
                  </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
            <!-- End Table -->
  
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Table Section -->

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
                        Jadwal Pengambilan Sampah
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
                @if ($time->isEmpty())
                <tr>
                  <td colspan="4" class="text-center py-4">
                    <span class="text-sm text-gray-500 dark:text-neutral-500">Mohon maaf, belum ada data debit sampah yang masuk.</span>
                  </td>
                </tr>
                @else
                  @foreach ($time as $data)
                  <tr>
                    <td class="size-px whitespace-nowrap">
                      <div class="ps-6 py-3">
                          <span class="text-sm text-gray-800 dark:text-neutral-200">{{ $loop->iteration }}.</span>
                      </div>
                    </td>
                    <td class="h-px w-72 whitespace-nowrap">
                      <div class="px-6 py-3">
                          <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $data->schedule_time }} WIB</span>
                      </div>
                    </td>
                    <td class="h-px w-72 whitespace-nowrap">
                        <div class="px-6 py-3">
                            <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-basic-modal-{{ $data->id }}" data-hs-overlay="#hs-basic-modal-{{ $data->id }}">
                                Edit
                            </button>

                            <div id="hs-basic-modal-{{ $data->id }}" class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 hidden size-full fixed top-0 start-0 z-80 opacity-0 overflow-x-hidden transition-all overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-basic-modal-label-{{ $data->id }}">
                                <div class="sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                                    <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto">
                                        <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                                            <h3 id="hs-basic-modal-label-{{ $data->id }}" class="font-bold text-gray-800">
                                                Edit Schedule Time
                                            </h3>
                                            <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" aria-label="Close" data-hs-overlay="#hs-basic-modal-{{ $data->id }}">
                                                <span class="sr-only">Close</span>
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M18 6 6 18"></path>
                                                    <path d="m6 6 12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="p-4 overflow-y-auto">
                                            <form action="{{ route('time.update', $data->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-4">
                                                    <label for="schedule_time_{{ $data->id }}" class="block text-sm font-medium text-gray-700">Schedule Time</label>
                                                    <input type="time" id="schedule_time_{{ $data->id }}" name="schedule_time" value="{{ $data->schedule_time }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                                </div>
                                                <div class="flex justify-end items-center gap-x-2">
                                                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-basic-modal-{{ $data->id }}">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                        Perbarui Data
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
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
  
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Table Section -->
        </div>
    </div>
</x-app-layout>
