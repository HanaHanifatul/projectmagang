<!-- Form Button Edit Rencana -->
<!-- Tanggal -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Tanggal Mulai Rencana</label>
        <input type="date" name="plan_start_date" value="{{ old('plan_start_date', $plan->plan_start_date ? $plan->plan_start_date->format('Y-m-d') : '') }}" required
            class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Tanggal Selesai Rencana</label>
        <input type="date" name="plan_end_date" value="{{ old('plan_end_date', $plan->plan_end_date ? $plan->plan_end_date->format('Y-m-d') : '') }}" required
            class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
    </div>
</div>
<!-- Narasi rencana -->
<div>
    <label class="block text-sm font-medium text-gray-700">Narasi Rencana</label>
    <textarea name="plan_desc" rows="3" required
        class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500"
        placeholder="Masukkan narasi disini">{{  old('plan_desc', $plan->plan_desc)  }}
    </textarea>
</div>
<!-- Dokumen Pendukung -->
<div>
    <label class="block text-sm font-medium text-gray-700">Dokumen Pendukung Rencana</label>
    <input type="file" name="plan_doc" value="{{ old('plan_doc', $plan->plan_doc) }}"
        class="w-full border rounded px-3 py-2 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:bg-gray-600 file:text-white">

        {{-- Tampilkan nama dokumen lama jika ada --}}
    @if ($plan->plan_doc)
        <div class="mt-2">
            <p class="text-sm text-gray-500">Dokumen lama:</p>
            <a href="{{ asset('storage/' . $plan->plan_doc) }}" target="_blank" class="text-blue-600 hover:underline text-sm">
                {{ $plan->plan_doc }}
            </a>
        </div>
    @endif
</div>
