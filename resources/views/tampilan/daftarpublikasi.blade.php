<div class="max-w-6xl mx-auto mt-6 p-6 bg-white bordershadow border rounded-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-3">
        <div>
            <h2 class="text-lg font-semibold text-blue-900">Daftar Publikasi/Laporan</h2>
            <p class="text-sm text-gray-500">Tabel ringkasan per publikasi/laporan per triwulan</p>
        </div>

        <div class="flex flex-row-gap-2" x-data="{ open: false }">
            <!-- Tombol Unduh Excel -->
            <a href="" 
                class="flex items-center gap-1 border text-gray-700 px-3 py-2 rounded-lg sm:text-sm shadow hover:text-white hover:bg-emerald-800 whitespace-nowrap min-w-[100px]">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                    <path d="M8.75 2.75a.75.75 0 0 0-1.5 0v5.69L5.03 6.22a.75.75 0 0 0-1.06 1.06l3.5 3.5a.75.75 0 0 0 1.06 0l3.5-3.5a.75.75 0 0 0-1.06-1.06L8.75 8.44V2.75Z" />
                    <path d="M3.5 9.75a.75.75 0 0 0-1.5 0v1.5A2.75 2.75 0 0 0 4.75 14h6.5A2.75 2.75 0 0 0 14 11.25v-1.5a.75.75 0 0 0-1.5 0v1.5c0 .69-.56 1.25-1.25 1.25h-6.5c-.69 0-1.25-.56-1.25-1.25v-1.5Z" />
                </svg>
                Unduh Excel
            </a>

            <!-- Tombol Tambah Publikasi -->
            @if(auth()->check() && auth()->user()->role === 'ketua_tim')
                <button 
                    @click="open = true" 
                    class="flex items-center bg-emerald-600 text-white px-3 py-2 rounded-lg sm:text-sm shadow hover:bg-emerald-800 whitespace-nowrap min-w-[100px]">
                    + Publikasi
                </button>
            @endif
            <!-- Modal -->
            <div 
                x-show="open" 
                x-transition 
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
                    <!-- Tombol close -->
                    <button 
                        @click="open = false" 
                        class="absolute top-2 right-2 text-gray-600 hover:text-red-600">
                        ✖
                    </button>
                    
                    <h2 class="text-lg font-semibold mb-4">Tambah Publikasi Survei</h2>
                    <!-- Form -->
                    <form method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Nama Publikasi Survei</label>
                            <input type="text" name="nama" 
                                class="w-full border rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="flex justify-end mt-4">
                            <button type="submit" 
                                class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="mb-4 mt-1 border rounded-lg">
        <input 
            type="text"
            id="seach"
            placeholder="Cari Berdasarkan Nama Publikasi/Laporan"
            class="w-full  px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <!-- Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-gray-100 text-gray-600 text-xs">
                    <!-- Header Kolom -->
                    <tr>
                        <th class="px-3 py-2 border">No</th>
                        <th class="px-3 py-2 border">Nama Publikasi/Laporan</th>
                        <th class="px-3 py-2 border">Nama Kegiatan</th>
                        <th class="px-3 py-2 border">PIC</th>
                        <th class="px-3 py-2 border">Tahapan</th>
                        <th class="px-3 py-2 border" colspan="4">Rencana Kegiatan</th>
                        <th class="px-3 py-2 border" colspan="4">Realisasi Kegiatan</th>
                        <th class="px-3 py-2 border">Aksi</th>
                    </tr>
                    <!-- Sub Header Kolom -->
                    <tr class="bg-gray-50 text-gray-500 text-xs">
                        <th class="px-3 py-2"></th>
                        <th class="px-3 py-2"></th>
                        <th class="px-3 py-2"></th>
                        <th class="px-3 py-2"></th>
                        <th class="px-3 py-2"></th>
                        <th class="px-3 py-2">Triwulan I</th>
                        <th class="px-3 py-2">Triwulan II</th>
                        <th class="px-3 py-2">Triwulan III</th>
                        <th class="px-3 py-2">Triwulan IV</th>
                        <th class="px-3 py-2">Triwulan I</th>
                        <th class="px-3 py-2">Triwulan II</th>
                        <th class="px-3 py-2">Triwulan III</th>
                        <th class="px-3 py-2">Triwulan IV</th>
                        <th class="px-3 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Baris Pertama -->
                    <tr>
                        <!-- No -->
                        <td class="px-4 py-4 align-top">1</td>
                        <!-- Nama Publikasi -->
                        <td class="px-4 py-4 align-top ">
                            <div class="font-semibold text-gray-700">Laporan Statistik Kependudukan</div>
                            <!-- Button Tahapan -->
                            <div x-data="{ open: false }">
                                <button 
                                    @click="open = true" 
                                    class="sm:text-xs mt-2 px-3 py-1 text-xs text-gray-700 bg-gray-100 border rounded-lg hover:bg-emerald-600 hover:text-white whitespace-nowrap min-w-[100px]" >
                                    + Tahapan
                                </button>

                                <!-- Modal -->
                                <div 
                                    x-show="open" 
                                    x-transition 
                                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                    <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
                                        <!-- Tombol close -->
                                        <button 
                                            @click="open = false" 
                                            class="absolute top-2 right-2 text-gray-600 hover:text-red-600">
                                            ✖
                                        </button>
                                        <!-- Modal Content -->
                                        <h2 class="text-lg font-semibold">Tambah Tahapan</h2>
                                        <p class="text-sm text-gray-500 mb-2">Tambahkan tahapan baru untuk publikasi/laporan</p>
                                        <!-- Form -->
                                        <form method="POST">
                                            @csrf
                                            <!-- Jenis Tahapan -->
                                            <div class="mb-3">
                                                <label class="block text-sm font-medium text-gray-700">Jenis Tahapan</label>
                                                <select name="nama_publikasi" 
                                                    class="px-2 py-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                                                    <option value="">-- Pilih Jenis Tahapan --</option>
                                                    <option value="persiapan">Persiapan</option>
                                                    <option value="pengumpulan_data">Pengumpulan Data</option>
                                                    <option value="pengolahan_data">Pengolahan Data</option>
                                                    <option value="analisis_data">Analisis Data</option>
                                                    <option value="diseminasi">Diseminasi</option>
                                                </select>
                                            </div>

                                            <!-- Tambah Tahapan Survei -->
                                            <div class="mb-3">
                                                <label class="block text-sm font-medium text-gray-700">Nama Tahapan</label>
                                                <input type="text" name="tahapan" 
                                                    class="w-full border rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                                    placeholder="Contoh: Perekrutan Anggota Pelatihan Anggota">
                                            </div>

                                            <!-- Tombol Simpan -->
                                            <div class="flex justify-end mt-4 gap-2">
                                                <button type="button" @click="open = false" 
                                                    class="text-xs sm:text-sm bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg">
                                                    Batal
                                                </button>
                                                <button type="submit" 
                                                    class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700">
                                                    Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <!-- Nama Kegiatan -->
                        <td class="px-4 py-4 align-top font-semibold text-gray-700">Sakernas</td>
                        <!-- PIC -->
                        <td class="px-4 py-4 align-top font-semibold text-gray-700">Tim Sosial</td>
                        <!-- Tahapan -->
                        <td class="px-4 py-4 align-top">
                            <div class="text-sm font-medium text-gray-700">5/6 Tahapan</div>
                            <div class="flex items-center gap-2 mt-1">
                            <span class="px-2 py-0.5 text-xs bg-gray-100 border rounded-full">50% selesai</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Perekrutan Anggota, Pelatihan Anggota, +4 lainnya</p>
                        </td>
                        <!-- Rencana Kegiatan -->
                        <td class="px-4 py-4 text-center">
                            <div class="px-3 py-1 rounded-full bg-blue-900 text-white inline-block">3 Rencana</div>
                            <p class="text-xs text-gray-500 mt-1">100% selesai</p>
                        </td>
                        <td class="px-4 py-4 text-center">
                            <div class="px-3 py-1 rounded-full bg-blue-900 text-white inline-block">3 Rencana</div>
                            <p class="text-xs text-gray-500 mt-1">67% selesai</p>
                        </td>
                        <td class="px-4 py-4 text-center text-gray-400">-</td>
                        <td class="px-4 py-4 text-center text-gray-400">-</td>
                        <!-- Realisasi Kegiatan -->
                        <td class="px-4 py-4 text-center">
                            <div class="px-3 py-1 rounded-full bg-emerald-600 text-white inline-block">3 Selesai</div>
                            <p class="text-xs text-gray-500 mt-1">3 sesuai rencana</p>
                        </td>
                        <td class="px-4 py-4 text-center">
                            <div class="px-3 py-1 rounded-full bg-emerald-600 text-white inline-block">1 Selesai</div>
                            <p class="text-xs text-gray-500 mt-1">1 sesuai rencana</p>
                        </td>
                        <td class="px-4 py-4 text-center">
                            <div class="px-3 py-1 rounded-full bg-emerald-600 text-white inline-block">1 Selesai</div>
                            <p class="text-xs text-orange-500 mt-1">+1 lintas triwulan</p>
                        </td>
                        <td class="px-4 py-4 text-center text-gray-400">Belum Realisasi</td>
                        <!-- Aksi -->
                        <td class="px-4 py-4 text-center relative" x-data="{ open: false}">
                            {{-- tombol trigger --}}
                            <button 
                                @click="open = !open"
                                {{-- icon --}}
                                class="p-2 rounded-xl hover:bg-emerald-600 hover:text-white focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                    <path d="M2 8a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM6.5 8a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM12.5 6.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Z" />
                                </svg>
                            </button>
                            {{-- Dropdown menu --}}
                            <div
                                x-show="open"
                                @click.outside= "open=false"
                                class="absolute right-0 mt-2 w-32 bg-white border rounded-lg shadow-lg z-10">
                                <a href="/detail" class="flex gap-1 sm:text-xs w-full text-left px-4 py-2 text-sm text-black hover:bg-emerald-600 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" />
                                        <path fill-rule="evenodd" d="M1.38 8.28a.87.87 0 0 1 0-.566 7.003 7.003 0 0 1 13.238.006.87.87 0 0 1 0 .566A7.003 7.003 0 0 1 1.379 8.28ZM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" clip-rule="evenodd" />
                                    </svg>
                                    Detail
                                </a>
                                <button class="flex gap-1 sm:text-xs w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-emerald-600 hover:text-white">
                                    {{-- icon --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                        <path fill-rule="evenodd" d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z" clip-rule="evenodd" />
                                    </svg>
                                    Edit
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Baris Kedua -->
                    <tr>
                        <!-- No -->
                        <td class="px-4 py-4 align-top">2</td>
                        <!-- Nama Publikasi -->
                        <td class="px-4 py-4 align-top ">
                            <div class="font-semibold text-gray-700">Laporan Statistik Ketenagakerjaan</div>
                            <button class="sm:text-xs mt-2 px-3 py-1 text-xs text-gray-700 bg-gray-100 border rounded-lg hover:bg-emerald-600 hover:text-white whitespace-nowrap min-w-[100px]">+ Tahapan</button>
                        </td>
                        <!-- Nama Kegiatan -->
                        <td class="px-4 py-4 align-top font-semibold text-gray-700">Sakernas</td>
                        <!-- PIC -->
                        <td class="px-4 py-4 align-top font-semibold text-gray-700">Tim Sosial</td>
                        <!-- Tahapan -->
                        <td class="px-4 py-4 align-top">
                            <div class="text-sm font-medium text-gray-700">2/4 Tahapan</div>
                            <div class="flex items-center gap-2 mt-1">
                            <span class="px-2 py-0.5 text-xs bg-gray-100 border rounded-full">25% selesai</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Penyusunan Kuesioner, Wawancara Rumah Tangga, +2 lainnya</p>
                        </td>
                        <!-- Rencana Kegiatan-->
                        <td class="px-4 py-4 text-center">
                            <div class="px-3 py-1 rounded-full bg-blue-900 text-white inline-block">1 Rencana</div>
                            <p class="text-xs text-gray-500 mt-1">100% selesai</p>
                        </td>
                        <td class="px-4 py-4 text-center">
                            <div class="px-3 py-1 rounded-full bg-blue-900 text-white inline-block">2 Rencana</div>
                            <p class="text-xs text-gray-500 mt-1">50% selesai</p>
                        </td>
                        <td class="px-4 py-4 text-center">
                            <div class="px-3 py-1 rounded-full bg-blue-900 text-white inline-block">1 Rencana</div>
                            <p class="text-xs text-gray-500 mt-1">0% selesai</p>
                        </td>
                        <td class="px-4 py-4 text-center text-gray-400">-</td>
                        <!-- Realisasi Kegiatan -->
                        <td class="px-4 py-4 text-center">
                            <div class="px-3 py-1 rounded-full bg-emerald-600 text-white inline-block">1 Selesai</div>
                            <p class="text-xs text-gray-500 mt-1">1 sesuai rencana</p>
                        </td>
                        <td class="px-4 py-4 text-center text-gray-400">Belum Realisasi</td>
                        <td class="px-4 py-4 text-center text-gray-400">Belum Realisasi</td>
                        <td class="px-4 py-4 text-center">
                            <div class="px-3 py-1 rounded-full bg-emerald-600 text-white inline-block">1 Selesai</div>
                            <p class="text-xs text-orange-500 mt-1">+1 lintas triwulan</p>
                        </td>
                        <!-- Aksi -->
                        <td class="px-4 py-4 text-center relative" x-data="{ open: false}">
                            {{-- tombol trigger --}}
                            <button 
                                @click="open = !open"
                                {{-- icon --}}
                                class="p-2 rounded-xl hover:bg-emerald-600 hover:text-white focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                    <path d="M2 8a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM6.5 8a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM12.5 6.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Z" />
                                </svg>
                            </button>
                            {{-- Dropdown menu --}}
                            <div
                                x-show="open"
                                @click.outside= "open=false"
                                class="absolute right-0 mt-2 w-32 bg-white border rounded-lg shadow-lg z-10">
                                <button class="flex gap-1 sm:text-xs w-full text-left px-4 py-2 text-sm text-black hover:bg-emerald-600 hover:text-white">
                                    {{-- icon --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" />
                                        <path fill-rule="evenodd" d="M1.38 8.28a.87.87 0 0 1 0-.566 7.003 7.003 0 0 1 13.238.006.87.87 0 0 1 0 .566A7.003 7.003 0 0 1 1.379 8.28ZM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" clip-rule="evenodd" />
                                    </svg>
                                    Detail
                                </button>
                                <button class="flex gap-1 sm:text-xs w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-emerald-600 hover:text-white">
                                    {{-- icon --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                        <path fill-rule="evenodd" d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z" clip-rule="evenodd" />
                                    </svg>
                                    Edit
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>