<!-- Form Button Edit Rencana -->

<form action="{{ route('finals.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">

<!-- Tanggal -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Tanggal Mulai Realisasi</label>
        <input type="date" name="actual_start_realized"
            class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Tanggal Akhir Realisasi</label>
        <input type="date" name="final_end_realized"
            class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
    </div>
</div>
<!-- Narasi Realisasi -->
<div>
    <label class="block text-sm font-medium text-gray-700">Narasi Realisasi</label>
    <textarea name="final_desc" rows="3"
        class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500"></textarea>
</div>
<!-- Kendala (dinamis) -->
    <div id="struggles-wrapper" class="space-y-4">
        <div class="struggle-item border p-3 rounded-lg">
            <label>Kendala</label>
            <textarea name="struggles[0][struggle_desc]" rows="2" class="w-full border rounded px-3 py-2"></textarea>

            <label>Solusi</label>
            <textarea name="struggles[0][solution_desc]" rows="2" class="w-full border rounded px-3 py-2"></textarea>

            <label>Bukti Solusi</label>
            <input type="file" name="struggles[0][solution_doc]" accept=".png,.jpg,.jpeg,.pdf"
                class="w-full border rounded px-3 py-2">
        </div>
    </div>

    <button type="button" id="add-struggle" class="bg-blue-600 text-white px-3 py-1 rounded">+ Tambah Kendala</button>
    <!-- Tindak Lanjut Realisasi -->
<div>
    <label class="block text-sm font-medium text-gray-700">Tindak Lanjut Realisasi</label>
    <textarea name="next_step" rows="3"
        class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500"></textarea>
</div>

<input type="hidden" name="step_plan_id" value="1">

<!-- Dokumen Pendukung -->
<div>
    <label class="block text-sm font-medium text-gray-700">Bukti Pendukung</label>
    <input type="file" name="final_doc" accept=".png,.jpg,.jpeg,.pdf"
        class="w-full border rounded px-3 py-2 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:bg-gray-600 file:text-white">
</div>
</form>

<script>
    let struggleIndex = 1;
    document.getElementById('add-struggle').addEventListener('click', function () {
        const wrapper = document.getElementById('struggles-wrapper');
        const div = document.createElement('div');
        div.classList.add('struggle-item', 'border', 'p-3', 'rounded-lg');
        div.innerHTML = `
            <label>Kendala</label>
            <textarea name="struggles[${struggleIndex}][struggle_desc]" rows="2" class="w-full border rounded px-3 py-2"></textarea>
            <label>Solusi</label>
            <textarea name="struggles[${struggleIndex}][solution_desc]" rows="2" class="w-full border rounded px-3 py-2"></textarea>
            <label>Bukti Solusi</label>
            <input type="file" name="struggles[${struggleIndex}][solution_doc]" accept=".png,.jpg,.jpeg,.pdf" class="w-full border rounded px-3 py-2">
        `;
        wrapper.appendChild(div);
        struggleIndex++;
    });
</script>