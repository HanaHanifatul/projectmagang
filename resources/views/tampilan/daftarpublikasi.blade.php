<div class="max-w-6xl mx-auto mt-6 p-6 bg-white bordershadow border rounded-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-3">
        <div>
            <h2 class="text-lg font-semibold text-blue-900">Daftar Publikasi/Laporan</h2>
            <p class="text-sm text-gray-500">Tabel ringkasan per publikasi/laporan per triwulan</p>
        </div>

        <div class="flex flex-wrap gap-2 justify-start sm:justify-end" x-data="{ open: false }">
            <!-- Tombol Unduh Excel -->
            <a href="{{ route('publications.exportTable') }}"
                class="flex items-center justify-center gap-1 border text-gray-700 px-3 py-2 rounded-lg text-xs sm:text-sm shadow hover:text-white hover:bg-emerald-800 whitespace-nowrap min-w-[100px]">
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
                    class="flex items-center justify-center gap-1 bg-emerald-600 text-white px-3 py-2 rounded-lg text-xs sm:text-sm shadow hover:bg-emerald-800 whitespace-nowrap min-w-[110px]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                        <path d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
                        </svg>
                    Publikasi
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
                    
                    <h2 class="text-lg font-semibold">Formulir Tambah Publikasi/Laporan</h2>
                    <p class="text-xs text-gray-500 mb-4">Catatan: Nama Laporan dapat memiliki banyak Nama Kegiatan</p>
                    <!-- Form -->
                    <form method="POST" action="{{ route('publications.store') }}"> 
                        @csrf
                        <!-- Nama Laporan -->
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Nama Laporan/Publikasi</label>
                            <select id="publication_report" name="publication_report" 
                                class="px-2 py-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                                <option value="">-- Pilih Nama Laporan --</option>
                                <option value="Laporan Statistik Kependudukan dan Ketenagakerjaan">Laporan Statistik Kependudukan dan Ketenagakerjaan</option>
                                <option value="Laporan Statistik Statistik Kesejahteraan Rakyat">Laporan Statistik Statistik Kesejahteraan Rakyat</option>
                                <option value="Laporan Statistik Ketahanan Sosial">Laporan Statistik Ketahanan Sosial</option>
                                <option value="Laporan Statistik Tanaman Pangan">Laporan Statistik Tanaman Pangan</option>
                                <option value="Laporan Statistik Peternakan, Perikanan, dan Kehutanan">Laporan Statistik Peternakan, Perikanan, dan Kehutanan</option>
                                <option value="Laporan Statistik Industri">Laporan Statistik Industri</option>
                                <option value="Laporan Statistik Distribusi">Laporan Statistik Distribusi</option>
                                <option value="Laporan Statistik Harga">Laporan Statistik Harga</option>
                                <option value="Laporan Statistik Keuangan, Teknologi Informasi, dan Pariwisata">Laporan Statistik Keuangan, Teknologi Informasi, dan Pariwisata</option>
                                <option value="Laporan Neraca Produksi">Laporan Neraca Produksi</option>
                                <option value="Laporan Neraca Pengeluaran">Laporan Neraca Pengeluaran</option>
                                <option value="Laporan Analisis dan Pengembangan Statistik">Laporan Analisis dan Pengembangan Statistik</option>
                                <option value="Tingkat Penyelenggaraan Pembinaan Statistik Sektoral sesuai Standar">Tingkat Penyelenggaraan Pembinaan Statistik Sektoral sesuai Standar</option>
                                <option value="Indeks Pelayanan Publik - Penilaian Mandiri">Indeks Pelayanan Publik - Penilaian Mandiri</option>
                                <option value="Nilai SAKIP oleh Inspektorat">Nilai SAKIP oleh Inspektorat</option>
                                <option value="Indeks Implementasi BerAKHLAK">Indeks Implementasi BerAKHLAK</option>
                                <option value="other"> -- Tambahkan Lainnya -- </option>
                            </select>
                        </div>

                         <!-- Input tambahan untuk "other" -->
                        <div class="mb-3" id="other_input" style="display: none;">
                            <label class="block text-sm font-medium text-gray-700">Nama Laporan Lainnya</label>
                            <input type="text" name="publication_report_other" 
                                class="w-full border rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                placeholder="Tulis nama laporan lain di sini...">
                        </div>

                        <!-- Nama kegiatan -->
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
                            <input type="text" name="publication_name" 
                            class="w-full border rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            placeholder="Contoh: Sakernas">
                        </div>
                        <!-- PIC -->
                        <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700">PIC</label>
                            <select name="publication_pic" 
                                class="px-2 py-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                                <option value="">-- Pilih PIC --</option>
                                <option value="Umum">Tim Umum</option>
                                <option value="Produksi">Tim Produksi</option>
                                <option value="Distribusi">Tim Distribusi</option>
                                <option value="Neraca">Tim Neraca</option>
                                <option value="Sosial">Tim Sosial</option>
                                <option value="IPDS">Tim IPDS</option>
                            </select>
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
    </div>

    <!-- Search Bar -->
    <div class="mb-4 mt-1 border rounded-lg">
        <input 
            type="text"
            id="search"
            placeholder="Cari Berdasarkan Nama Publikasi/Laporan"
            class="w-full  px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <!-- Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-gray-100 text-gray-800 text-xs border-y">
                    <!-- Header Kolom -->
                    <tr class="border-y">
                        <th class="px-3 py-2">No</th>
                        <th class="px-3 py-2">Nama Publikasi/Laporan</th>
                        <th class="px-3 py-2">Nama Kegiatan</th>
                        <th class="px-3 py-2">PIC</th>
                        <th class="px-3 py-2">Tahapan</th>
                        <th class="px-3 py-2" colspan="4">Rencana Kegiatan</th>
                        <th class="px-3 py-2" colspan="4">Realisasi Kegiatan</th>
                        <th class="px-3 py-2">Aksi</th>
                    </tr>
                    <!-- Sub Header Kolom -->
                    <tr class="bg-gray-100 text-xs whitespace-nowrap">
                        <th class="px-3 py-2"></th>
                        <th class="px-3 py-2"></th>
                        <th class="px-3 py-2"></th>
                        <th class="px-3 py-2"></th>
                        <th class="px-3 py-2"></th>
                        <th class="px-3 py-2 text-blue-800">Triwulan I</th>
                        <th class="px-3 py-2 text-blue-800">Triwulan II</th>
                        <th class="px-3 py-2 text-blue-800">Triwulan III</th>
                        <th class="px-3 py-2 text-blue-800">Triwulan IV</th>
                        <th class="px-3 py-2 text-emerald-800">Triwulan I</th>
                        <th class="px-3 py-2 text-emerald-800">Triwulan II</th>
                        <th class="px-3 py-2 text-emerald-800">Triwulan III</th>
                        <th class="px-3 py-2 text-emerald-800">Triwulan IV</th>
                        <th class="px-3 py-2"></th>
                    </tr>
                </thead>
                <tbody id="publication-table-body">
                    <!-- Isi Tabel -->
                    @if($publications->count())
                        @foreach($publications as $index => $publication)
                        <tr>
                            <!-- No -->
                            <td class="px-4 py-4 align-top">{{ $index + 1 }}</td>
                            <!-- Nama Publikasi -->
                            <td class="px-4 py-4 align-top font-semibold text-gray-700">{{ $publication->publication_report }}</td>
                            <!-- Nama Kegiatan -->
                            <td class="px-4 py-4 align-top font-semibold text-gray-700">{{ $publication->publication_name }}</td>
                            <!-- PIC -->
                            <td class="px-4 py-4 align-top font-semibold text-gray-700">{{ $publication->publication_pic }}</td>
                            <!-- Tahapan -->
                            <td class="px-4 py-4 align-top">
                                <div class="text-sm font-medium text-gray-700"> {{ array_sum($publication->rekapFinals) }}/{{ array_sum($publication->rekapPlans) }} Tahapan</div>
                                <div class="flex items-center gap-2 mt-1">
                                <span class="px-2 py-0.5 text-xs bg-gray-100 border rounded-full">{{ $publication->progressKumulatif }}% selesai</span>
                                </div>
                                <!-- <p class="text-xs text-gray-500 mt-1">Penyusunan Kuesioner, Wawancara Rumah Tangga, +2 lainnya</p> -->
                            </td>
                            <!-- Rencana Kegiatan-->
                            <!-- Rencana Triwulan I -->
                            <td class="px-4 py-4 text-center">
                                @if(($publication->rekapPlans[1] ?? 0) > 0)
                                <div class="relative group inline-block">
                                    <div class="px-3 py-1 rounded-full bg-blue-900 text-white inline-block cursor-pointer hover:bg-blue-800 transition">
                                        {{ $publication->rekapPlans[1] }} Rencana
                                    </div>
                                    <!-- Tooltip muncul saat hover -->
                                    <div class="absolute left-1/2 -translate-x-1/2 top-full mt-2 hidden group-hover:block bg-white border border-gray-200 shadow-lg rounded-lg p-2 w-64 text-sm text-gray-700 z-50">
                                        <p class="font-semibold text-gray-800 mb-1">Daftar Rencana:</p>
                                        <ul class="list-disc pl-4 space-y-1 max-h-40 overflow-y-auto">
                                            @foreach($publication->listPlans[1] as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ number_format($publication->progressTriwulan[1] ?? 0, 0) }}% selesai
                                    </p>
                                @else
                                    <div class="px-3 py-1 text-black inline-block"> - </div>
                                    <p class="text-xs text-gray-500 mt-1">0% Direncanakan</p>
                                @endif
                            </td>
                            <!-- Rencana Triwulan II -->
                            <td class="px-4 py-4 text-center">
                                @if(($publication->rekapPlans[2] ?? 0) > 0)
                                <div class="relative group inline-block">
                                    <div class="px-3 py-1 rounded-full bg-blue-900 text-white inline-block cursor-pointer hover:bg-blue-800 transition">
                                        {{ $publication->rekapPlans[2] }} Rencana
                                    </div>
                                    <!-- Tooltip muncul saat hover -->
                                    <div class="absolute left-1/2 -translate-x-1/2 top-full mt-2 hidden group-hover:block bg-white border border-gray-200 shadow-lg rounded-lg p-2 w-64 text-sm text-gray-700 z-50">
                                        <p class="font-semibold text-gray-800 mb-1">Daftar Rencana:</p>
                                        <ul class="list-disc pl-4 space-y-1 max-h-40 overflow-y-auto">
                                            @foreach($publication->listPlans[2] as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ number_format($publication->progressTriwulan[2] ?? 0, 0) }}% selesai
                                    </p>
                                @else
                                    <div class="px-3 py-1 text-black inline-block"> - </div>
                                    <p class="text-xs text-gray-500 mt-1">0% Direncanakan</p>
                                @endif
                            </td>
                            <!-- Rencana Triwulan III -->
                            <td class="px-4 py-4 text-center">
                                @if(($publication->rekapPlans[3] ?? 0) > 0)
                                <div class="relative group inline-block">
                                    <div class="px-3 py-1 rounded-full bg-blue-900 text-white inline-block cursor-pointer hover:bg-blue-800 transition">
                                        {{ $publication->rekapPlans[3] }} Rencana
                                    </div>
                                    <!-- Tooltip muncul saat hover -->
                                    <div class="absolute left-1/2 -translate-x-1/2 top-full mt-2 hidden group-hover:block bg-white border border-gray-200 shadow-lg rounded-lg p-2 w-64 text-sm text-gray-700 z-50">
                                        <p class="font-semibold text-gray-800 mb-1">Daftar Rencana:</p>
                                        <ul class="list-disc pl-4 space-y-1 max-h-40 overflow-y-auto">
                                            @foreach($publication->listPlans[3] as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ number_format($publication->progressTriwulan[3] ?? 0, 0) }}% selesai
                                    </p>
                                @else
                                    <div class="px-3 py-1 text-black inline-block"> - </div>
                                    <p class="text-xs text-gray-500 mt-1">0% Direncanakan</p>
                                @endif
                            </td>
                            <!-- Rencana Triwulan IV -->
                            <td class="px-4 py-4 text-center">
                                @if(($publication->rekapPlans[4] ?? 0) > 0)
                                <div class="relative group inline-block">
                                    <div class="px-3 py-1 rounded-full bg-blue-900 text-white inline-block cursor-pointer hover:bg-blue-800 transition">
                                        {{ $publication->rekapPlans[4] }} Rencana
                                    </div>
                                    <!-- Tooltip muncul saat hover -->
                                    <div class="absolute left-1/2 -translate-x-1/2 top-full mt-2 hidden group-hover:block bg-white border border-gray-200 shadow-lg rounded-lg p-2 w-64 text-sm text-gray-700 z-50">
                                        <p class="font-semibold text-gray-800 mb-1">Daftar Rencana:</p>
                                        <ul class="list-disc pl-4 space-y-1 max-h-40 overflow-y-auto">
                                            @foreach($publication->listPlans[4] as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ number_format($publication->progressTriwulan[4] ?? 0, 0) }}% selesai
                                    </p>
                                @else
                                <div class="px-3 py-1 text-black inline-block"> - </div>
                                    <p class="text-xs text-gray-500 mt-1">0% Direncanakan</p>
                                @endif
                            </td>
                            <!-- Realisasi Kegiatan -->
                            <!-- Realisasi Triwulan I -->
                            <td class="px-4 py-4 text-center">
                                @if(($publication->rekapFinals[1] ?? 0) > 0)
                                    <div class="relative inline-block group">
                                        <div class="px-3 py-1 rounded-full bg-emerald-600 text-white inline-block cursor-pointer">
                                            {{ $publication->rekapFinals[1] }} Selesai
                                        </div>

                                        {{-- Tooltip daftar realisasi, muncul hanya saat hover --}}
                                        <div class="absolute left-1/2 -translate-x-1/2 top-full mt-2 hidden group-hover:block 
                                                    bg-white border border-gray-200 shadow-lg rounded-lg p-2 w-64 text-sm 
                                                    text-gray-700 z-50">
                                            <p class="font-semibold text-gray-800 mb-1">Daftar Realisasi:</p>
                                            <ul class="list-disc pl-4 space-y-1 max-h-40 overflow-y-auto">
                                                @foreach($publication->listFinals[1] ?? [] as $item)
                                                    <li>{{ $item }}</li>
                                                @endforeach
                                            </ul>

                                            @if(($publication->lintasTriwulan[1] ?? 0) > 0)
                                                <div class="mt-2 pt-2 border-t border-gray-200">
                                                    <p class="text-xs text-orange-500 font-medium">
                                                        +{{ $publication->lintasTriwulan[1] }} lintas triwulan:
                                                    </p>
                                                    <ul class="list-disc pl-4 text-xs">
                                                        @foreach($publication->listLintas[1] ?? [] as $lintas)
                                                            <li>
                                                                {{ $lintas['plan_name'] }} 
                                                                ({{ $lintas['from_quarter'] }} → {{ $lintas['to_quarter'] }})
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Tambahan teks di bawah --}}
                                    @if(($publication->lintasTriwulan[1] ?? 0) > 0)
                                        <p class="text-xs text-orange-500 mt-1">
                                            +{{ $publication->lintasTriwulan[1] }} lintas triwulan
                                        </p>
                                    @endif
                                @else
                                    <div class="px-3 py-1 text-black inline-block"> - </div>
                                @endif
                            </td>
                            <!-- Realisasi Triwulan II -->
                            <td class="px-4 py-4 text-center">
                                @if(($publication->rekapFinals[2] ?? 0) > 0)
                                    <div class="relative inline-block group">
                                        <div class="px-3 py-1 rounded-full bg-emerald-600 text-white inline-block cursor-pointer">
                                            {{ $publication->rekapFinals[2] }} Selesai
                                        </div>

                                        {{-- Tooltip daftar realisasi, muncul hanya saat hover --}}
                                        <div class="absolute left-1/2 -translate-x-1/2 top-full mt-2 hidden group-hover:block 
                                                    bg-white border border-gray-200 shadow-lg rounded-lg p-2 w-64 text-sm 
                                                    text-gray-700 z-50">
                                            <p class="font-semibold text-gray-800 mb-1">Daftar Realisasi:</p>
                                            <ul class="list-disc pl-4 space-y-1 max-h-40 overflow-y-auto">
                                                @foreach($publication->listFinals[2] ?? [] as $item)
                                                    <li>{{ $item }}</li>
                                                @endforeach
                                            </ul>

                                            @if(($publication->lintasTriwulan[2] ?? 0) > 0)
                                                <div class="mt-2 pt-2 border-t border-gray-200">
                                                    <p class="text-xs text-orange-500 font-medium">
                                                        +{{ $publication->lintasTriwulan[2] }} lintas triwulan:
                                                    </p>
                                                    <ul class="list-disc pl-4 text-xs">
                                                        @foreach($publication->listLintas[2] ?? [] as $lintas)
                                                            <li>
                                                                {{ $lintas['plan_name'] }} 
                                                                ({{ $lintas['from_quarter'] }} → {{ $lintas['to_quarter'] }})
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Tambahan teks di bawah --}}
                                    @if(($publication->lintasTriwulan[2] ?? 0) > 0)
                                        <p class="text-xs text-orange-500 mt-1">
                                            +{{ $publication->lintasTriwulan[2] }} lintas triwulan
                                        </p>
                                    @endif
                                @else
                                    <div class="px-3 py-1 text-black inline-block"> - </div>
                                @endif
                            </td>
                            <!-- Realisasi Triwulan III -->
                            <td class="px-4 py-4 text-center">
                                @if(($publication->rekapFinals[3] ?? 0) > 0)
                                    <div class="relative inline-block group">
                                        <div class="px-3 py-1 rounded-full bg-emerald-600 text-white inline-block cursor-pointer">
                                            {{ $publication->rekapFinals[3] }} Selesai
                                        </div>

                                        {{-- Tooltip daftar realisasi, muncul hanya saat hover --}}
                                        <div class="absolute left-1/2 -translate-x-1/2 top-full mt-2 hidden group-hover:block 
                                                    bg-white border border-gray-200 shadow-lg rounded-lg p-2 w-64 text-sm 
                                                    text-gray-700 z-50">
                                            <p class="font-semibold text-gray-800 mb-1">Daftar Realisasi:</p>
                                            <ul class="list-disc pl-4 space-y-1 max-h-40 overflow-y-auto">
                                                @foreach($publication->listFinals[3] ?? [] as $item)
                                                    <li>{{ $item }}</li>
                                                @endforeach
                                            </ul>

                                            @if(($publication->lintasTriwulan[3] ?? 0) > 0)
                                                <div class="mt-2 pt-2 border-t border-gray-200">
                                                    <p class="text-xs text-orange-500 font-medium">
                                                        +{{ $publication->lintasTriwulan[3] }} lintas triwulan:
                                                    </p>
                                                    <ul class="list-disc pl-4 text-xs">
                                                        @foreach($publication->listLintas[3] ?? [] as $lintas)
                                                            <li>
                                                                {{ $lintas['plan_name'] }} 
                                                                ({{ $lintas['from_quarter'] }} → {{ $lintas['to_quarter'] }})
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Tambahan teks di bawah --}}
                                    @if(($publication->lintasTriwulan[3] ?? 0) > 0)
                                        <p class="text-xs text-orange-500 mt-1">
                                            +{{ $publication->lintasTriwulan[3] }} lintas triwulan
                                        </p>
                                    @endif
                                @else
                                    <div class="px-3 py-1 text-black inline-block"> - </div>
                                @endif
                            </td>
                            <!-- Realisasi Triwulan IV -->
                            <td class="px-4 py-4 text-center">
                                @if(($publication->rekapFinals[4] ?? 0) > 0)
                                    <div class="relative inline-block group">
                                        <div class="px-3 py-1 rounded-full bg-emerald-600 text-white inline-block cursor-pointer">
                                            {{ $publication->rekapFinals[4] }} Selesai
                                        </div>

                                        {{-- Tooltip daftar realisasi, muncul hanya saat hover --}}
                                        <div class="absolute left-1/2 -translate-x-1/2 top-full mt-2 hidden group-hover:block 
                                                    bg-white border border-gray-200 shadow-lg rounded-lg p-2 w-64 text-sm 
                                                    text-gray-700 z-50">
                                            <p class="font-semibold text-gray-800 mb-1">Daftar Realisasi:</p>
                                            <ul class="list-disc pl-4 space-y-1 max-h-40 overflow-y-auto">
                                                @foreach($publication->listFinals[4] ?? [] as $item)
                                                    <li>{{ $item }}</li>
                                                @endforeach
                                            </ul>

                                            @if(($publication->lintasTriwulan[4] ?? 0) > 0)
                                                <div class="mt-2 pt-2 border-t border-gray-200">
                                                    <p class="text-xs text-orange-500 font-medium">
                                                        +{{ $publication->lintasTriwulan[4] }} lintas triwulan:
                                                    </p>
                                                    <ul class="list-disc pl-4 text-xs">
                                                        @foreach($publication->listLintas[4] ?? [] as $lintas)
                                                            <li>
                                                                {{ $lintas['plan_name'] }} 
                                                                ({{ $lintas['from_quarter'] }} → {{ $lintas['to_quarter'] }})
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Tambahan teks di bawah --}}
                                    @if(($publication->lintasTriwulan[4] ?? 0) > 0)
                                        <p class="text-xs text-orange-500 mt-1">
                                            +{{ $publication->lintasTriwulan[4] }} lintas triwulan
                                        </p>
                                    @endif
                                @else
                                    <div class="px-3 py-1 text-black inline-block"> - </div>
                                @endif
                            </td>
                            <!-- Aksi -->
                            <td class="px-4 py-4 text-center">
                                <!-- Tombol Detail -->
                                <a href="{{ route('steps.index', $publication->slug_publication) }}" 
                                class="flex gap-1 sm:text-xs px-3 py-1 text-sm text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" />
                                        <path fill-rule="evenodd" d="M1.38 8.28a.87.87 0 0 1 0-.566 7.003 7.003 0 0 1 13.238.006.87.87 0 0 1 0 .566A7.003 7.003 0 0 1 1.379 8.28ZM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" clip-rule="evenodd" />
                                    </svg>
                                    Detail
                                </a>

                                @if(auth()->check() && auth()->user()->role === 'ketua_tim')
                                    <div x-data="{
                                        open: false, 
                                        editOpen: false, 
                                        editId: null, 
                                        editReport: '', 
                                        editReportOther: '', 
                                        editOther: false, 
                                        editName: '', 
                                        editPic: '' 
                                    }">

                                    <!-- Tombol Edit -->
                                    <button onclick="openEditModal('{{ $publication->slug_publication }}', '{{ $publication->publication_report }}', '{{ $publication->publication_name }}', '{{ $publication->publication_pic }}')"
                                        class="flex gap-1 sm:text-xs px-3 py-1 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded-lg mb-1">
                                        <!-- Ikon Pensil -->
                                        <svg xmlns="http://www.w3.org/2000/svg" 
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                                            stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" 
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13l-3.247.974.974-3.247a4.5 4.5 0 011.13-1.897l10.32-10.32z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" 
                                                d="M19.5 7.125L16.875 4.5" />
                                        </svg>
                                        Edit
                                    </button>                              

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('publications.destroy', $publication->slug_publication) }}" method="POST" 
                                        onsubmit="return confirm('Yakin hapus publikasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="flex gap-1 sm:text-xs px-3 py-1 text-sm text-white bg-red-600 hover:bg-red-700 rounded-lg mb-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                <path fill-rule="evenodd" d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z" clip-rule="evenodd"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="14" class="text-center text-gray-500 py-4">Tidak ada data ditemukan</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            
           <!-- Modal Edit Global -->
            <div id="editModal" 
                class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

            <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative" 
                x-data="{ editReport: '', editOther: false, editReportOther: '' }">

                <!-- Tombol close -->
                <button type="button" onclick="closeEditModal()" 
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                ✖
                </button>

                <h2 class="text-lg font-semibold mb-4">Edit Publikasi</h2>

                <form id="editForm" method="POST" action="{{ isset($publication) ? route('publications.update', $publication->slug_publication) : route('publications.store') }}">
                    @csrf
                    @if(isset($publication))
                        @method('PUT')
                    @endif

                    <!-- Nama Laporan -->
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700">Nama Laporan/Publikasi</label>
                        <select id="edit_publication_report" name="publication_report" 
                                x-model="editReport"
                                @change="editReport === 'other' ? editOther = true : editOther = false"
                                class="px-2 py-2 w-full rounded-lg border-gray-300 shadow-sm 
                                    focus:border-emerald-500 focus:ring-emerald-500 text-sm">

                        <option value="">-- Pilih Nama Laporan --</option>
                        <option value="Laporan Statistik Kependudukan dan Ketenagakerjaan">Laporan Statistik Kependudukan dan Ketenagakerjaan</option>
                        <option value="Laporan Statistik Statistik Kesejahteraan Rakyat">Laporan Statistik Statistik Kesejahteraan Rakyat</option>
                        <option value="Laporan Statistik Ketahanan Sosial">Laporan Statistik Ketahanan Sosial</option>
                        <option value="Laporan Statistik Tanaman Pangan">Laporan Statistik Tanaman Pangan</option>
                        <option value="Laporan Statistik Peternakan, Perikanan, dan Kehutanan">Laporan Statistik Peternakan, Perikanan, dan Kehutanan</option>
                        <option value="Laporan Statistik Industri">Laporan Statistik Industri</option>
                        <option value="Laporan Statistik Distribusi">Laporan Statistik Distribusi</option>
                        <option value="Laporan Statistik Harga">Laporan Statistik Harga</option>
                        <option value="Laporan Statistik Keuangan, Teknologi Informasi, dan Pariwisata">Laporan Statistik Keuangan, Teknologi Informasi, dan Pariwisata</option>
                        <option value="Laporan Neraca Produksi">Laporan Neraca Produksi</option>
                        <option value="Laporan Neraca Pengeluaran">Laporan Neraca Pengeluaran</option>
                        <option value="Laporan Analisis dan Pengembangan Statistik">Laporan Analisis dan Pengembangan Statistik</option>
                        <option value="Tingkat Penyelenggaraan Pembinaan Statistik Sektoral sesuai Standar">Tingkat Penyelenggaraan Pembinaan Statistik Sektoral sesuai Standar</option>
                        <option value="Indeks Pelayanan Publik - Penilaian Mandiri">Indeks Pelayanan Publik - Penilaian Mandiri</option>
                        <option value="Nilai SAKIP oleh Inspektorat">Nilai SAKIP oleh Inspektorat</option>
                        <option value="Indeks Implementasi BerAKHLAK">Indeks Implementasi BerAKHLAK</option>
                        <option value="other"> -- Tambahkan Lainnya -- </option>
                        </select>
                    </div>

                    <!-- Input tambahan jika pilih "other" -->
                    <div class="mb-3" x-show="editOther" x-transition>
                        <label class="block text-sm font-medium text-gray-700">Nama Laporan Lainnya</label>
                        <input type="text" name="publication_report_other" 
                            x-model="editReportOther"
                            class="w-full border rounded-lg px-3 py-2 mt-1 
                                    focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            placeholder="Tulis nama laporan lain di sini...">
                    </div>

                    <!-- Nama Kegiatan -->
                    <div class="mb-3">
                        <label class="block text-sm font-medium">Nama Kegiatan</label>
                        <input type="text" id="edit_name" name="publication_name" 
                            class="w-full border rounded-lg p-2">
                    </div>

                    <!-- PIC -->
                    <div class="mb-3">
                        <label class="block text-sm font-medium">PIC</label>
                        <select id="edit_pic" name="publication_pic" 
                                class="w-full border rounded-lg p-2">
                        <option value="Umum">Tim Umum</option>
                        <option value="Produksi">Tim Produksi</option>
                        <option value="Distribusi">Tim Distribusi</option>
                        <option value="Neraca">Tim Neraca</option>
                        <option value="Sosial">Tim Sosial</option>
                        <option value="IPDS">Tim IPDS</option>
                        </select>
                    </div>

                    <button type="submit" 
                            class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg mt-3">
                        Update
                    </button>
                </form>
            </div>
            </div>

    </div>
</div>

<!-- skrip untuk modal tambah publikasi -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const select = document.getElementById("publication_report");
        const otherInput = document.getElementById("other_input");

        select.addEventListener("change", function () {
            if (this.value === "other") {
                otherInput.style.display = "block";
            } else {
                otherInput.style.display = "none";
            }
        });
    });
</script>


<!-- skrip ajax fitur search -->
<script>
window.csrfToken = "{{ csrf_token() }}";
window.userRole = "{{ auth()->check() ? auth()->user()->role : '' }}"; //ambil role

// ✅ FIXED: Parameter diganti dari id ke slug, dan ditambahkan slug sebagai parameter
function openEditModal(slug, report, name, pic) {
    let modal = document.getElementById('editModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    // isi field non-alpine
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_pic').value = pic;

    // ✅ FIXED: Update action form dengan slug yang benar (JavaScript variable, bukan PHP)
    document.getElementById('editForm').action = `/publications/${slug}`;
    
    // ✅ FIXED: Tambahkan method spoofing untuk PUT request
    let methodInput = document.getElementById('editForm').querySelector('input[name="_method"]');
    if (!methodInput) {
        methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        document.getElementById('editForm').appendChild(methodInput);
    } else {
        methodInput.value = 'PUT';
    }

    // isi alpine variable untuk select laporan
    try {
        let alpineComp = Alpine.$data(document.querySelector('#editModal .bg-white'));
        alpineComp.editReport = report;
        alpineComp.editOther = (report === 'other');
        alpineComp.editReportOther = (report !== 'other') ? '' : report;
    } catch (e) {
        console.warn('Alpine.js not found or modal component not initialized:', e);
    }
}

function closeEditModal() {
    let modal = document.getElementById('editModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}


document.getElementById('search').addEventListener('keyup', function() {
    let query = this.value;
    let tbody = document.getElementById('publication-table-body');

    fetch(`/publications/search?query=${query}`)
        .then(res => res.json())
        .then(data => {
            // kalau kosong, tampilkan pesan
            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="14" class="text-center text-gray-500 py-4">
                            Tidak ada data ditemukan
                        </td>
                    </tr>
                `;
                return;
            }

            // isi tabel dengan data JSON
            tbody.innerHTML = data.map((item, index) => `
                <tr>
                    <!-- No -->
                    <td class="px-4 py-4 align-top">${index + 1}</td>

                    <!-- Nama Publikasi -->
                    <td class="px-4 py-4 align-top font-semibold text-gray-700">${item.publication_report}</td>

                    <!-- Nama Kegiatan -->
                    <td class="px-4 py-4 align-top font-semibold text-gray-700">${item.publication_name}</td>

                    <!-- PIC -->
                    <td class="px-4 py-4 align-top font-semibold text-gray-700">${item.publication_pic}</td>

                    <!-- Tahapan -->
                    <td class="px-4 py-4 align-top">
                        <div class="text-sm font-medium text-gray-700">
                            ${(Object.values(item.rekapFinals ?? {}).reduce((a,b)=>a+b,0))}/
                            ${(Object.values(item.rekapPlans ?? {}).reduce((a,b)=>a+b,0))} Tahapan
                        </div>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="px-2 py-0.5 text-xs bg-gray-100 border rounded-full">
                                ${Math.round(item.progressKumulatif ?? 0)}% selesai
                            </span>
                        </div>
                    </td>

                    <!-- Rencana Triwulan I -->
                    <td class="px-4 py-4 text-center">
                        ${(item.rekapPlans?.[1] ?? 0) > 0
                            ? `<div class="relative group inline-block">
                                   <div class="px-3 py-1 rounded-full bg-blue-900 text-white inline-block cursor-pointer hover:bg-blue-800 transition">
                                       ${item.rekapPlans[1]} Rencana
                                   </div>
                                   <div class="absolute left-1/2 -translate-x-1/2 top-full mt-2 hidden group-hover:block bg-white border border-gray-200 shadow-lg rounded-lg p-2 w-64 text-sm text-gray-700 z-50">
                                       <p class="font-semibold text-gray-800 mb-1">Daftar Rencana:</p>
                                       <ul class="list-disc pl-4 space-y-1 max-h-40 overflow-y-auto">
                                           ${(item.listPlans?.[1] || []).map(plan => `<li>${plan}</li>`).join('')}
                                       </ul>
                                   </div>
                               </div>
                               <p class="text-xs text-gray-500 mt-1">${Math.round(item.progressTriwulan?.[1] ?? 0)}% selesai</p>`
                            : `<div class="px-3 py-1 text-black inline-block"> - </div>
                               <p class="text-xs text-gray-500 mt-1">0% Direncanakan</p>`
                        }
                    </td>

                    <!-- Rencana Triwulan II -->
                    <td class="px-4 py-4 text-center">
                        ${(item.rekapPlans?.[2] ?? 0) > 0
                            ? `<div class="relative group inline-block">
                                   <div class="px-3 py-1 rounded-full bg-blue-900 text-white inline-block cursor-pointer hover:bg-blue-800 transition">
                                       ${item.rekapPlans[2]} Rencana
                                   </div>
                                   <div class="absolute left-1/2 -translate-x-1/2 top-full mt-2 hidden group-hover:block bg-white border border-gray-200 shadow-lg rounded-lg p-2 w-64 text-sm text-gray-700 z-50">
                                       <p class="font-semibold text-gray-800 mb-1">Daftar Rencana:</p>
                                       <ul class="list-disc pl-4 space-y-1 max-h-40 overflow-y-auto">
                                           ${(item.listPlans?.[2] || []).map(plan => `<li>${plan}</li>`).join('')}
                                       </ul>
                                   </div>
                               </div>
                               <p class="text-xs text-gray-500 mt-1">${Math.round(item.progressTriwulan?.[2] ?? 0)}% selesai</p>`
                            : `<div class="px-3 py-1 text-black inline-block"> - </div>
                               <p class="text-xs text-gray-500 mt-1">0% Direncanakan</p>`
                        }
                    </td>

                    <!-- Rencana Triwulan III -->
                    <td class="px-4 py-4 text-center">
                        ${(item.rekapPlans?.[3] ?? 0) > 0
                            ? `<div class="relative group inline-block">
                                   <div class="px-3 py-1 rounded-full bg-blue-900 text-white inline-block cursor-pointer hover:bg-blue-800 transition">
                                       ${item.rekapPlans[3]} Rencana
                                   </div>
                                   <div class="absolute left-1/2 -translate-x-1/2 top-full mt-2 hidden group-hover:block bg-white border border-gray-200 shadow-lg rounded-lg p-2 w-64 text-sm text-gray-700 z-50">
                                       <p class="font-semibold text-gray-800 mb-1">Daftar Rencana:</p>
                                       <ul class="list-disc pl-4 space-y-1 max-h-40 overflow-y-auto">
                                           ${(item.listPlans?.[3] || []).map(plan => `<li>${plan}</li>`).join('')}
                                       </ul>
                                   </div>
                               </div>
                               <p class="text-xs text-gray-500 mt-1">${Math.round(item.progressTriwulan?.[3] ?? 0)}% selesai</p>`
                            : `<div class="px-3 py-1 text-black inline-block"> - </div>
                               <p class="text-xs text-gray-500 mt-1">0% Direncanakan</p>`
                        }
                    </td>

                    <!-- Rencana Triwulan IV -->
                    <td class="px-4 py-4 text-center">
                        ${(item.rekapPlans?.[4] ?? 0) > 0
                            ? `<div class="relative group inline-block">
                                   <div class="px-3 py-1 rounded-full bg-blue-900 text-white inline-block cursor-pointer hover:bg-blue-800 transition">
                                       ${item.rekapPlans[4]} Rencana
                                   </div>
                                   <div class="absolute left-1/2 -translate-x-1/2 top-full mt-2 hidden group-hover:block bg-white border border-gray-200 shadow-lg rounded-lg p-2 w-64 text-sm text-gray-700 z-50">
                                       <p class="font-semibold text-gray-800 mb-1">Daftar Rencana:</p>
                                       <ul class="list-disc pl-4 space-y-1 max-h-40 overflow-y-auto">
                                           ${(item.listPlans?.[4] || []).map(plan => `<li>${plan}</li>`).join('')}
                                       </ul>
                                   </div>
                               </div>
                               <p class="text-xs text-gray-500 mt-1">${Math.round(item.progressTriwulan?.[4] ?? 0)}% selesai</p>`
                            : `<div class="px-3 py-1 text-black inline-block"> - </div>
                               <p class="text-xs text-gray-500 mt-1">0% Direncanakan</p>`
                        }
                    </td>

                    <!-- Realisasi Triwulan I -->
                    <td class="px-4 py-4 text-center">
                        ${(item.rekapFinals?.[1] ?? 0) > 0
                            ? `<div class="relative inline-block group">
                                   <div class="px-3 py-1 rounded-full bg-emerald-600 text-white inline-block cursor-pointer">
                                       ${item.rekapFinals[1]} Selesai
                                   </div>
                                   <div class="absolute left-1/2 -translate-x-1/2 top-full mt-2 hidden group-hover:block bg-white border border-gray-200 shadow-lg rounded-lg p-2 w-64 text-sm text-gray-700 z-50">
                                       <p class="font-semibold text-gray-800 mb-1">Daftar Realisasi:</p>
                                       <ul class="list-disc pl-4 space-y-1 max-h-40 overflow-y-auto">
                                           ${(item.listFinals?.[1] || []).map(final => `<li>${final}</li>`).join('')}
                                       </ul>
                                       ${(item.lintasTriwulan?.[1] ?? 0) > 0 ? `
                                       <div class="mt-2 pt-2 border-t border-gray-200">
                                           <p class="text-xs text-orange-500 font-medium">
                                               +${item.lintasTriwulan[1]} lintas triwulan:
                                           </p>
                                           <ul class="list-disc pl-4 text-xs">
                                               ${(item.listLintas?.[1] || []).map(lintas => `
                                                   <li>${lintas.plan_name} (${lintas.from_quarter} → ${lintas.to_quarter})</li>
                                               `).join('')}
                                           </ul>
                                       </div>` : ''}
                                   </div>
                               </div>
                               ${(item.lintasTriwulan?.[1] ?? 0) > 0 ? `<p class="text-xs text-orange-500 mt-1">+${item.lintasTriwulan[1]} lintas triwulan</p>` : ''}`
                            : `<div class="px-3 py-1 text-black inline-block"> - </div>`
                        }
                    </td>

                    <!-- Realisasi Triwulan II -->
                    <td class="px-4 py-4 text-center">
                        ${(item.rekapFinals?.[2] ?? 0) > 0
                            ? `<div class="relative inline-block group">
                                   <div class="px-3 py-1 rounded-full bg-emerald-600 text-white inline-block cursor-pointer">
                                       ${item.rekapFinals[2]} Selesai
                                   </div>
                                   <div class="absolute left-1/2 -translate-x-1/2 top-full mt-2 hidden group-hover:block bg-white border border-gray-200 shadow-lg rounded-lg p-2 w-64 text-sm text-gray-700 z-50">
                                       <p class="font-semibold text-gray-800 mb-1">Daftar Realisasi:</p>
                                       <ul class="list-disc pl-4 space-y-1 max-h-40 overflow-y-auto">
                                           ${(item.listFinals?.[2] || []).map(final => `<li>${final}</li>`).join('')}
                                       </ul>
                                       ${(item.lintasTriwulan?.[2] ?? 0) > 0 ? `
                                       <div class="mt-2 pt-2 border-t border-gray-200">
                                           <p class="text-xs text-orange-500 font-medium">
                                               +${item.lintasTriwulan[2]} lintas triwulan:
                                           </p>
                                           <ul class="list-disc pl-4 text-xs">
                                               ${(item.listLintas?.[2] || []).map(lintas => `
                                                   <li>${lintas.plan_name} (${lintas.from_quarter} → ${lintas.to_quarter})</li>
                                               `).join('')}
                                           </ul>
                                       </div>` : ''}
                                   </div>
                               </div>
                               ${(item.lintasTriwulan?.[2] ?? 0) > 0 ? `<p class="text-xs text-orange-500 mt-1">+${item.lintasTriwulan[2]} lintas triwulan</p>` : ''}`
                            : `<div class="px-3 py-1 text-black inline-block"> - </div>`
                        }
                    </td>

                    <!-- Realisasi Triwulan III -->
                    <td class="px-4 py-4 text-center">
                        ${(item.rekapFinals?.[3] ?? 0) > 0
                            ? `<div class="relative inline-block group">
                                   <div class="px-3 py-1 rounded-full bg-emerald-600 text-white inline-block cursor-pointer">
                                       ${item.rekapFinals[3]} Selesai
                                   </div>
                                   <div class="absolute left-1/2 -translate-x-1/2 top-full mt-2 hidden group-hover:block bg-white border border-gray-200 shadow-lg rounded-lg p-2 w-64 text-sm text-gray-700 z-50">
                                       <p class="font-semibold text-gray-800 mb-1">Daftar Realisasi:</p>
                                       <ul class="list-disc pl-4 space-y-1 max-h-40 overflow-y-auto">
                                           ${(item.listFinals?.[3] || []).map(final => `<li>${final}</li>`).join('')}
                                       </ul>
                                       ${(item.lintasTriwulan?.[3] ?? 0) > 0 ? `
                                       <div class="mt-2 pt-2 border-t border-gray-200">
                                           <p class="text-xs text-orange-500 font-medium">
                                               +${item.lintasTriwulan[3]} lintas triwulan:
                                           </p>
                                           <ul class="list-disc pl-4 text-xs">
                                               ${(item.listLintas?.[3] || []).map(lintas => `
                                                   <li>${lintas.plan_name} (${lintas.from_quarter} → ${lintas.to_quarter})</li>
                                               `).join('')}
                                           </ul>
                                       </div>` : ''}
                                   </div>
                               </div>
                               ${(item.lintasTriwulan?.[3] ?? 0) > 0 ? `<p class="text-xs text-orange-500 mt-1">+${item.lintasTriwulan[3]} lintas triwulan</p>` : ''}`
                            : `<div class="px-3 py-1 text-black inline-block"> - </div>`
                        }
                    </td>

                    <!-- Realisasi Triwulan IV -->
                    <td class="px-4 py-4 text-center">
                        ${(item.rekapFinals?.[4] ?? 0) > 0
                            ? `<div class="relative inline-block group">
                                   <div class="px-3 py-1 rounded-full bg-emerald-600 text-white inline-block cursor-pointer">
                                       ${item.rekapFinals[4]} Selesai
                                   </div>
                                   <div class="absolute left-1/2 -translate-x-1/2 top-full mt-2 hidden group-hover:block bg-white border border-gray-200 shadow-lg rounded-lg p-2 w-64 text-sm text-gray-700 z-50">
                                       <p class="font-semibold text-gray-800 mb-1">Daftar Realisasi:</p>
                                       <ul class="list-disc pl-4 space-y-1 max-h-40 overflow-y-auto">
                                           ${(item.listFinals?.[4] || []).map(final => `<li>${final}</li>`).join('')}
                                       </ul>
                                       ${(item.lintasTriwulan?.[4] ?? 0) > 0 ? `
                                       <div class="mt-2 pt-2 border-t border-gray-200">
                                           <p class="text-xs text-orange-500 font-medium">
                                               +${item.lintasTriwulan[4]} lintas triwulan:
                                           </p>
                                           <ul class="list-disc pl-4 text-xs">
                                               ${(item.listLintas?.[4] || []).map(lintas => `
                                                   <li>${lintas.plan_name} (${lintas.from_quarter} → ${lintas.to_quarter})</li>
                                               `).join('')}
                                           </ul>
                                       </div>` : ''}
                                   </div>
                               </div>
                               ${(item.lintasTriwulan?.[4] ?? 0) > 0 ? `<p class="text-xs text-orange-500 mt-1">+${item.lintasTriwulan[4]} lintas triwulan</p>` : ''}`
                            : `<div class="px-3 py-1 text-black inline-block"> - </div>`
                        }
                    </td>

                    <td class="px-4 py-4 text-center">
                        ${(() => {
                            let html = `
                                <!-- Tombol Detail -->
                                <!-- ✅ FIXED: Route diganti ke /publications/{slug}/steps -->
                                <a href="/publications/${item.slug_publication}/steps" 
                                class="flex gap-1 sm:text-xs px-3 py-1 text-sm text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" />
                                        <path fill-rule="evenodd" d="M1.38 8.28a.87.87 0 0 1 0-.566 7.003 7.003 0 0 1 13.238.006.87.87 0 0 1 0 .566A7.003 7.003 0 0 1 1.379 8.28ZM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" clip-rule="evenodd" />
                                    </svg>
                                    Detail
                                </a>
                            `;

                            // Tambahkan tombol edit dan hapus hanya jika role = ketua_tim
                            if (window.userRole === "ketua_tim") {
                                // ✅ FIXED: Parameter onclick diganti ke slug_publication dan escape quotes
                                html += `
                                <button onclick="openEditModal('${item.slug_publication}', '${item.publication_report.replace(/'/g, "\\'")}', '${item.publication_name.replace(/'/g, "\\'")}', '${item.publication_pic.replace(/'/g, "\\'")}')"
                                    class="flex gap-1 sm:text-xs px-3 py-1 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded-lg mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                                        stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" 
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13l-3.247.974.974-3.247a4.5 4.5 0 011.13-1.897l10.32-10.32z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" 
                                            d="M19.5 7.125L16.875 4.5" />
                                    </svg>
                                    Edit
                                </button>
                                <button onclick="deletePublication('${item.slug_publication}')"
                                    class="flex gap-1 sm:text-xs px-3 py-1 text-sm text-white bg-red-600 hover:bg-red-700 rounded-lg mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                        <path fill-rule="evenodd" d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z" clip-rule="evenodd"/>
                                    </svg>
                                    Hapus
                                </button>
                                `;
                            }

                            return html;
                        })()}
                    </td>
                </tr>
            `).join('');
        })
        .catch(err => {
            console.error('Error fetching search results:', err);
            tbody.innerHTML = `
                <tr>
                    <td colspan="14" class="text-center text-red-500 py-4">
                        Terjadi kesalahan saat memuat data
                    </td>
                </tr>
            `;
        });
});

// ✅ FIXED: Function delete menggunakan slug_publication (UUID)
function deletePublication(slug_publication) {
    if (!confirm("Yakin ingin menghapus publikasi ini?")) return;

    // ✅ FIXED: Cek CSRF token dengan fallback
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfInput = document.querySelector('input[name="_token"]');
    const csrfToken = csrfMeta ? csrfMeta.content : (csrfInput ? csrfInput.value : '');

    if (!csrfToken) {
        console.error('CSRF token not found');
        alert('Error: CSRF token tidak ditemukan. Silakan refresh halaman.');
        return;
    }

    // ✅ Tambahkan loading state (optional)
    const deleteBtn = event.target.closest('button');
    const originalText = deleteBtn ? deleteBtn.innerHTML : '';
    if (deleteBtn) {
        deleteBtn.disabled = true;
        deleteBtn.innerHTML = '<svg class="animate-spin h-4 w-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menghapus...';
    }

    fetch(`/publications/${slug_publication}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json', // ✅ PENTING: Memberitahu server kita expect JSON
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest' // ✅ Menandai sebagai AJAX request
        }
    })
    .then(res => {
        // ✅ Cek status response
        if (!res.ok) {
            return res.json().then(err => {
                throw new Error(err.message || `HTTP error! status: ${res.status}`);
            });
        }
        return res.json();
    })
    .then(data => {
        if (data.success) {
            alert(data.message || "Berhasil dihapus");
            
            // ✅ Trigger search ulang jika ada query, atau reload
            const searchInput = document.getElementById('search');
            if (searchInput && searchInput.value) {
                searchInput.dispatchEvent(new Event('keyup'));
            } else {
                location.reload();
            }
        } else {
            throw new Error(data.message || 'Gagal menghapus publikasi');
        }
    })
    .catch(err => {
        console.error('Error deleting publication:', err);
        alert('Terjadi kesalahan saat menghapus publikasi: ' + err.message);
        
        // ✅ Restore button state jika error
        if (deleteBtn) {
            deleteBtn.disabled = false;
            deleteBtn.innerHTML = originalText;
        }
    });
}
</script>