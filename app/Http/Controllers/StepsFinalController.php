<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StepsPlan;
use App\Models\StepsFinal;
use App\Models\Struggle;
use Closure;

class StepsFinalController extends Controller
{
    public function index(Request $request){
        $stepsfinal = StepsFinal::all(); //ambil semua data lewat model
        return view('tampilan.detail', compact('stepsfinal'));
    }

    public function update(Request $request, StepsPlan $plan)
    {
        // dd($request->all());
        // dd($request->input('struggles')); 

        $final = StepsFinal::firstOrNew(['step_plan_id' => $plan->step_plan_id]);
        $existingFinalDoc = $final->final_doc;

        // Validasi final_doc (required hanya jika belum ada)
        $finalDocValidation = $existingFinalDoc ? 'nullable|file|mimes:pdf,jpg,png,jpeg,docx|max:2048' : 'required|file|mimes:pdf,jpg,png,jpeg,docx|max:2048';
        
        // Validasi input untuk StepsFinal
        $validatedFinal = $request->validate([
            'actual_started' => 'required|date',
            'actual_ended'   => 'required|date|after_or_equal:actual_started',
            'final_desc'     => 'required|string',
            'next_step'      => 'required|string',
            'final_doc'      => $finalDocValidation,
        ]);

        // Rule ini akan digunakan untuk struggle_desc dan solution_desc
        $minThreeWordsRule = function (string $attribute, mixed $value, Closure $fail) {
            // Hilangkan tag HTML dan spasi di awal/akhir
            $cleanValue = strip_tags((string)$value);
            
            // Hitung kata.
            $wordCount = str_word_count($cleanValue);
            if ($wordCount < 3) {
                $fieldName = str_contains($attribute, 'struggle_desc') ? 'Kendala' : 'Solusi';
                if (preg_match('/struggles\.(\d+)\./', $attribute, $matches)) {
                    $index = $matches[1] + 1;
                    $fail("Bidang {$fieldName} pada item Kendala ke-{$index} harus berisi minimal 3 kata.");
                } else {
                    $fail("Bidang {$fieldName} harus berisi minimal 3 kata.");
                }
                // Hentikan validasi lebih lanjut jika kata kurang dari 3 (agar pesan error tidak tumpang tindih)
                return;
            }

            // 2. Cek Karakter Khusus (Match logic: memperbolehkan huruf, angka, spasi, dan tanda baca umum)
            if (!preg_match('/^[\p{L}\d\s.,?!()\/"]*$/u', $cleanValue)) {
                $fieldName = str_contains($attribute, 'struggle_desc') ? 'Kendala' : 'Solusi';
                if (preg_match('/struggles\.(\d+)\./', $attribute, $matches)) {
                    $index = $matches[1] + 1;
                    $fail("Bidang {$fieldName} pada item Kendala ke-{$index} mengandung karakter yang tidak diizinkan (hanya huruf, angka, spasi, dan tanda baca umum).");
                } else {
                    $fail("Bidang {$fieldName} mengandung karakter yang tidak diizinkan (hanya huruf, angka, spasi, dan tanda baca umum).");
                }
            }
        };

        // dd($validatedFinal);

        // Validasi input untuk Struggle
        $request->validate([
            'struggles.*.struggle_desc'  => ['required', 'string', $minThreeWordsRule],
            'struggles.*.solution_desc'  => ['required', 'string', $minThreeWordsRule],
            'struggles.*.solution_doc'   => 'nullable|file|mimes:pdf,jpg,png,jpeg,docx|max:2048',
        ]);

        // Cek dan simpan file dokumen realisasi
        if ($request->hasFile('final_doc')) {
            if ($existingFinalDoc) {
                \Storage::disk('public')->delete($existingFinalDoc);
            }
            $path = $request->file('final_doc')->store('documents', 'public');
            $validatedFinal['final_doc'] = $path;
        } else {
            $validatedFinal['final_doc'] = $existingFinalDoc;
        }

        $final->fill($validatedFinal);
        $final->save();

        // simpan struggles
        if ($request->has('struggles')) {
                // Mendapatkan ID struggles yang dikirim dari form
                $submittedStruggleIds = collect($request->input('struggles'))->pluck('struggle_id')->filter()->all();

                // Hapus struggles lama yang tidak dikirim di form
                $final->struggles()->whereNotIn('id', $submittedStruggleIds)->delete();
            foreach ($request->struggles as $i => $struggleData) {
                // Hapus struggles lama sebelum menyimpan yang baru
                // $final->struggles()->delete();

                // Coba cari struggle lama berdasarkan ID, atau buat instance baru jika tidak ada ID
                $struggle = $final->struggles()->find($struggleData['struggle_id'] ?? null) ?? new Struggle();
            
                // $struggle = new Struggle();
                $struggle->struggle_desc = $struggleData['struggle_desc'];
                $struggle->solution_desc = $struggleData['solution_desc'];

                // Kalau ada file upload sesuai indeks struggle
                if ($request->hasFile("struggles.$i.solution_doc")) {
                   // Hapus dokumen lama jika ada
                    if ($struggle->solution_doc) {
                        \Storage::disk('public')->delete($struggle->solution_doc);
                    }
                    $path = $request->file("struggles.$i.solution_doc")->store('documents', 'public');
                    $struggle->solution_doc = $path;
                }   else {
                    // Jika tidak ada file baru, periksa apakah ada path dokumen lama yang dikirim
                    if (isset($struggleData['existing_solution_doc'])) {
                        $struggle->solution_doc = $struggleData['existing_solution_doc'];
                    } else {
                        // Jika tidak ada file baru dan tidak ada file lama, atur menjadi null
                        $struggle->solution_doc = null;
                    }
                }

                $final->struggles()->save($struggle);
            }
        }

        return redirect()->back()->with('success', 'Formulir realisasi berhasil diperbarui.');
    }
}