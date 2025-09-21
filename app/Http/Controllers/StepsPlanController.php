<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StepsPlan;

class StepsPlanController extends Controller
{
    //tampil data tahapan
    public function index(Request $request, $publication_id)
{
    // ambil input search dari query string (?search=...)
    $search = $request->input('search');

    // query dasar: hanya ambil steps dari publikasi tertentu
    $query = StepsPlan::where('publication_id', $publication_id)->with('stepsFinals');

    // filter kalau ada search
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('plan_name', 'LIKE', '%' . $search . '%')
              ->orWhere('plan_type', 'LIKE', '%' . $search . '%');
        });
    }

    // eksekusi query
    $stepsplans = $query->get();

    $total_rencana   = $stepsplans->count();
    $total_realisasi = $stepsplans->whereNotNull('stepsFinals')->count();

    return view('tampilan.detail', compact('stepsplans', 'total_rencana', 'total_realisasi', 'publication_id', 'search'));
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
        // dd($request->hasFile('plan_doc'));
        
        $validated = $request->validate([
            'plan_start_date' => 'required|date',
            'plan_end_date'   => 'required|date|after_or_equal:plan_start_date',
            'plan_desc'       => 'required|string',
            'plan_doc'        => 'nullable|file|mimes:pdf,jpg,png,jpeg,docx|max:2048',
        ]);
        
        // Upload dokumen jika ada
        if ($request->hasFile('plan_doc')) {
            // dd($request->hasFile('plan_doc'));
            $path = $request->file('plan_doc')->store('documents', 'public');
            $validated['plan_doc'] = $path;
            // dd($validated);
        }
        
        // Perbarui data
        $plan->update($validated);

        return redirect()->back()->with('success', 'Rencana berhasil diperbarui.');
    }

    // Untuk menghapus tahapan
    public function destroy(StepsPlan $plan){
        //Hapus data
        $plan->delete();

        //Redirect kembali dengan pesan sukses
        return redirect()->back()->with('succes', 'Tahapan berhasil dihapus.');
    }
}