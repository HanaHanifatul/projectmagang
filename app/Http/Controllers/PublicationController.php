<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Publication;
use App\Models\StepsPlan;


class PublicationController extends Controller
{
    /**
     * Tampilkan daftar publikasi
     */
    public function index()
    {
        $publications = Publication::with([
            'user',
            'stepsPlans.stepsFinals.struggles'
        ])->get();

    // return view('publications.index', compact('publications'));
    return view('tampilan.homeketua', compact('publications'));
    }

    // Menampilkan detail publikasi dengan semua relasinya
    public function show($id)
    {
        $publication = Publication::with([
            'user',
            'stepsPlans.stepsFinals.struggles'
        ])->findOrFail($id);

        return view('publications.show', compact('publication'));
    }

    // Menampilkan form untuk membuat publikasi baru
    public function create()
    {
        $users = User::all();
        return view('publications.create', compact('users'));
    }

    /**
     * Simpan publikasi baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'publication_name'   => 'required|string|max:255',
            'publication_report' => 'required|string|max:255',
            'publication_pic'    => 'required|string|max:255',
            'publication_report_other' => 'nullable|string|max:255'
        ]);

        // Cek kalau user pilih "other"
        $publicationReport = $request->publication_report === 'other'
            ? $request->publication_report_other
            : $request->publication_report;

        Publication::create([
            'publication_name'   => $request->publication_name,
            'publication_report' => $publicationReport,
            'publication_pic'    => $request->publication_pic,
            'fk_user_id'         => Auth::id(), // ambil user yang login
        ]);

        return redirect()->route('home')->with('success', 'Publikasi berhasil ditambahkan.');

    }

    /**
     * Update publikasi
     */
    public function update(Request $request, $id)
    {
                $request->validate([
            'publication_name'   => 'required|string|max:255',
            'publication_report' => 'required|string|max:255',
            'publication_pic'    => 'required|string|max:255',
        ]);

        $publication = Publication::findOrFail($id);
        $publication->update([
            'publication_name'   => $request->publication_name,
            'publication_report' => $request->publication_report,
            'publication_pic'    => $request->publication_pic,
        ]);

        return redirect()->route('home')->with('success', 'Publikasi berhasil ditambahkan.');
    }

    /**
     * Hapus publikasi
     */
    public function destroy($id)
    {
        $publication = Publication::findOrFail($id);

        // Hapus semua StepsPlan yang terkait
        $publication->stepsPlans()->delete();

        // Hapus publication
        $publication->delete();

        return redirect()->route('publications.index')
                        ->with('success', 'Publikasi dan semua tahapan terkait berhasil dihapus!');
    }




}