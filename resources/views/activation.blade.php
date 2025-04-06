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
                        <input type="text" name="latitude" id="latitude" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" readonly>
                    </div>
                    <div>
                        <label for="longitude" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Longitude</label>
                        <input type="text" name="longitude" id="longitude" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" readonly>
                    </div>
                </div>
                <div id="map" class="w-full h-64 rounded-lg shadow-sm mt-6"></div>
                <div class="grid grid-cols-1 gap-6 mt-6">
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Alamat Lengkap</label>
                        <input type="text" name="alamat" id="alamat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" required>
                    <small class="block mt-1 text-xs text-gray-500 dark:text-neutral-400">
                        *Alamat otomatis tergenerate berdasarkan lokasi Anda saat ini. Jika terdapat kesalahan, Anda dapat menggantinya secara manual.
                    </small>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 mt-6">
                    <div>
                        <label for="province" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Provinsi</label>
                        <select name="province" id="province" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" required>
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </div>
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Kota/Kabupaten</label>
                        <select name="city" id="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" required>
                            <option value="">Pilih Kota/Kabupaten</option>
                        </select>
                    </div>
                    <div>
                        <label for="district" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Kecamatan</label>
                        <select name="district" id="district" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" required>
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                    <div>
                        <label for="village" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Desa/Kelurahan</label>
                        <select name="village" id="village" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" required>
                            <option value="">Pilih Desa/Kelurahan</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-6 mt-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Status Akun</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" required>
                            <option value="1">Aktifkan Akun</option>
                            <option value="0">Akun Ditangguhkan</option>
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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const latitudeInput = document.getElementById('latitude');
                const longitudeInput = document.getElementById('longitude');
                const alamatInput = document.getElementById('alamat');

                latitudeInput.value = position.coords.latitude;
                longitudeInput.value = position.coords.longitude;

                const map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
                }).addTo(map);

                const marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);

                const fetchAddress = async (latitude, longitude) => {
                try {
                    const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`);
                    const data = await response.json();
                    if (data && data.display_name) {
                    alamatInput.value = data.display_name;
                    } else {
                    alamatInput.value = 'Alamat tidak ditemukan';
                    }
                } catch (error) {
                    console.error('Error fetching address:', error);
                    alamatInput.value = 'Gagal mendapatkan alamat';
                }
                };

                fetchAddress(position.coords.latitude, position.coords.longitude);

                const updateMarker = (lat, lng) => {
                marker.setLatLng([lat, lng]);
                map.setView([lat, lng], 13);
                };

                latitudeInput.addEventListener('change', () => {
                const lat = parseFloat(latitudeInput.value);
                const lng = parseFloat(longitudeInput.value);
                if (lat && lng) {
                    updateMarker(lat, lng);
                    fetchAddress(lat, lng);
                }
                });

                longitudeInput.addEventListener('change', () => {
                const lat = parseFloat(latitudeInput.value);
                const lng = parseFloat(longitudeInput.value);
                if (lat && lng) {
                    updateMarker(lat, lng);
                    fetchAddress(lat, lng);
                }
                });
            }, (error) => {
                alert('Gagal mendapatkan lokasi: ' + error.message);
            });
            } else {
            alert('Geolokasi tidak didukung oleh browser Anda.');
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                    latitudeInput.value = position.coords.latitude;
                    longitudeInput.value = position.coords.longitude;
                    fetchAddress(position.coords.latitude, position.coords.longitude);
                }, (error) => {
                    alert('Gagal mendapatkan lokasi: ' + error.message);
                });
            } else {
                alert('Geolokasi tidak didukung oleh browser Anda.');
            }
    
            const latitudeInput = document.getElementById('latitude');
            const longitudeInput = document.getElementById('longitude');
            const alamatInput = document.getElementById('alamat');
    
            const fetchAddress = async (latitude, longitude) => {
                try {
                    const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`);
                    const data = await response.json();
                    if (data && data.display_name) {
                        alamatInput.value = data.display_name;
                    } else {
                        alamatInput.value = 'Alamat tidak ditemukan';
                    }
                } catch (error) {
                    console.error('Error fetching address:', error);
                    alamatInput.value = 'Gagal mendapatkan alamat';
                }
            };
    
            latitudeInput.addEventListener('change', () => {
                if (latitudeInput.value && longitudeInput.value) {
                    fetchAddress(latitudeInput.value, longitudeInput.value);
                }
            });
    
            longitudeInput.addEventListener('change', () => {
                if (latitudeInput.value && longitudeInput.value) {
                    fetchAddress(latitudeInput.value, longitudeInput.value);
                }
            });
        });
    </script>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Fetch provinces, cities, districts, and sub-districts
            fetchProvinces();

            document.getElementById('province').addEventListener('change', fetchCities);
            document.getElementById('city').addEventListener('change', fetchDistricts);
            document.getElementById('district').addEventListener('change', fetchSubDistricts);
        });

        async function fetchProvinces() {
            try {
                const response = await fetch('https://alamat.thecloudalert.com/api/provinsi/get/');
                const provinces = await response.json();
                const provinceSelect = document.getElementById('province');
                provinces.result.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.text; // Set value as text
                    option.dataset.id = province.id; // Store id as data attribute
                    option.textContent = province.text;
                    provinceSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching provinces:', error);
            }
        }

        async function fetchCities() {
            try {
                const provinceId = document.querySelector('#province option:checked').dataset.id;
                const response = await fetch(`https://alamat.thecloudalert.com/api/kabkota/get/?d_provinsi_id=${provinceId}`);
                const cities = await response.json();
                const citySelect = document.getElementById('city');
                citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
                cities.result.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.text; // Set value as text
                    option.dataset.id = city.id; // Store id as data attribute
                    option.textContent = city.text;
                    citySelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching cities:', error);
            }
        }

        async function fetchDistricts() {
            try {
                const cityId = document.querySelector('#city option:checked').dataset.id;
                const response = await fetch(`https://alamat.thecloudalert.com/api/kecamatan/get/?d_kabkota_id=${cityId}`);
                const districts = await response.json();
                const districtSelect = document.getElementById('district');
                districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                districts.result.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.text; // Set value as text
                    option.dataset.id = district.id; // Store id as data attribute
                    option.textContent = district.text;
                    districtSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching districts:', error);
            }
        }

        async function fetchSubDistricts() {
            try {
                const districtId = document.querySelector('#district option:checked').dataset.id;
                const response = await fetch(`https://alamat.thecloudalert.com/api/kelurahan/get/?d_kecamatan_id=${districtId}`);
                const subDistricts = await response.json();
                const subDistrictSelect = document.getElementById('village');
                subDistrictSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                subDistricts.result.forEach(subDistrict => {
                    const option = document.createElement('option');
                    option.value = subDistrict.text; // Set value as text
                    option.dataset.id = subDistrict.id; // Store id as data attribute
                    option.textContent = subDistrict.text;
                    subDistrictSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching sub-districts:', error);
            }
        }
    </script>
</x-app-layout>
