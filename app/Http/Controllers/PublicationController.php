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
        return view('publications.index', compact('publications'));
    }

    /**
     * Simpan publikasi baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_publikasi' => 'required|string',
            'nama'           => 'required|string',
            'pic'            => 'required|string',
        ]);

        dd(Auth::id(), $request->all());

        Publication::create([
            'publication_report' => $request->nama_publikasi,
            'publication_name'   => $request->nama,
            'publication_pic'    => $request->pic,
            'fk_user_id'         => Auth::id(),
        ]);

        return redirect()->route('publications.index')->with('success', 'Publikasi berhasil ditambahkan.');
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

        return redirect()->route('publications.index')->with('success', 'Publikasi berhasil diperbarui.');
    }

    /**
     * Hapus publikasi
     */
    public function destroy($id)
    {
        $publication = Publication::findOrFail($id);
        $publication->delete();

        return redirect()->route('publications.index')->with('success', 'Publikasi berhasil dihapus.');
    }

public function export()
{
    // contoh: kalau pakai Laravel Excel
    return Excel::download(new PublicationsExport, 'publications.xlsx');
}
}