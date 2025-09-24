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

    <main>
        <div class="max-w-7xl mx-auto px-4 space-y-6" x-data="{ open: false }">
            <div class="p-6">
                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <a href="/" 
                        class="flex gap-1 rounded-md text-sm px-2 py-2 sm:text-xs hover:bg-emerald-600 hover:text-white"> 
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                            <path fill-rule="evenodd" d="M14 8a.75.75 0 0 1-.75.75H4.56l3.22 3.22a.75.75 0 1 1-1.06 1.06l-4.5-4.5a.75.75 0 0 1 0-1.06l4.5-4.5a.75.75 0 0 1 1.06 1.06L4.56 7.25h8.69A.75.75 0 0 1 14 8Z" clip-rule="evenodd" />
                        </svg>
                        Kembali ke Dashboard
                    </a>
                </div>

                <!-- Judul -->
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-bold mb-2">{{ $publication->publication_report }}</h1>
                        <p class="text-xs sm:text-sm text-gray-600 mb-2">{{ $publication->publication_name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-semibold text-blue-800">83%</p>
                        <p class="text-xs sm:text-sm text-blue-800">Progress Keseluruhan</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-6 gap-2 mb-4 items-center">
                    <!-- Search (2 kolom di layar besar) -->
                    <div class="{{ (auth()->check() && auth()->user()->role === 'ketua_tim') ? 'sm:col-span-4' : 'sm:col-span-5' }}">
                       <form method="GET" action="{{ route('plans.index', $publication->publication_id) }}">
                            <input 
                            type="text" 
                            name="search"
                            placeholder="Cari Nama Tahapan..." 
                            value="{{ request('search') }}"
                            class="w-full border px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                        </form>
                    </div>
                    <!-- Tombol Unduh Excel -->
                    <div class="sm:col-span-1">
                        <a href="" 
                            class="flex items-center justify-center gap-1 border text-gray-700 px-3 py-2 rounded-lg text-xs sm:text-sm shadow hover:text-white hover:bg-emerald-800 whitespace-nowrap min-w-[100px]">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                <path d="M8.75 2.75a.75.75 0 0 0-1.5 0v5.69L5.03 6.22a.75.75 0 0 0-1.06 1.06l3.5 3.5a.75.75 0 0 0 1.06 0l3.5-3.5a.75.75 0 0 0-1.06-1.06L8.75 8.44V2.75Z" />
                                <path d="M3.5 9.75a.75.75 0 0 0-1.5 0v1.5A2.75 2.75 0 0 0 4.75 14h6.5A2.75 2.75 0 0 0 14 11.25v-1.5a.75.75 0 0 0-1.5 0v1.5c0 .69-.56 1.25-1.25 1.25h-6.5c-.69 0-1.25-.56-1.25-1.25v-1.5Z" />
                            </svg>
                            Unduh
                        </a>
                    </div>
                    <!-- Tambah Tahapan -->
                    @if(auth()->check() && auth()->user()->role === 'ketua_tim')
                        <div class="sm:col-span-1">
                            <div x-data="{ open: false }">
                                <button 
                                    @click="open = true" 
                                    class="w-full flex gap-1 items-center justify-center bg-emerald-600 text-white px-3 py-2 rounded-lg text-sm shadow hover:bg-emerald-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                        <path d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
                                    </svg>
                                    Tahapan
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
                                        <form method="POST" action="{{ route('tahapan.store') }}">
                                            @csrf
                                            <!-- publication -->
                                            <input type="hidden" name="publication_id" value="{{ $publication->publication_id }}">
                                            <!-- Jenis Tahapan -->
                                            <div class="mb-3">
                                                <label class="block text-sm font-medium text-gray-700">Jenis Tahapan</label>
                                                <select name="plan_type" 
                                                    class="px-2 py-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                                                    <option value="">-- Pilih Jenis Tahapan --</option>
                                                    <option value="persiapan">Persiapan</option>
                                                    <option value="pengumpulan data">Pengumpulan Data</option>
                                                    <option value="pengolahan data">Pengolahan Data</option>
                                                    <option value="analisis data">Analisis Data</option>
                                                    <option value="diseminasi">Diseminasi</option>
                                                </select>
                                            </div>

                                            <!-- Tambah Tahapan Survei -->
                                            <div class="mb-3">
                                                <label class="block text-sm font-medium text-gray-700">Nama Tahapan</label>
                                                <input type="text" name="plan_name" 
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
                        </div>
                    @endif
                </div>

                <!-- Badges -->
                <div class="flex gap-2 mb-6">
                    <span class="px-3 py-1 bg-blue-800 text-white rounded-full text-sm">{{ $total_rencana }} Tahapan</span>
                    <span class="px-3 py-1 bg-emerald-600 text-white rounded-full text-sm">{{ $total_realisasi }} Selesai</span>
                </div>

                <!-- Card -->
                @foreach ($stepsplans as $plan)
                    @php
                        // Mengambil data realisasi (akan null jika belum ada)
                        $final = $plan->stepsFinals;

                        // Inisialisasi $struggle. Jika $final null, ini akan tetap null.
                        $struggle = null;
                        if ($final) {
                            $struggle = $final->struggles->first();
                        }
                    @endphp

                    <div x-data="{ 
                    // State utama Alpine.js
                    editMode: false, 
                    tab:'rencana', 
                    DatesAreInvalid: false,
                    formIsInvalid: false,
                    fileSizeError:false, 
                    docTypeError:false, 
                    allowedTypes: ['image/jpeg', 'image/png', 'application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'],

                    // State utama Alpine.js
                    plan_start_date: '{{ $plan->plan_start_date ? $plan->plan_start_date->format('Y-m-d') : '' }}',
                    plan_end_date: '{{ $plan->plan_end_date ? $plan->plan_end_date->format('Y-m-d') : '' }}',
                    plan_desc: `{{ trim(old('plan_desc', $plan->plan_desc ?? '')) }}`,
                    hasPlanDoc: {{ $plan->plan_doc ? 'true' : 'false' }},
                    
                    // Variabel untuk form Realisasi
                    actual_started: '{{ optional($plan->stepsFinals->actual_started ?? null)->format('Y-m-d') ?? '' }}',
                    actual_ended: '{{ optional($plan->stepsFinals->actual_ended ?? null)->format('Y-m-d') ?? '' }}',
                    final_desc: '{{ old('final_desc', optional($final)->final_desc) }}',
                    next_step: '{{ old('next_step', optional($final)->next_step) }}',
                    hasFinalDoc: {{ optional($final)->final_doc ? 'true' : 'false' }},
                                      
                    validateDates(type) {
                        if (type === 'rencana') {
                            this.datesAreInvalid = (this.plan_start_date && this.plan_end_date) && new Date(this.plan_end_date) < new Date(this.plan_start_date);
                        } else { // type === 'realisasi'
                            this.datesAreInvalid = (this.actual_started && this.actual_ended) && new Date(this.actual_ended) < new Date(this.actual_started);
                        }
                        this.updateFormValidity();
                    },

                    {{-- // Fungsi validasi form
                    updateFormValidity() {
                        // Validasi hanya untuk form yang aktif dan elemen statis
                        if (this.tab === 'rencana') {
                            let isDocMissing = !this.hasPlanDoc && !this.fileSizeError && !this.docTypeError;
                            this.formIsInvalid = !this.plan_start_date || !this.plan_end_date || !this.plan_desc.trim() || this.datesAreInvalid || this.fileSizeError || this.docTypeError || isAnyStruggleEmpty || isFinalDocMissing;
                        } else if (this.tab === 'realisasi') {
                            let isFinalDocMissing = !this.hasFinalDoc  && !this.fileSizeError && !this.docTypeError;
                            this.formIsInvalid = !this.actual_started || !this.actual_ended || !this.final_desc.trim() || !this.next_step.trim() || this.datesAreInvalid || this.fileSizeError || this.docTypeError || isAnyStruggleEmpty || isFinalDocMissing;
                        }
                    } --}}

                   // Logika validasi form utama
        updateFormValidity() {
            let isDocMissing = false;
            let isAnyStruggleEmpty = false;

            if (this.tab === 'rencana') {
                isDocMissing = !this.hasPlanDoc && !this.fileSizeError && !this.docTypeError;
                this.formIsInvalid = !this.plan_start_date || !this.plan_end_date || !this.plan_desc.trim() || this.datesAreInvalid || this.fileSizeError || this.docTypeError || isDocMissing;
            } else if (this.tab === 'realisasi') {
                isDocMissing = !this.hasFinalDoc && !this.fileSizeError && !this.docTypeError;
                // Logika struggle bisa ditambahkan di sini jika Anda ingin validasi sisi klien
                this.formIsInvalid = !this.actual_started || !this.actual_ended || !this.final_desc.trim() || !this.next_step.trim() || this.datesAreInvalid || this.fileSizeError || this.docTypeError || isDocMissing || isAnyStruggleEmpty;
            }
        },
        
        handleFileChange(event, hasExistingDocVariable) {
            if (event.target.files.length > 0) {
                this.fileSizeError = event.target.files[0].size > 2097152;
                this.docTypeError = !this.allowedTypes.includes(event.target.files[0].type);
                // Tambahkan logika untuk memperbarui hasDocVariable
                this[hasExistingDocVariable] = true;
            } else {
                this.fileSizeError = false;
                this.docTypeError = false;
                // Atur kembali hasDocVariable jika file tidak dipilih
                this[hasExistingDocVariable] = false;
            }
            this.updateFormValidity();
        },

                    }" x-init="updateFormValidity()" class="bg-white rounded-xl shadow p-6 border">
                        <!-- Header Card (selalu ada) -->
                        <div class="flex items-center justify-between mb-4">
                            <!-- persiapan -->
                            <div class="flex items-center gap-3">
                                @php
                                    $colors = [
                                        'persiapan' => 'bg-blue-800',
                                        'pengumpulan data' => 'bg-yellow-600',
                                        'pengolahan data' => 'bg-orange-600',
                                        'analisis data' => 'bg-purple-600',
                                        'diseminasi' => 'bg-green-600',
                                    ];
                                    $bgColorClass = $colors[$plan->plan_type] ?? 'bg-gray-600';
                                @endphp
                                <div class="h-10 w-10 flex items-center justify-center rounded-full {{ $bgColorClass }} text-white font-semibold">
                                    {{ strtoupper($plan->plan_type[0]) }}
                                </div>
                                <div>
                                    <h2 class="text-lg font-semibold"></h2>
                                    <span class="py-3 text-lg font-bold">{{ $plan->plan_name }}</span>
                                    <div class="flex gap-2 mt-1">
                                        <span class="px-2 py-0.5 bg-gray-200 rounded-lg text-xs">{{ $plan->plan_type }}</span>
                                        @if($final)
                                            <span class="px-2 py-0.5 bg-emerald-600 text-white rounded-lg text-xs">Selesai</span>
                                        @else
                                            <span class="px-2 py-0.5 bg-blue-800 text-white rounded-lg text-xs">Rencana</span>
                                        @endif
                                        <span class="px-2 py-0.5 bg-gray-200 rounded-lg text-xs">Q1</span>
                                    </div>
                                </div>
                            </div>
                            <!-- icon ceklis -->
                            <div class="text-green-700">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    

                        <!-- Konten Card (hanya tampil kalau editMode = false) -->
                        <div x-show="!editMode" x-transition>
                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Rencana -->
                                <div>
                                    <h3 class="font-semibold mb-2">Rencana</h3>
                                    <p class="text-sm text-gray-600">Periode</p>
                                    <p class="text-sm mb-2">
                                        @if($plan->plan_start_date && $plan->plan_end_date)
                                            {{ $plan->plan_start_date->format('d F Y') }} - {{ $plan->plan_end_date->format('d F Y') }}
                                        @else
                                            <span class="text-gray-500 italic text-xs">Belum Diisi</span>
                                        @endif
                                    </p>
                                    <p class="text-sm text-gray-600">Narasi</p>
                                    <p class="text-sm mb-2">
                                        @if($plan->plan_desc)
                                            {{ $plan->plan_desc }}
                                        @else
                                            <span class="text-gray-500 italic text-xs">Belum Diisi</span>
                                        @endif
                                    </p>

                                    <p class="text-sm text-gray-600">Dokumen</p>
                                        @if ($plan->plan_doc)
                                            <a href="{{ Storage::url($plan->plan_doc) }}" target="_black" class="text-blue-600 hover:underline text-sm break-all">
                                                {{ $plan->plan_doc }}
                                            </a>
                                        @else
                                            <p class="text-xs italic text-gray-500">Tidak ada dokumen</p>
                                        @endif
                                </div>
                                <!-- Realisasi -->
                                <div>
                                    <h3 class="font-semibold mb-2">Realisasi</h3>
                                    <p class="text-sm text-gray-600">Periode Aktual</p>
                                    <p class="text-sm mb-2">
                                        @if($final)
                                            {{ $final->actual_started->format('d F Y') }} - {{ $final->actual_ended->format('d F Y') }}
                                        @else
                                            <span class="text-gray-500 italic text-xs">Belum Diisi</span>
                                        @endif
                                    </p>

                                    <p class="text-sm text-gray-600">Narasi</p>
                                    <p class="text-sm mb-2">
                                        @if( optional($final)->final_desc)
                                            {{ $final->final_desc }}
                                        @else
                                            <span class="text-gray-500 italic text-xs">Belum Diisi</span>
                                        @endif
                                    </p>

                                    {{-- <p class="text-sm text-gray-600">Kendala</p>
                                    <p class="text-sm mb-2">
                                        @if( optional($struggle)->struggle_desc)
                                            {{ $struggle->struggle_desc }}
                                        @else
                                            <span class="text-gray-500 italic text-xs">Belum Diisi</span>
                                        @endif
                                    </p>

                                    <p class="text-sm text-gray-600">Solusi</p>
                                    <p class="text-sm mb-2">
                                         @if( optional($struggle)->solution_desc)
                                            {{ $struggle->solution_desc }}
                                        @else
                                            <span class="text-gray-500 italic text-xs">Belum Diisi</span>
                                        @endif
                                    </p>

                                    <p class="text-sm text-gray-600">Tindak Lanjut</p>
                                    <p class="text-sm mb-2">
                                        @if( optional($final)->next_step)
                                            {{ $final->next_step }}
                                        @else
                                            <span class="text-gray-500 italic text-xs">Belum Diisi</span>
                                        @endif
                                    </p> --}}

                                    <p class="text-sm text-gray-600">Kendala & Solusi</p>
                                    @forelse(optional($final)->struggles ?? [] as $s)
                                        <div class="border p-2 rounded mb-2">
                                            <p class="text-sm">Kendala: {{ $s->struggle_desc }}</p>
                                            <p class="text-sm">Solusi: {{ $s->solution_desc }}</p>
                                            @if($s->solution_doc)
                                                <a href="{{ asset('storage/'.$s->solution_doc) }}" target="_blank" class="text-blue-500 underline">
                                                    Lihat Bukti Solusi
                                                </a>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-sm mb-2">
                                            <span class="text-gray-500 italic text-xs">Belum diisi</span>
                                        </p>
                                    @endforelse

                                    <p class="text-sm text-gray-600">Bukti Pendukung Solusi</p>
                                    <div class="flex flex-col gap-1">
                                        @if (optional($final)->final_doc)
                                            <a href="{{ Storage::url($final->final_doc) }}" target="_blank" class="text-blue-600 hover:underline text-sm">
                                                📄 Dokumen Realisasi
                                            </a>
                                        @else
                                            <p class="text-xs italic text-gray-500">Tidak ada dokumen</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Edit -->
                            <div class="flex justify-end mt-4 gap-2">
                                @if(auth()->check()) 
                                    @if(auth()->user()->role === 'ketua_tim')
                                        <div x-data="{ showConfirm: false }">
                                            <button type="button"
                                                @click="showConfirm = true"
                                                class="text-xs sm:text-sm flex gap-1 px-4 py-2  rounded-lg bg-gray-200 text-red-500 hover:bg-red-600 hover:text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                    <path fill-rule="evenodd" d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z" clip-rule="evenodd" />
                                                </svg>
                                                Hapus
                                            </button>

                                            <!-- Modal -->
                                            <div
                                                x-show="showConfirm"
                                                x-transition 
                                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                                <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
                                                    <h2 class="text-lg font-semibold text-gray-800">Hapus Tahapan</h2>
                                                    <p class="text-xs text-gray-500">Apakah Anda yakin ingin menghapus tahapan "{{ $plan->plan_type }}" ini ? </p>
                                                    <!-- Tombol Simpan -->
                                                    <div class="flex justify-end mt-4 gap-2">
                                                        <button  @click="showConfirm = false" 
                                                            class="text-xs bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg">
                                                            Batal
                                                        </button>
                                                        <form action="{{ route('plans.destroy', $plan->step_plan_id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="bg-red-600 text-white text-xs px-4 py-2 rounded-lg hover:bg-red-800">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    @endif
                                    @if(auth()->user()->role === 'ketua_tim' || 'operator')
                                        <button @click="editMode = true"
                                            class="text-xs sm:text-sm flex gap-1 px-4 py-2  rounded-lg bg-gray-200 text-gray-700 hover:bg-emerald-600 hover:text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                <path fill-rule="evenodd" d="M11.013 2.513a1.75 1.75 0 0 1 2.475 2.474L6.226 12.25a2.751 2.751 0 0 1-.892.596l-2.047.848a.75.75 0 0 1-.98-.98l.848-2.047a2.75 2.75 0 0 1 .596-.892l7.262-7.261Z" clip-rule="evenodd" />
                                            </svg>
                                            Edit
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <!-- Konten Card (hanya tampil kalau editMode = true) -->
                        <div x-show="editMode">
                            <!-- button -->
                            <div class="flex space-x-2 mb-4">
                                <button type="button" 
                                        class=" text-xs px-4 py-2 rounded"
                                        :class="tab === 'rencana' ? 'bg-blue-800 text-white' : 'bg-gray-200 text-gray-500 hover:bg-white hover:text-blue-900'"
                                        @click="tab = 'rencana'">
                                    Edit Rencana
                                </button>
                                <button type="button"
                                        class=" text-xs px-4 py-2 rounded"
                                        :class="tab === 'realisasi' ? 'bg-blue-800 text-white' : 'bg-gray-200 text-gray-500 hover:bg-white hover:text-blue-900'"
                                        @click="tab = 'realisasi'">
                                    Edit Realisasi
                                </button>
                            </div>  

                            <!-- Konten Tab -->
                            <div>
                                <form x-show="tab === 'rencana'" class="rencana-form" method="POST" action="{{ route('plans.update', $plan->step_plan_id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    @include('detail.form-rencana', ['plan' => $plan])
                                    <!-- Buttons -->
                                    <div class="flex justify-end space-x-2 mt-4">
                                        <button type="button" @click="editMode = false"
                                            class="text-xs sm:text-sm bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded">
                                            Batal
                                        </button>
                                        <button type="submit"
                                            :disabled="formIsInvalid"
                                            :class="formIsInvalid ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-800 hover:bg-blue-700'"
                                            class="text-xs sm:text-sm bg-blue-800 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                            Simpan
                                        </button>
                                    </div>
                                </form>

                                <form x-show="tab === 'realisasi'" class="realisasi-form" method="POST" action="{{ route('finals.update', $plan->step_plan_id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    @php
                                        $final = $plan->stepsFinals ?? new \App\Models\StepsFinal();
                                        $struggle = $final->struggles->first() ?? new \App\Models\Struggle();
                                    @endphp
                                    @include('detail.form-realisasi', ['final' => $final, 'struggle' => $struggle])
                                    <!-- Buttons -->
                                    <div class="flex justify-end space-x-2 mt-4">
                                        <button type="button" @click="editMode = false"
                                            class="text-xs sm:text-sm bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded">
                                            Batal
                                        </button>
                                        <button type="submit"
                                            :disabled="formIsInvalid"
                                            :class="formIsInvalid ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-800 hover:bg-blue-700'"
                                            class="text-xs sm:text-sm bg-blue-800 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                            Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>

                            
                        </div>
                    </div>  
                @endforeach     
            </div>
        </div>
    </main>

</body>
</html>

