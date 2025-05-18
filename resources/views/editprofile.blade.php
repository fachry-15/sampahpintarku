<x-app-layout>
    <!-- Content -->
    <div class="w-full lg:ps-64">
      <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
       <!-- Card Section -->
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
          Edit Profile
        </li>
      </ol>
<div class=" mx-auto"><!-- Card -->
    <div class="bg-white rounded-xl shadow-xs p-2 dark:bg-neutral-800">
      <div class="mb-10">
        <h1 class="text-6xl font-extrabold text-gray-800 dark:text-neutral-200">Edit Profile</h1>
            <p class="mt-2 text-sm font-normal text-gray-500 dark:text-neutral-400">
                Silahkan edit profile anda sesuai dengan data yang benar dan valid. Pastikan semua data yang anda masukkan sudah benar dan valid.
            </p>
      </div>
  
      <form>
        <!-- Grid -->
        <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">
          <div class="sm:col-span-3">
            <label class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
              Profil Pengguna
            </label>
          </div>
          <!-- End Col -->
  
          <div class="sm:col-span-9">
            <div class="flex items-center gap-5">
              <img class="inline-block size-16 rounded-full ring-2 ring-white dark:ring-neutral-900" src="https://preline.co/assets/img/160x160/img1.jpg" alt="Avatar">
              <div class="flex gap-x-2">
                <div>
                    <input type="file" name="file-input" id="file-input" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                    file:bg-gray-50 file:border-0
                    file:me-4
                    file:py-3 file:px-4
                    dark:file:bg-neutral-700 dark:file:text-neutral-400">
                </div>
              </div>
            </div>
          </div>
          <!-- End Col -->
  
          <div class="sm:col-span-3">
            <label for="af-account-full-name" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
              Nama Lengkap
            </label>
            <div class="hs-tooltip inline-block">
              <svg class="hs-tooltip-toggle ms-1 inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible w-40 text-center z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-md shadow-2xs dark:bg-neutral-700" role="tooltip">
                Nama lengkap anda akan digunakan sebagai username yang akan ditampilkan
              </span>
            </div>
          </div>
          <!-- End Col -->
  
          <div class="sm:col-span-9">
            <div class="sm:flex">
              <input id="af-account-full-name" type="text" class="py-1.5 sm:py-2 px-3 pe-11 block w-full border-gray-200 shadow-2xs -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg sm:text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" value="{{$user->first_name}}">
              <input type="text" class="py-1.5 sm:py-2 px-3 pe-11 block w-full border-gray-200 shadow-2xs -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg sm:text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" value="{{$user->last_name}}" placeholder="Boone">
            </div>
          </div>
          <!-- End Col -->
  
          <div class="sm:col-span-3">
            <label for="af-account-email" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
              Email
            </label>
          </div>
          <!-- End Col -->
  
          <div class="sm:col-span-9">
            <input id="af-account-email" type="email" class="py-1.5 sm:py-2 px-3 pe-11 block w-full border-gray-200 shadow-2xs sm:text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="masukkan alamat email" value="{{$user->email}}">
          </div>
          <!-- End Col -->
  
          <div class="sm:col-span-3">
            <label for="af-account-password" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
              Password
            </label>
          </div>
          <!-- End Col -->
  
          <div class="sm:col-span-9">
            <div class="space-y-2">
              <input id="af-account-password" type="text" class="py-1.5 sm:py-2 px-3 pe-11 block w-full border-gray-200 shadow-2xs rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Tuliskan password anda saat ini">
              <input type="text" class="py-1.5 sm:py-2 px-3 pe-11 block w-full border-gray-200 shadow-2xs rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Masukkan password baru anda">
            </div>
          </div>
          <!-- End Col -->
  
          <div class="sm:col-span-3">
            <div class="inline-block">
              <label for="af-account-phone" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                No. Telepon
              </label>
            </div>
          </div>
          <!-- End Col -->
  
          <div class="sm:col-span-9">
            <div class="sm:flex">
              <input id="af-account-phone" type="text" class="py-1.5 sm:py-2 px-3 pe-11 block w-full border-gray-200 shadow-2xs -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg sm:text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="+62 812 XXXX XXXX atau 0812 XXXX XXXX" value="{{$user->phone_number}}">
            </div>
            <small class="text-gray-400 dark:text-neutral-400">
              * Pastikan no telepon aktif karena akan digunakan sebagai media komunikasi dengan pihak tempat sampahku.
            </small>
          </div>
          <!-- End Col -->

        <div class="sm:col-span-3">
            <label for="af-account-address" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                Alamat
            </label>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-9">
            <input id="af-account-address" type="text" class="py-1.5 sm:py-2 px-3 pe-11 block w-full border-gray-200 shadow-2xs rounded-lg sm:text-sm bg-gray-100 text-gray-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500" value="{{$user->informationsUser->address ?? 'Alamat belum diisi oleh pihak tempat sampahku'}}" readonly>
        </div>
        <!-- End Col -->
        </div>
        <!-- End Grid -->
  
        <div class="mt-5 flex justify-end gap-x-2">
          <a href="{{ route('dashboard') }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
            Batal
          </a>
          <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
            Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Card Section -->
      </div>
    </div>
    <!-- End Content -->
</x-app-layout>
