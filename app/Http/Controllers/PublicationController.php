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

        // Variabel untuk Rekapitulasi Publikasi
        $totalPublikasi = $publications->count();
        $sedangBerlangsungPublikasi = 0;
        $sudahSelesaiPublikasi = 0;

        // Variabel untuk Rekapitulasi Tahapan
        $totalTahapan = 0;
        $sedangBerlangsungTahapan = 0;
        $sudahSelesaiTahapan = 0;
        $tertundaTahapan = 0;
        
        // looping dan perhitungan per publikasi
        foreach ($publications as $publication) {
            // inisialisasi jumlah per triwulan
            $rekapPlans = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
            $rekapFinals = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
            $lintasTriwulan = 0;
            $progressKumulatif = 0;

            // Looping di setiap tahapan 
            foreach ($publication->stepsPlans as $plan) {
                $totalTahapan++;
                
                // --- LOGIKA STATUS TAHAPAN ---
                // KONDISI 1: Tahapan Sudah Selesai 
                $q = getQuarter($plan->plan_start_date);
                if ($q) $rekapPlans[$q]++;

                // kalau sudah ada realisasi, hitung juga
                if ($plan->stepsFinals) {
                    $sudahSelesaiTahapan++;

                    // Tentukan triwulan realisasi
                    $fq = getQuarter($plan->stepsFinals->actual_started);
                    if ($fq) $rekapFinals[$fq]++;

                    // Cek Lintas Triwulan
                    if ($fq && $q && $fq != $q) {
                        $lintasTriwulan++;
                        $tertundaTahapan++;
                    }
                }
                // KONDISI 2: Tahapan Tertunda
                else if ($plan->plan_end_date && $plan->plan_end_date < now() && !$plan->stepsFinals) {
                    $tertundaTahapan++;
                }
                // KONDISI 2: Tahapan Sedang Berlangsung
                else {
                    $sedangBerlangsungTahapan++;
                }
            }

            // --- PENGHITUNGAN PROGRESS KUMULATIF PUBLIKASI ---
            $totalPlans = array_sum($rekapPlans);
            $totalFinals = array_sum($rekapFinals);
            // Hitung persentase progress kumulatif (Realisasi / Rencana)
            $progressKumulatif = ($totalPlans > 0) ? ($totalFinals / $totalPlans) * 100 : 0;

            // klasifikasi status publikasi 
            if ($progressKumulatif == 100) {
                $sudahSelesaiPublikasi++;      // progress = 100%
            } elseif ($progressKumulatif < 100) {
                $sedangBerlangsungPublikasi++; // progress < 100%
            }

            // Hitung progress per triwulan
            $progressTriwulan = [];
            foreach ([1, 2, 3, 4] as $q) {
                if ($rekapPlans[$q] > 0) {
                    $progressTriwulan[$q] = ($rekapFinals[$q] / $rekapPlans[$q]) * 100;
                } else {
                    $progressTriwulan[$q] = 0;
                }
            }

            // inject hasil rekap ke model publikasi
            $publication->rekapPlans = $rekapPlans;
            $publication->rekapFinals = $rekapFinals;
            $publication->lintasTriwulan = $lintasTriwulan;
            $publication->progressKumulatif = $progressKumulatif;
            $publication->progressTriwulan = $progressTriwulan;
        }

        // Perhitungan persentase realisasi
        $persentaseRealisasi = ($totalTahapan > 0) 
            ? round(($sudahSelesaiTahapan / $totalTahapan) * 100) 
            : 0;

        // return view('publications.index', compact('publications'));
        return view('tampilan.homeketua', compact(
            'publications',
            // Publikasi
            'totalPublikasi',
            'sedangBerlangsungPublikasi',
            'sudahSelesaiPublikasi',
            // Tahapan
            'sedangBerlangsungTahapan',
            'sudahSelesaiTahapan',
            'tertundaTahapan',
            'persentaseRealisasi'
        ));
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

        return redirect()->route('daftarpublikasi')->with('success', 'Publikasi berhasil ditambahkan.');

    }

    public function update(Request $request, Publication $publication)
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

        $publication = Publication::findOrFail($publication);
        $publication->update([
            'publication_name'   => $request->publication_name,
            'publication_report' => $publicationReport,
            'publication_pic'    => $request->publication_pic,
        ]);

        return redirect()->route('daftarpublikasi')->with('success', 'Publikasi berhasil ditambahkan.');
    }

    public function getRouteKeyName()
    {
        return 'slug_publication'; // bukan id lagi
    }

    public function destroy(Publication $publication)
    {
        // $publication = Publication::where('slug_publication', $slug_publication)->firstOrFail();

        // Hapus semua StepsPlan yang terkait
        $publication->stepsPlans()->delete();

        // Hapus publication
        $publication->delete();

        return redirect()->route('publications.index')
                        ->with('success', 'Publikasi dan semua tahapan terkait berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $publications = Publication::when($query, function ($q) use ($query) {
            $q->where('publication_report', 'like', "%{$query}%")
            ->orWhere('publication_name', 'like', "%{$query}%");
        })->get();

        foreach ($publications as $publication) {
            // inisialisasi jumlah per triwulan
            $rekapPlans = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
            $rekapFinals = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
            $lintasTriwulan = 0;
            $progressKumulatif = 0;

            foreach ($publication->stepsPlans as $plan) {
                // hitung berdasarkan tanggal rencana
                $q = getQuarter($plan->plan_start_date);
                if ($q) $rekapPlans[$q]++;

                // kalau sudah ada realisasi, hitung juga
                if ($plan->stepsFinals) {
                    $fq = getQuarter($plan->stepsFinals->actual_started);
                    if ($fq) $rekapFinals[$fq]++;

                    // cek apakah realisasi lintas triwulan
                    if ($fq && $q && $fq != $q) {
                        $lintasTriwulan++;
                    }
                }
            }

            // hitung progress kumulatif
            $totalPlans = array_sum($rekapPlans);
            $totalFinals = array_sum($rekapFinals);
            if ($totalPlans > 0) {
                $progressKumulatif = ($totalFinals / $totalPlans) * 100;
            } else {
                $progressKumulatif = 0;
            }

            // hitung progress per triwulan
            $progressTriwulan = [];
            foreach ([1, 2, 3, 4] as $q) {
                if ($rekapPlans[$q] > 0) {
                    $progressTriwulan[$q] = ($rekapFinals[$q] / $rekapPlans[$q]) * 100;
                } else {
                    $progressTriwulan[$q] = 0;
                }
            }

            // inject hasil rekap ke model publikasi
            $publication->rekapPlans = $rekapPlans;
            $publication->rekapFinals = $rekapFinals;
            $publication->lintasTriwulan = $lintasTriwulan;
            $publication->progressKumulatif = $progressKumulatif;
            $publication->progressTriwulan = $progressTriwulan;
        }

        return response()->json($publications);
    }

}