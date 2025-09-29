<!-- Form Button Edit Rencana -->
<!-- Tanggal -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Tanggal Mulai Realisasi</label>
        <input type="date" name="actual_started" x-model="actual_started" @input="validateDates('realisasi')"
            class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Tanggal Akhir Realisasi</label>
        <input type="date" name="actual_ended"  x-model="actual_ended" @input="validateDates('realisasi')"
            class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
    </div>
    <!-- Message Error -->
    <p x-show="datesAreInvalid" class="text-sm text-red-500 mt-1">
        Tanggal tidak sesuai
    </p>
</div>

<!-- Narasi Realisasi -->
<div>
    <label class="block text-sm font-medium text-gray-700">Narasi Realisasi</label>
    <textarea name="final_desc" rows="3" x-model="final_desc" @input="updateFormValidity()"
        class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500"
        placeholder="Deskripsi rencana untuk tahapan ini">
    </textarea>
</div>

<!-- Kendala (dinamis) -->
    <div class="struggles-wrapper space-y-4" {{-- id="struggles-wrapper-{{ $plan->step_plan_id }}" --}}>
        @forelse($final->struggles as $i => $s)
            <div class="struggle-item border p-3 rounded-lg">
                <input type="hidden" name="struggles[{{ $i }}][struggle_id]" value="{{ $s->id }}">
                <div class="flex items-center justify-between">
                    <!-- Tulisan di kiri -->
                    <span class="block text-lg font-medium text-gray-700">Kendala dan Solusi {{ $i+1 }}</span>

                </div>
                <label class="block text-sm font-medium text-gray-700">Kendala</label>
                <textarea name="struggles[{{ $i }}][struggle_desc]" rows="3" required
                    class="w-full border rounded px-3 py-2">{{ old("struggles.$i.struggle_desc", $s->struggle_desc) }}
                </textarea>

                <label class="block text-sm font-medium text-gray-700">Solusi</label>
                <textarea name="struggles[{{ $i }}][solution_desc]" rows="3" required
                    class="w-full border rounded px-3 py-2">{{ old("struggles.$i.solution_desc", $s->solution_desc) }}
                </textarea>

                <label class="block text-sm font-medium text-gray-700">Bukti Solusi</label>
                <input type="file" name="struggles[{{ $i }}][solution_doc]" accept=".png,.jpg,.jpeg,.pdf"
                    class="w-full border rounded px-3 py-2 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:bg-gray-600 file:text-white">
                    @if($s->solution_doc)
                        <input type="hidden" name="struggles[{{ $i }}][existing_solution_doc]" value="{{ $s->solution_doc }}">
                        <p class="text-sm mt-1">Dokumen lama: 
                            <a href="{{ asset('storage/'.$s->solution_doc) }}" target="_blank" class="text-blue-600 underline">
                                {{ $s->solution_doc }}
                            </a>
                        </p>
                    @endif
            </div>
        @empty
            <div class="struggle-item border p-3 rounded-lg">
                <input type="hidden" name="struggles[0][struggle_id]" value="">
                <!-- Tulisan di kiri -->
                <div class="flex items-center justify-between">
                    <span class="block text-lg font-medium text-gray-700">Kendala dan Solusi 1</span>
                </div>
                <label class="block text-sm font-medium text-gray-700">Kendala</label>
                <textarea name="struggles[0][struggle_desc]" rows="3" required
                    class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500"
                    placeholder="Kendala yang terjadi selama realisasi">{{ old('struggles.0.struggle_desc', optional($struggle)->struggle_desc ?? '')  }}
                </textarea>

                <label class="block text-sm font-medium text-gray-700">Solusi</label>
                <textarea name="struggles[0][solution_desc]" rows="3" required
                    class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500"
                    placeholder="Solusi untuk mengatasi kendala">{{ old('struggles.0.solution_desc', optional($struggle)->solution_desc ?? '')  }}
                </textarea>

                <label class="block text-sm font-medium text-gray-700">Bukti Solusi</label>
                <input type="file" name="struggles[0][solution_doc]" accept=".png,.jpg,.jpeg,.pdf"
                    class="w-full border rounded px-3 py-2 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:bg-gray-600 file:text-white">
            </div>
        @endforelse
    </div>

    <button type="button" class="add-struggle-button mt-2 mb-3 bg-blue-800 text-white px-3 py-1 rounded hover:bg-blue-900" {{-- data-target-id="{{ $plan->step_plan_id }}" --}} >+ Tambah Kendala</button>
    
<!-- Tindak Lanjut Realisasi -->
<div>
    <label class="block text-sm font-medium text-gray-700">Tindak Lanjut Realisasi</label>
    <textarea name="next_step" rows="3" x-model="next_step" @input="updateFormValidity()"
        class="w-full border rounded px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500"
        placeholder="Tindak lanjut realisasi...">
    </textarea>
</div>

<!-- Dokumen Pendukung -->
<div>
    <label class="block text-sm font-medium text-gray-700">Bukti Pendukung</label>
    <input type="file" name="final_doc" 
        {{-- @change="
            if ($event.target.files.length > 0) {
                fileSizeError = $event.target.files[0].size > 2097152;
                docTypeError = !allowedTypes.includes($event.target.files[0].type);
            } else {
                fileSizeError = false;
                docTypeError = false;
            }
            updateFormValidity();
        "     --}}
         @change="handleFileChange($event, 'hasFinalDoc')"
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

