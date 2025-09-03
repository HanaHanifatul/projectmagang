<!-- Form Button Edit Rencana -->
<!-- Tanggal -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Tanggal Mulai Realisasi</label>
        <input type="date" name="tanggal_mulai"
            class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Tanggal Akhir Realisasi</label>
        <input type="date" name="tanggal_selesai"
            class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
    </div>
</div>
<!-- Narasi Realisasi -->
<div>
    <label class="block text-sm font-medium text-gray-700">Narasi Realisasi</label>
    <textarea name="narasi" rows="3"
        class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500"></textarea>
</div>
<!-- Kendala Realisasi -->
<div>
    <label class="block text-sm font-medium text-gray-700">Kendala Realisasi</label>
    <textarea name="narasi" rows="3"
        class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500"></textarea>
</div>
<!-- Solusi Realisasi -->
<div>
    <label class="block text-sm font-medium text-gray-700">Solusi Realisasi</label>
    <textarea name="narasi" rows="3"
        class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500"></textarea>
</div>
    <!-- Tindak Lanjut Realisasi -->
<div>
    <label class="block text-sm font-medium text-gray-700">Tindak Lanjut Realisasi</label>
    <textarea name="narasi" rows="3"
        class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500"></textarea>
</div>
<!-- Dokumen Pendukung -->
<div>
    <label class="block text-sm font-medium text-gray-700">Bukti Pendukung</label>
    <input type="file" name="dokumen[]"
        class="w-full border rounded px-3 py-2 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:bg-gray-600 file:text-white">
</div>