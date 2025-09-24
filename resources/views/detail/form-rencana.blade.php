<!-- Form Button Edit Rencana -->
<div>
    <!-- Tanggal -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Tanggal Mulai Rencana</label>
            <input type="date" name="plan_start_date" x-model="plan_start_date" @input="validateDates('rencana')" required
                class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Tanggal Selesai Rencana</label>
            <input type="date" name="plan_end_date" x-model="plan_end_date" @input="validateDates('rencana')" value="{{ old('plan_end_date', $plan->plan_end_date ? $plan->plan_end_date->format('Y-m-d') : '') }}" required
                class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
        </div>
        <!-- Message Error -->
        <p x-show="datesAreInvalid" class="text-sm text-red-500 mt-1">
            Tanggal tidak sesuai
        </p>
    </div>
    <!-- Narasi rencana -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Narasi Rencana</label>
        <textarea name="plan_desc" rows="3" 
            x-model="plan_desc" @input="updateFormValidity()"
            class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500"
            placeholder="Deskripsi rencana untuk tahapan ini">
        </textarea>
    </div>
    <!-- Dokumen Pendukung -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Dokumen Pendukung Rencana</label>
        <input type="file" name="plan_doc" 
            {{-- @change="
                if ($event.target.files.length > 0) {
                    fileSizeError = $event.target.files[0].size > 2097152;
                    docTypeError = !allowedTypes.includes($event.target.files[0].type);
                } else {
                    fileSizeError = false;
                    docTypeError = false;
                }
                updateFormValidity();
            " --}}
            @change="handleFileChange($event, 'hasPlanDoc')"
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
        @if ($plan->plan_doc)
            <div class="mt-2">
                <p class="text-sm text-gray-500">Dokumen lama:</p>
                <a href="{{ asset('storage/' . $plan->plan_doc) }}" target="_blank" class="text-blue-600 hover:underline text-sm">
                    {{ $plan->plan_doc }}
                </a>
            </div>
        @endif
    </div>
</div>