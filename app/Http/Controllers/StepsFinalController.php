<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StepsPlan;
use App\Models\StepsFinal;
use App\Models\Struggle;

class StepsFinalController extends Controller
{
    public function index(Request $request){
        $stepsfinal = StepsFinal::all(); //ambil semua data lewat model
        return view('tampilan.detail', compact('stepsfinal'));
    }

    public function update(Request $request, StepsPlan $plan)
    {
        // dd($request)->all();
        
        // Validasi input untuk StepsFinal
        $validatedFinal = $request->validate([
            'actual_started' => 'required|date',
            'actual_ended'   => 'required|date|after_or_equal:actual_started',
            'final_desc'     => 'required|string',
            'next_step'      => 'required|string',
            'final_doc'      => 'nullable|file|mimes:pdf,jpg,png,jpeg,docx|max:2048',
        ]);

        // dd($validatedFinal);

        // Validasi input untuk Struggle
        $validatedStruggle = $request->validate([
            'struggle_desc'  => 'nullable|string',
            'solution_desc'  => 'nullable|string',
        ]);

        // dd($validatedStruggle);

        // Cek dan simpan file dokumen realisasi
        if ($request->hasFile('final_doc')) {
            $path = $request->file('final_doc')->store('documents', 'public');
            $validatedFinal['final_doc'] = $path;
        }

        // Cari atau buat record StepsFinal berdasarkan step_plan_id
        $final = StepsFinal::firstOrNew(['step_plan_id' => $plan->step_plan_id]);
        $final->fill($validatedFinal);
        $final->save();

        // Cari atau buat record Struggle berdasarkan step_final_id
        if ($validatedStruggle['struggle_desc'] || $validatedStruggle['solution_desc']) {
            $struggle = $final->struggles()->firstOrNew();
            $struggle->fill($validatedStruggle);
            $struggle->save();
        }

        return redirect()->back()->with('success', 'Formulir realisasi berhasil diperbarui.');
    }
}