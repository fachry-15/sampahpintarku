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
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 mt-6">
                <div>
                    <label for="latitude" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Latitude</label>
                    <input type="text" name="latitude" id="latitude" value="{{ $users->informationsUser->latitude ?? 'Belum ada latitude' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 focus:border-gray-300 focus:ring-0 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" readonly>
                </div>
                <div>
                    <label for="longitude" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Longitude</label>
                    <input type="text" name="longitude" id="longitude" value="{{ $users->informationsUser->longitude ?? 'Belum ada longitude' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 focus:border-gray-300 focus:ring-0 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" readonly>
                </div>
            </div>
            <form action="{{ route('user.update', ['id' => $users->id]) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="grid grid-cols-1 gap-6 mt-6">
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Alamat Lengkap</label>
                        <input type="text" name="alamat" id="alamat" value="{{ $users->informationsUser->address ?? 'Belum ada alamat' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" required>
                    </div>
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

                <div class="grid grid-cols-1 gap-6 mt-4">
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Role Pengguna</label>
                        <select name="role" id="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" required>
                            <option value="" {{ !$users->roles->count() ? 'selected' : '' }}>Belum Memilih Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ $users->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-800">
                          <svg class="shrink-0 size-5 me-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                          </svg>            
                         Perbarui Informasi Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
