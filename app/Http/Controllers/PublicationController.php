<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    /**
     * Tampilkan daftar publikasi
     */
    public function index()
    {
        $publications = Publication::with('stepsPlans')->get();
        return redirect()->route('home')->with('success', 'Publikasi berhasil ditambahkan.');

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
        ]);

        Publication::create([
            'publication_name'   => $request->publication_name,
            'publication_report' => $request->publication_report,
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
            'nama_publikasi' => 'required|string',
            'nama'           => 'required|string',
            'pic'            => 'required|string',
        ]);

        $publication = Publication::findOrFail($id);
        $publication->update([
            'publication_report' => $request->nama_publikasi,
            'publication_name'   => $request->nama,
            'publication_pic'    => $request->pic,
        ]);

        return redirect()->route('home')->with('success', 'Publikasi berhasil ditambahkan.');
    }

    /**
     * Hapus publikasi
     */
    public function destroy($id)
    {
        $publication = Publication::findOrFail($id);
        $publication->delete();

        return redirect()->route('home')->with('success', 'Publikasi berhasil ditambahkan.');

    }

public function export()
{
    // contoh: kalau pakai Laravel Excel
    return Excel::download(new PublicationsExport, 'publications.xlsx');
}
}