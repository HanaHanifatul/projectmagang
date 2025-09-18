<!-- Form Button Edit Rencana -->

<!-- Form Input Rencana -->
<form action="{{ route('plans.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">

<!-- Tanggal -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Tanggal Mulai Rencana</label>
        <input type="date" name="plan_start_date"
            class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Tanggal Selesai Rencana</label>
        <input type="date" name="plan_end_date"
            class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
    </div>
</div>

 <!-- Nama Rencana -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Nama Rencana</label>
        <input type="text" name="plan_name"
            class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
    </div>

<!-- Narasi rencana -->
<div>
    <label class="block text-sm font-medium text-gray-700">Narasi Rencana</label>
    <textarea name="plan_desc" rows="3"
        class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500"></textarea>
</div>

<!-- Dokumen Pendukung -->
<div>
    <label class="block text-sm font-medium text-gray-700">Dokumen Pendukung Rencana</label>
    <input type="file" name="plan_doc" accept=".png,.jpg,.jpeg,.pdf"
            class="w-full border rounded px-3 py-2 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:bg-gray-600 file:text-white">
</div>

<!-- Hidden: Publication ID -->
    <input type="hidden" name="publication_id" value="{{ $publication->publication_id ?? 1 }}">
</form>