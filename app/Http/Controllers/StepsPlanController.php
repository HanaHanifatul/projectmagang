<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StepsPlan;

class StepsPlanController extends Controller
{
    //tampil data tahapan
    public function index(){
        $stepsplans = StepsPlan::all(); //ambil semua data lewat model
        return view('tampilan.detail', compact('stepsplans'));
    }
    //simpan data untuk formulir "Tambah Tahapan"
    public function store(Request $request){
        // validasi input
        $request->validate([
            'plan_type' => 'required|string',
            'plan_name' => 'required|string|max:256'
        ]);

        // Simpan ke database
        StepsPlan::create([
            'plan_type' => $request->plan_type,
            'plan_name' => $request->plan_name,
            'publication_id' => 1,      // isi sesuai id publikasi terkait
        ]);

        return redirect()->back()->with('success', 'Tahapan berhasil ditambahkan.');
    }

    // Perbarui data untuk formulir "Edit Rencana"
    public function update(Request $request, StepsPlan $plan){
        $validated = $request->validate([
            'plan_start_date' => 'required|date',
            'plan_end_date'   => 'required|date|after_or_equal:plan_start_date',
            'plan_desc'       => 'required|string',
            'plan_doc'        => 'nullable|file|mimes:pdf,jpg,png,jpeg,docx|max:2048',
        ]);

        // Upload dokumen jika ada
        if ($request->hasFile('plan_doc')) {
            $path = $request->file('plan_doc')->store('documents', 'public');
            $validated['plan_doc'] = $path;
        }

        // dd($validated);

        // Perbarui data
        $plan->update($validated);

        return redirect()->back()->with('success', 'Rencana berhasil diperbarui.');
    }
}