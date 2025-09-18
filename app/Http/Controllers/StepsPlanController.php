<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StepsPlan;

class StepsPlanController extends Controller
{
    //tampil tahapan
    public function index(){
        $stepsplans = StepsPlan::all(); //ambil semua data lewat model
        return view('tampilan.detail', compact('stepsplans'));
    }
    //simpan data
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
            'plan_start_date' => $request->plan_start_date, // sementara default
            'plan_end_date' => $request->plan_start_date,   // sementara default
            'plan_desc' => $request->plan_start_date,  // sementara default
            'publication_id' => 1,      // isi sesuai id publikasi terkait
        ]);

        // Simpan ke database
        // $validated = $request->validate([
        //     'plan_start_date' => 'required|date',
        //     'plan_end_date'   => 'required|date|after_or_equal:plan_start_date',
        //     'plan_type'       => 'required|string',
        //     'plan_name'       => 'required|string|max:255',
        //     'plan_desc'       => 'required|string',
        //     'publication_id'  => 'required|exists:publications,publication_id',
        //     'plan_doc'        => 'nullable|file|mimes:pdf,jpg,png,jpeg,docx|max:2048',
        // ]);

        // dd($validated);

        // // Upload dokumen kalau ada
        // if ($request->hasFile('plan_doc')) {
        //     $path = $request->file('plan_doc')->store('documents', 'public');
        //     $validated['plan_doc'] = $path;
        // }

        // StepPlan::create($validated);

        return redirect()->back()->with('success', 'Tahapan berhasil ditambahkan.');
    }
}