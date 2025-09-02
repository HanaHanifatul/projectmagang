<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <!-- Tailwind Elements -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>
<body>
    <div>
        {{-- Navbar --}}
        <x-navbar ></x-navbar>
        {{-- Header --}}
        <x-header></x-header>
    </div>

    {{-- <p class="text-center text-gray-500 text-sm">Maaf Laman Ini Belum Tersedia</p> --}}
    <main>
        <div class="max-w-7xl mx-auto px-4 space-y-6">
            <div class="p-6">
                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <a href="/ketuatim" class="rounded-md text-sm px-2 py-2 sm:text-xs hover:bg-emerald-600 hover:text-white">&larr; Kembali ke Dashboard</a>
                </div>

                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-bold mb-2">Sakernas</h1>
                        <p class="text-gray-600 mb-4">Sakernas</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-semibold">83%</p>
                        <p class="text-gray-500 text-sm">Progress Keseluruhan</p>
                    </div>
                </div>

                <!-- Judul -->
                

                <!-- Badges -->
                <div class="flex gap-2 mb-6">
                    <span class="px-3 py-1 bg-blue-600 text-white rounded-full text-sm">6 Tahapan</span>
                    <span class="px-3 py-1 bg-emerald-600 text-white rounded-full text-sm">5 Selesai</span>
                </div>

                <!-- Card Tahapan -->
                <div class="bg-white rounded-xl shadow p-6 border">
                    <!-- Header Card -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 flex items-center justify-center rounded-full bg-emerald-100 text-emerald-600 font-semibold">
                                P
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold">Perekrutan Anggota</h2>
                                <div class="flex gap-2 mt-1">
                                    <span class="px-2 py-0.5 bg-gray-200 rounded-lg text-xs">Persiapan</span>
                                    <span class="px-2 py-0.5 bg-emerald-200 text-emerald-700 rounded-lg text-xs">Selesai</span>
                                    <span class="px-2 py-0.5 bg-blue-200 text-blue-700 rounded-lg text-xs">Q1</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-emerald-600">✔</div>
                    </div>

                    <!-- Konten Card -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Rencana -->
                        <div>
                            <h3 class="font-semibold mb-2">Rencana</h3>
                            <p class="text-sm text-gray-600">Periode</p>
                            <p class="text-sm mb-2">15 Januari 2024 - 31 Januari 2024</p>

                            <p class="text-sm text-gray-600">Narasi</p>
                            <p class="text-sm mb-2">Melakukan perekrutan anggota tim survei</p>

                            <p class="text-sm text-gray-600">Dokumen</p>
                            <a href="#" class="text-blue-600 hover:underline text-sm">📄 Kriteria_Rekrutmen.pdf</a>
                        </div>

                        <!-- Realisasi -->
                        <div>
                            <h3 class="font-semibold mb-2">Realisasi</h3>
                            <p class="text-sm text-gray-600">Periode Aktual</p>
                            <p class="text-sm mb-2">15 Januari 2024 - 28 Januari 2024</p>

                            <p class="text-sm text-gray-600">Narasi</p>
                            <p class="text-sm mb-2">Berhasil merekrut 50 anggota tim survei</p>

                            <p class="text-sm text-gray-600">Kendala</p>
                            <p class="text-sm mb-2">Kesulitan mencari kandidat yang sesuai kualifikasi</p>

                            <p class="text-sm text-gray-600">Solusi</p>
                            <p class="text-sm mb-2">Memperluas jangkauan rekrutmen ke universitas</p>

                            <p class="text-sm text-gray-600">Tindak Lanjut</p>
                            <p class="text-sm mb-2">Evaluasi kinerja anggota tim yang baru direkrut</p>

                            <p class="text-sm text-gray-600">Bukti Pendukung Solusi</p>
                            <div class="flex flex-col gap-1">
                                <a href="#" class="text-blue-600 hover:underline text-sm">📷 Foto_Kegiatan_Rekrutmen.jpg</a>
                                <a href="#" class="text-blue-600 hover:underline text-sm">📄 Dokumentasi_Proses.pdf</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Edit -->
                    <div class="flex justify-end mt-4">
                        <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                            Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
    </main>

</body>
</html>