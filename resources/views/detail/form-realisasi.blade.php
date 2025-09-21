<!-- Form Button Edit Rencana -->
<!-- Tanggal -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Tanggal Mulai Realisasi</label>
        <input type="date" name="actual_started" value="{{ old('actual_started', optional($final->actual_started)->format('Y-m-d')  ?? '') }}" required
            class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Tanggal Akhir Realisasi</label>
        <input type="date" name="actual_ended"  value="{{ old('actual_ended', optional($final->actual_ended)->format('Y-m-d')  ?? '') }}" required
            class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
    </div>
</div>
<!-- Narasi Realisasi -->
<div>
    <label class="block text-sm font-medium text-gray-700">Narasi Realisasi</label>
    <textarea name="final_desc" rows="3" required
        class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500"
        placeholder="Deskripsi rencana untuk tahapan ini">{{  old('final_desc', optional($final)->final_desc ?? '') }}
    </textarea>
</div>

<!-- Kendala (dinamis) -->
    <div id="struggles-wrapper" class="space-y-4">
        <div class="struggle-item border p-3 rounded-lg">
            <label>Kendala</label>
            <textarea name="struggles[0][struggle_desc]" rows="3" required
                class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500"
                placeholder="Kendala yang terjadi selama realisasi">{{ old('struggle_desc', optional($struggle)->struggle_desc ?? '')  }}
            </textarea>

            <label>Solusi</label>
            <textarea name="struggles[0][solution_desc]" rows="3" required
                class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500"
                placeholder="Solusi untuk mengatasi kendala">{{ old('solution_desc', optional($struggle)->solution_desc ?? '')  }}
            </textarea>
            <label>Bukti Solusi</label>
            <input type="file" name="struggles[0][solution_doc]" accept=".png,.jpg,.jpeg,.pdf"
                class="w-full border rounded px-3 py-2">
        </div>
    </div>

    <button type="button" id="add-struggle" class="mt-2 mb-3 bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700">+ Tambah Kendala</button>
    <!-- Tindak Lanjut Realisasi -->
<div>
    <label class="block text-sm font-medium text-gray-700">Tindak Lanjut Realisasi</label>
    <textarea name="next_step" rows="3" required
        class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">{{  old('next_step', optional($final)->next_step ?? '') }}
    </textarea>
</div>
<!-- Dokumen Pendukung -->
{{-- value="{{ old('final_doc', $final->final_doc) }}" --}}
<div>
    <label class="block text-sm font-medium text-gray-700">Bukti Pendukung</label>
    <input type="file" name="final_doc" 
        @change="
            if ($event.target.files.length > 0) {
                fileSizeError = $event.target.files[0].size > 2097152;
                docTypeError = !allowedTypes.includes($event.target.files[0].type);
            } else {
                fileSizeError = false;
                docTypeError = false;
            }
        "    
        class="w-full border rounded px-3 py-2 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:bg-gray-600 file:text-white">

    <!-- Message Error -->
    <p x-show="fileSizeError" class="text-sm text-red-500 mt-1">
        Ukuran file tidak boleh lebih dari 2MB.
    </p>

    <!-- Message Error -->
    <p x-show="docTypeError" class="text-sm text-red-500 mt-1">
        Tipe file tidak diizinkan. Mohon unggah file PNG, JPG, PDF, atau DOCX.
    </p>

    {{-- Tampilkan nama dokumen lama jika ada --}}
    @if (optional($final)->final_doc)
        <div class="mt-2">
            <p class="text-sm text-gray-500">Dokumen lama:</p>
            <a href="{{ asset('storage/' . $final->final_doc) }}" target="_blank" class="text-blue-600 hover:underline text-sm">
                {{ optional($final)->final_doc ?? '' }}
            </a>
        </div>
    @endif
</div>

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