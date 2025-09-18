<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicationController extends Controller
{
    // Menampilkan semua publikasi dengan relasi user
    public function index()
    {
        // $publications = Publication::with('stepsPlans')->get();
        $publications = Publication::with('user')->get();
        
        return view('publications.index', compact('publications'));
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

    // Menyimpan publikasi baru
    public function store(Request $request)
    {
        $request->validate([
            'publication_name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,user_id'
        ]);

        Publication::create($request->all());

        return redirect()->route('publications.index')
                        ->with('success', 'Publikasi berhasil dibuat!');
    }

    // Menampilkan form edit publikasi
    public function edit($id)
    {
        $publication = Publication::findOrFail($id);
        $users = User::all();
        
        return view('publications.edit', compact('publication', 'users'));
    }

    // Update publikasi
    public function update(Request $request, $id)
    {
        $request->validate([
            'publication_name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,user_id'
        ]);

        $publication = Publication::findOrFail($id);
        $publication->update($request->all());

        return redirect()->route('publications.index')
                        ->with('success', 'Publikasi berhasil diupdate!');
    }

    // Hapus publikasi
    public function destroy($id)
    {
        $publication = Publication::findOrFail($id);
        $publication->delete();

        return redirect()->route('publications.index')
                        ->with('success', 'Publikasi berhasil dihapus!');
    }
}