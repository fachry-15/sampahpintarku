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
              Informasi Akun Pengguna
            </li>
          </ol>
        <div class="text-left py-4">
            <h1 class="text-6xl font-extrabold text-gray-800 dark:text-neutral-200">Informasi Akun Pengguna</h1>
            <p class="mt-2 text-sm font-normal text-gray-500 dark:text-neutral-400">Berikut adalah informasi akun pengguna secara detail</p>
        </div>
        </div>
        <div class="bg-white dark:bg-neutral-800 shadow rounded-lg p-6">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 mb-6">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Nama Depan</label>
                    <input type="text" name="first_name" id="first_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 focus:border-gray-300 focus:ring-0 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" value="{{$users->first_name}}" readonly>
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Nama Belakang</label>
                    <input type="text" name="last_name" id="last_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 focus:border-gray-300 focus:ring-0 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" value="{{$users->last_name}}" readonly>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Username</label>
                    <input type="text" name="username" id="username" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 focus:border-gray-300 focus:ring-0 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" value="{{$users->name}}" readonly>
                </div>
            </div>
            <form action="{{ route('user.updateActivation', ['id' => $users->id]) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 mt-6">
                    <div>
                        <label for="latitude" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Latitude</label>
                        <input type="text" name="latitude" id="latitude" value="{{$users->informationsUser->latitude}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 focus:border-gray-300 focus:ring-0 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" readonly>
                    </div>
                    <div>
                        <label for="longitude" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Longitude</label>
                        <input type="text" name="longitude" id="longitude" value="{{$users->informationsUser->longitude}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 focus:border-gray-300 focus:ring-0 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" readonly>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 gap-6 mt-6">
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Alamat Lengkap</label>
                        <input type="text" name="alamat" id="alamat" value="{{$users->informationsUser->address}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" required>
                    <small class="block mt-1 text-xs text-gray-500 dark:text-neutral-400">
                        *Pastikan alamat yang anda berikan sudah benar dan lengkap secara keseluruhan.
                    </small>
                    </div>
                </div>
               

                <div class="grid grid-cols-1 gap-6 mt-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Status Akun</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" required>
                            <option value="1" {{ $users->status == 1 ? 'selected' : '' }}>Telah Diaktifasi</option>
                            <option value="0" {{ $users->status == 0 ? 'selected' : '' }}>Tangguhkan Akun</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-800">
                        <svg class="shrink-0 size-5 me-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                          </svg>   
                         Aktivasi Akun Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
