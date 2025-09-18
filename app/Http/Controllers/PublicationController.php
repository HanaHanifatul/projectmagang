<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    // 📌 Tampilkan semua publikasi
    public function index()
    {
        $publications = Publication::all();
        return view('publications.index', compact('publications'));
    }

    // 📌 Form tambah publikasi
    public function create()
    {
        return view('publications.create');
    }

    // 📌 Simpan publikasi baru
    public function store(Request $request)
    {
        $request->validate([
            'publication_name'   => 'required|string|max:255',
            'publication_pic'    => 'nullable|string|max:255',
            'publication_report' => 'nullable|file|mimes:pdf,png,jpg,jpeg',
        ]);

        $data = $request->all();

        if ($request->hasFile('publication_report')) {
            $data['publication_report'] = $request->file('publication_report')->store('publications', 'public');
        }

        Publication::create($data);

        return redirect()->route('publications.index')->with('success', 'Publikasi berhasil ditambahkan');
    }

    // 📌 Detail publikasi
    public function show($id)
    {
        $publication = Publication::findOrFail($id);
        return view('publications.show', compact('publication'));
    }

    // 📌 Form edit publikasi
    public function edit($id)
    {
        $publication = Publication::findOrFail($id);
        return view('publications.edit', compact('publication'));
    }

    // 📌 Update publikasi
    public function update(Request $request, $id)
    {
        $publication = Publication::findOrFail($id);

        $request->validate([
            'publication_name'   => 'required|string|max:255',
            'publication_pic'    => 'nullable|string|max:255',
            'publication_report' => 'nullable|file|mimes:pdf,png,jpg,jpeg',
        ]);

        $data = $request->all();

        if ($request->hasFile('publication_report')) {
            if ($publication->publication_report) {
                Storage::disk('public')->delete($publication->publication_report);
            }
            $data['publication_report'] = $request->file('publication_report')->store('publications', 'public');
        }

        $publication->update($data);

        return redirect()->route('publications.index')->with('success', 'Publikasi berhasil diperbarui');
    }

    // 📌 Hapus publikasi
    public function destroy($id)
    {
        $publication = Publication::findOrFail($id);

        if ($publication->publication_report) {
            Storage::disk('public')->delete($publication->publication_report);
        }

        $publication->delete();

        return redirect()->route('publications.index')->with('success', 'Publikasi berhasil dihapus');
    }
}
