<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <!-- Tailwind Elements -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="/js/admin.js" defer></script>

</head>
<body>
    <div>
        {{-- Navbar --}}
        <x-navbar ></x-navbar>
        {{-- Header --}}
        <x-header></x-header>
    </div>

    <main>
        <div class="max-w-7xl mx-auto px-4 space-y-6">
            <div class="max-w-6xl mx-auto mt-6 p-6 bg-white bordershadow border rounded-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-3">
        <div>
            <h2 class="text-lg font-semibold text-blue-900">Daftar Pengguna/Pegawai</h2>
            <!-- <p class="text-sm text-gray-500">Tabel ringkasan per publikasi/laporan per triwulan</p> -->
        </div>

        <div class="flex flex-wrap gap-2 justify-start sm:justify-end" x-data="{ open: false }">

            <!-- Tombol Tambah Publikasi -->
            @if(auth()->check() && auth()->user()->role === 'admin')
                <button 
                    @click="open = true" 
                    class="flex items-center justify-center gap-1 bg-emerald-600 text-white px-3 py-2 rounded-lg text-xs sm:text-sm shadow hover:bg-emerald-800 whitespace-nowrap min-w-[110px]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                        <path d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
                        </svg>
                    Pengguna Baru
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
                    
                    <h2 class="text-lg font-semibold">Formulir Tambah Pengguna Baru</h2>
                    <!-- Form -->
                    <form method="POST" action="{{ route('admin.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="name" class="w-full border rounded px-3 py-2 mt-1">
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="text" name="email" class="w-full border rounded px-3 py-2 mt-1">
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Role</label>
                            <select name="role" class="w-full border rounded px-3 py-2 mt-1">
                                <option value="ketua_tim">Ketua Tim</option>
                                <option value="operator">Operator</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" class="w-full border rounded px-3 py-2 mt-1">
                        </div>
                        <div class="flex justify-end gap-2">
                            <button type="button" 
                                    data-modal-hide="modalAddUser"
                                    class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400"
                                    @click="open = false">
                                Batal
                            </button>
                            <button type="submit" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
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
            id="search_user"
            placeholder="Cari Pengguna..."
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
                        <th class="px-3 py-2 border">Nama Pengguna/Pegawai</th>
                        <th class="px-3 py-2 border">Email</th>
                        <th class="px-3 py-2 border">Role</th>
                        <th class="px-3 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody id="user-table-body">
                    <!-- Isi Tabel -->
                    @if($users->count())
                    @foreach($users as $index => $user)
                    <tr>
                        <!-- No -->
                        <td class="px-4 py-4 align-top">{{ $index + 1 }}</td>
                        <!-- Nama Pengguna -->
                        <td class="px-4 py-4 align-top font-semibold text-gray-700">{{ $user->name }}</td>
                        <!-- Email Pengguna -->
                        <td class="px-4 py-4 align-top font-semibold text-gray-700">{{ $user->email }}</td>
                        <!-- Role -->
                        <td class="px-4 py-4 align-top font-semibold text-gray-700">{{ $user->role }}</td>
                        <!-- Aksi -->
                        <td class="px-4 py-4 text-center relative" x-data="{ open: false}">
                            @if(auth()->check() && auth()->user()->role === 'admin')
                                <form method="POST" action="{{ route('admin.destroy', $user->id) }}" onsubmit="return confirm('Yakin hapus data pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex gap-1 sm:text-xs w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-600 hover:text-white">
                                        {{-- icon --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                            <path fill-rule="evenodd" d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z" clip-rule="evenodd" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                        </td>
                    </tr>
                            @else
                    <tr>
                        <td colspan="14" class="text-center text-gray-500 py-4">Tidak ada data ditemukan</td>
                    </tr>
                    @endif
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- skrip untuk modal tambah pengguna -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const select = document.getElementById("user_add");
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

<!-- skrip ajak fitur search -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search_user");
    const tbody = document.querySelector("table tbody");

    searchInput.addEventListener("keyup", function () {
        const query = this.value;

        fetch(`{{ route('admin.search') }}?query=${query}`)
           .then(response => response.json())
.then(data => {
    tbody.innerHTML = "";

    if (data.length > 0) {
        data.forEach((item, index) => {
            tbody.innerHTML += `
                <tr>
                    <td class="px-4 py-4">${index + 1}</td>
                    <td class="px-4 py-4">${item.name}</td>
                    <td class="px-4 py-4">${item.email}</td>
                    <td class="px-4 py-4">${item.role}</td>
                    <td class="px-4 py-4 text-center">
                    <form method="POST" action="{{ route('admin.destroy', $user->id) }}" onsubmit="return confirm('Yakin hapus data pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex gap-1 sm:text-xs w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-600 hover:text-white">
                                        {{-- icon --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                            <path fill-rule="evenodd" d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z" clip-rule="evenodd" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                </td>
                </tr>
            `;
        });
    } else {
        tbody.innerHTML = `
            <tr>
                <td colspan="14" class="text-center text-gray-500 py-4">
                    Tidak ada data ditemukan
                </td>
            </tr>
        `;
    }
})

            .catch(err => console.error(err));
    });
});
</script>



        </div>
    </main>
</body>
</html>
