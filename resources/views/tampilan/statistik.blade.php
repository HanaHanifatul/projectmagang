<div class="max-w-6xl mx-auto mt-6 p-6 bg-white bordershadow border rounded-lg" x-data="{ tab: 'publikasi' }">
    <div class="flex justify-between items-center mb-4">
        <!-- Header -->
        <div>
            <h2 class="text-lg font-semibold text-blue-900">Statistik Dashboard</h2>
            <p class="text-sm text-gray-500">Rekapitulasi data berdasarkan triwulan dan jenis tampilan</p>
        </div>
        <!-- Dropdown Triwulan -->
        <div>
            <label for="triwulan" class="mr-2 text-sm font-medium text-gray-700">Triwulan:</label>
            <select id="triwulan" class="rounded-md border text-sm" x-model="triwulan">
                <option>Triwulan I</option>
                <option>Triwulan II</option>
                <option>Triwulan III</option>
                <option>Triwulan IV</option>
            </select>
        </div>
    </div>
    <!-- Tab Button -->
    <div class="flex flex-col sm:flex-row border rounded overflow-hidden text-sm font-medium mb-4">
        <button 
            class="flex items-center justify-center gap-2 flex-1 py-2"
            :class="tab === 'publikasi' ? 'bg-blue-100 text-blue-900' : 'bg-gray-100 text-gray-600 hover:bg-white hover:text-blue-900'"
            @click="tab = 'publikasi'">
            <!-- Ikon Home dari Heroicons -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path fill-rule="evenodd" d="M11.986 3H12a2 2 0 0 1 2 2v6a2 2 0 0 1-1.5 1.937V7A2.5 2.5 0 0 0 10 4.5H4.063A2 2 0 0 1 6 3h.014A2.25 2.25 0 0 1 8.25 1h1.5a2.25 2.25 0 0 1 2.236 2ZM10.5 4v-.75a.75.75 0 0 0-.75-.75h-1.5a.75.75 0 0 0-.75.75V4h3Z" clip-rule="evenodd" />
                <path fill-rule="evenodd" d="M3 6a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H3Zm1.75 2.5a.75.75 0 0 0 0 1.5h3.5a.75.75 0 0 0 0-1.5h-3.5ZM4 11.75a.75.75 0 0 1 .75-.75h3.5a.75.75 0 0 1 0 1.5h-3.5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
            </svg>
            Rekapitulasi Publikasi
        </button>
        <button 
            class="flex items-center justify-center gap-2 flex-1 py-2"
            :class="tab === 'tahapan' ? 'bg-blue-100 text-blue-900' : 'bg-gray-100 text-gray-600 hover:bg-white hover:text-blue-900'"
            @click="tab = 'tahapan'">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path fill-rule="evenodd" d="M4 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H4Zm.75 7a.75.75 0 0 0-.75.75v1.5a.75.75 0 0 0 1.5 0v-1.5A.75.75 0 0 0 4.75 9Zm2.5-1.75a.75.75 0 0 1 1.5 0v4a.75.75 0 0 1-1.5 0v-4Zm4-3.25a.75.75 0 0 0-.75.75v6.5a.75.75 0 0 0 1.5 0v-6.5a.75.75 0 0 0-.75-.75Z" clip-rule="evenodd" />
            </svg>
            Rekapitulasi Tahapan
        </button>
    </div>
    <!-- Konten Tab -->
    <div>
         <!-- Ringkasan Publikasi -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <!-- Sedang Berlangsung -->
            <div class="relative p-4 border rounded text-center">
                <div class="absolute top-2 right-2 text-yellow-500">
                    <!-- icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 1 14 0A7 7 0 0 1 1 8Zm7.75-4.25a.75.75 0 0 0-1.5 0V8c0 .414.336.75.75.75h3.25a.75.75 0 0 0 0-1.5h-2.5v-3.5Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-sm text-gray-500">Sedang Berlangsung</p>
                <p class="text-2xl font-bold">{{ $sedangBerlangsung }}</p>
                <p class="text-xs text-gray-400">Publikasi dalam proses</p>
            </div>

            <!-- Sudah Selesai -->
            <div class="relative p-4 border rounded text-center">
                <div class="absolute top-2 right-2 text-emerald-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-sm text-gray-500">Sudah Selesai</p>
                <p class="text-2xl font-bold">{{ $sudahSelesai }}</p>
                <p class="text-xs text-gray-400">Publikasi yang telah selesai</p>
            </div>

            <!-- Tertunda/Mundur -->
            <div class="relative p-4 border rounded text-center">
                <div class="absolute top-2 right-2 text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6.701 2.25c.577-1 2.02-1 2.598 0l5.196 9a1.5 1.5 0 0 1-1.299 2.25H2.804a1.5 1.5 0 0 1-1.3-2.25l5.197-9ZM8 4a.75.75 0 0 1 .75.75v3a.75.75 0 1 1-1.5 0v-3A.75.75 0 0 1 8 4Zm0 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-sm text-gray-500">Tertunda/Mundur</p>
                <p class="text-2xl font-bold">{{ $tertunda }}</p>
                <p class="text-xs text-gray-400">Publikasi dengan penundaan</p>
            </div>

            <!-- Total -->
            <div class="relative p-4 border rounded text-center">
                <div class="absolute top-2 right-2 text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8c0 .982-.472 1.854-1.202 2.402a2.995 2.995 0 0 1-.848 2.547 2.995 2.995 0 0 1-2.548.849A2.996 2.996 0 0 1 8 15a2.996 2.996 0 0 1-2.402-1.202 2.995 2.995 0 0 1-2.547-.848 2.995 2.995 0 0 1-.849-2.548A2.996 2.996 0 0 1 1 8c0-.982.472-1.854 1.202-2.402a2.995 2.995 0 0 1 .848-2.547 2.995 2.995 0 0 1 2.548-.849A2.995 2.995 0 0 1 8 1c.982 0 1.854.472 2.402 1.202a2.995 2.995 0 0 1 2.547.848c.695.695.978 1.645.849 2.548A2.996 2.996 0 0 1 15 8Zm-3.291-2.843a.75.75 0 0 1 .135 1.052l-4.25 5.5a.75.75 0 0 1-1.151.043l-2.25-2.5a.75.75 0 1 1 1.114-1.004l1.65 1.832 3.7-4.789a.75.75 0 0 1 1.052-.134Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-sm text-gray-500">Total Publikasi</p>
                <p class="text-2xl font-bold">{{ $totalPublikasi }}</p>
                <p class="text-xs text-gray-400">Total di triwulan ini</p>
            </div>
        </div>

        <div x-show="tab === 'tahapan'">
            @include('statistik.rekapitulasi-tahapan')
        </div>
    </div>
</div>