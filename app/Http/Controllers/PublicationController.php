<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Publication;
use App\Models\StepsPlan;


class PublicationController extends Controller
{
    public function index(Request $request)
    {
        // Cek apakah ini request AJAX untuk data per triwulan
        if ($request->ajax() && $request->has('triwulan')) {
            return $this->getStatistikPerTriwulan($request->input('triwulan'));
        }

        // Tambahkan rekap publikasi tahunan
        $rekapPublikasiTahunan = $this->getStatistikPublikasiTahunan();

        // Request normal (bukan AJAX) - tampilkan view dengan data kumulatif
        $publications = Publication::with([
            'user',
            'stepsPlans.stepsFinals.struggles'
        ])->get();
        
        // looping dan perhitungan per publikasi
        foreach ($publications as $publication) {
            // inisialisasi jumlah per triwulan
            $rekapPlans = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
            $rekapFinals = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
            // $lintasTriwulan = 0;
            $lintasTriwulan = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
            $progressKumulatif = 0;

            // 🟩 Tambahkan inisialisasi array list kosong per publikasi
            $listPlans = [1 => [], 2 => [], 3 => [], 4 => []];
            $listFinals = [1 => [], 2 => [], 3 => [], 4 => []];
            $listLintas = [1 => [], 2 => [], 3 => [], 4 => []];

            // Looping di setiap tahapan 
            foreach ($publication->stepsPlans as $plan) {
                
                // Tentukan triwulan dari rencana dan realisasi
                $q = getQuarter($plan->plan_start_date);
                if ($q) {
                    $rekapPlans[$q]++;
                    $listPlans[$q][] = $plan->plan_name; // Simpan nama tahapan untuk referensi
                }
                
                if ($plan->stepsFinals) {
                    // Tentukan triwulan realisasi
                    $fq = getQuarter($plan->stepsFinals->actual_started);
                    if ($fq) {
                        $rekapFinals[$fq]++;
                        $listFinals[$fq][] = $plan->plan_name; // Simpan nama tahapan untuk referensi
                    }

                    // Cek Lintas Triwulan
                    if ($fq && $q && $fq != $q) {
                        $lintasTriwulan[$fq]++;
                        $listLintas[$fq][] = [
                            'plan_name' => $plan->plan_name,
                            'from_quarter' => $q,
                            'to_quarter' => $fq
                        ];
                    }
                }        
            }

            // --- PENGHITUNGAN PROGRESS KUMULATIF PUBLIKASI ---
            $totalPlans = array_sum($rekapPlans);
            $totalFinals = array_sum($rekapFinals);
            $progressKumulatif = ($totalPlans > 0) ? ($totalFinals / $totalPlans) * 100 : 0;

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
            // hover
            $publication->listPlans = $listPlans ?? [];
            $publication->listFinals = $listFinals ?? [];
            $publication->listLintas = $listLintas ?? [];
        }

        return view('tampilan.homeketua', compact(
            'publications','rekapPublikasiTahunan',
        ));
    }

    private function getStatistikPerTriwulan($triwulan)
    {
        $publications = Publication::with([
            'user',
            'stepsPlans.stepsFinals.struggles'
        ])->get();

        $totalPublikasi = $publications->count();
        $belumBerlangsungPublikasi = 0;
        $sedangBerlangsungPublikasi = 0;
        $sudahSelesaiPublikasi = 0;

        $totalTahapan = 0;
        $belumBerlangsungTahapan = 0;
        $sedangBerlangsungTahapan = 0;
        $sudahSelesaiTahapan = 0;
        $tertundaTahapan = 0;

        foreach ($publications as $publication) {
            $rekapPlans = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
            $rekapFinals = [1 => 0, 2 => 0, 3 => 0, 4 => 0];

            // Reset per publikasi
            $belumTahapan = 0;
            $berlangsungTahapan = 0;
            $selesaiTahapan = 0;

            foreach ($publication->stepsPlans as $plan) {
                // Belum berlangsung
                if (empty($plan->plan_start_date) && empty($plan->plan_end_date)) {
                    $belumTahapan++;
                    $belumBerlangsungTahapan++;
                    continue;
                }

                $q = getQuarter($plan->plan_start_date);

                if ($q == $triwulan) {
                    $totalTahapan++;
                    $rekapPlans[$q]++;

                    // Sudah selesai
                    if ($plan->stepsFinals) {
                        $selesaiTahapan++;
                        $fq = getQuarter($plan->stepsFinals->actual_started);
                        if ($fq && $fq != $q) {
                            $tertundaTahapan++;
                        } else {
                            $sudahSelesaiTahapan++;
                        }
                    }
                    // Sedang berlangsung
                    else {
                        $berlangsungTahapan++;
                        $sedangBerlangsungTahapan++;
                    }
                }
            }

            // Hitung progres publikasi di triwulan ini
            $totalPlans = array_sum($rekapPlans);
            $totalFinals = array_sum($rekapFinals);
            $progressTriwulan = ($totalPlans > 0) ? ($totalFinals / $totalPlans) * 100 : 0;

            // Status publikasi
            if ($selesaiTahapan > 0 && $berlangsungTahapan == 0 && $belumTahapan == 0) {
                $sudahSelesaiPublikasi++;
            } elseif ($berlangsungTahapan > 0) {
                $sedangBerlangsungPublikasi++;
            } elseif ($belumTahapan > 0 && $berlangsungTahapan == 0 && $selesaiTahapan == 0) {
                $belumBerlangsungPublikasi++;
            }
        }

        $persentaseRealisasi = ($totalTahapan > 0) 
            ? round(($sudahSelesaiTahapan / $totalTahapan) * 100) 
            : 0;

        return response()->json([
            'publikasi' => [
                'total' => $totalPublikasi,
                'belumBerlangsung' => $belumBerlangsungPublikasi,
                'sedangBerlangsung' => $sedangBerlangsungPublikasi,
                'sudahSelesai' => $sudahSelesaiPublikasi,
            ],
            'tahapan' => [
                'total' => $totalTahapan,
                'belumBerlangsung' => $belumBerlangsungTahapan,
                'sedangBerlangsung' => $sedangBerlangsungTahapan,
                'sudahSelesai' => $sudahSelesaiTahapan,
                'tertunda' => $tertundaTahapan,
                'persentaseRealisasi' => $persentaseRealisasi,
            ]
        ]);
    }

    private function getStatistikPublikasiTahunan()
    {
        $publications = Publication::with([
            'user',
            'stepsPlans.stepsFinals'
        ])->get();

        // Inisialisasi variabel statistik
        $totalPublikasi = $publications->count();
        $belumBerlangsungPublikasi = 0;
        $sedangBerlangsungPublikasi = 0;
        $sudahSelesaiPublikasi = 0;

        foreach ($publications as $publication) {
            $totalTahapan = count($publication->stepsPlans);
            $jumlahSelesai = 0;
            $jumlahBelumAdaTanggal = 0;

            foreach ($publication->stepsPlans as $plan) {
                // Jika rencana belum ada tanggal -> dianggap belum berlangsung
                if (empty($plan->plan_start_date) && empty($plan->plan_end_date)) {
                    $jumlahBelumAdaTanggal++;
                    continue;
                }

                // Jika tahapan sudah punya hasil (stepsFinals) -> selesai
                if ($plan->stepsFinals) {
                    $jumlahSelesai++;
                }
            }

            // Tentukan status publikasi berdasarkan tahapan
            if ($totalTahapan === 0 || $jumlahBelumAdaTanggal === $totalTahapan) {
                $belumBerlangsungPublikasi++;
            } elseif ($jumlahSelesai === $totalTahapan) {
                $sudahSelesaiPublikasi++;
            } else {
                $sedangBerlangsungPublikasi++;
            }
        }

        return [
            'total' => $totalPublikasi,
            'belumBerlangsung' => $belumBerlangsungPublikasi,
            'sedangBerlangsung' => $sedangBerlangsungPublikasi,
            'sudahSelesai' => $sudahSelesaiPublikasi,
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug_publication'; // bukan id lagi
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

        // $publication = Publication::findOrFail($publication);
        $publication->update([
            'publication_name'   => $request->publication_name,
            'publication_report' => $publicationReport,
            'publication_pic'    => $request->publication_pic,
        ]);

        return redirect()->route('daftarpublikasi')
            ->with('success', 'Publikasi berhasil diperbarui.');
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
            ->orWhere('publication_name', 'like', "%{$query}%")
            ->orWhere('publication_pic', 'like', "%{$query}%");
        })
        ->with([
            'user',
            'stepsPlans.stepsFinals.struggles'
        ])
        ->get();

        foreach ($publications as $publication) {
            // ... kode rekap yang sama ...
            
            $rekapPlans = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
            $rekapFinals = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
            $lintasTriwulan = 0;
            $progressKumulatif = 0;

            foreach ($publication->stepsPlans as $plan) {
                $q = getQuarter($plan->plan_start_date);
                if ($q) $rekapPlans[$q]++;

                if ($plan->stepsFinals) {
                    $fq = getQuarter($plan->stepsFinals->actual_started);
                    if ($fq) $rekapFinals[$fq]++;

                    if ($fq && $q && $fq != $q) {
                        $lintasTriwulan++;
                    }
                }
            }

            $totalPlans = array_sum($rekapPlans);
            $totalFinals = array_sum($rekapFinals);
            if ($totalPlans > 0) {
                $progressKumulatif = ($totalFinals / $totalPlans) * 100;
            } else {
                $progressKumulatif = 0;
            }

            $progressTriwulan = [];
            foreach ([1, 2, 3, 4] as $q) {
                if ($rekapPlans[$q] > 0) {
                    $progressTriwulan[$q] = ($rekapFinals[$q] / $rekapPlans[$q]) * 100;
                } else {
                    $progressTriwulan[$q] = 0;
                }
            }

            $publication->rekapPlans = $rekapPlans;
            $publication->rekapFinals = $rekapFinals;
            $publication->lintasTriwulan = $lintasTriwulan;
            $publication->progressKumulatif = $progressKumulatif;
            $publication->progressTriwulan = $progressTriwulan;
        }

        // Return dengan explicit fields termasuk slug_publication
        return response()->json($publications->map(function($pub) {
            return [
                'slug_publication' => $pub->slug_publication, // PENTING: pastikan ini ada
                'publication_report' => $pub->publication_report,
                'publication_name' => $pub->publication_name,
                'publication_pic' => $pub->publication_pic,
                'rekapPlans' => $pub->rekapPlans,
                'rekapFinals' => $pub->rekapFinals,
                'lintasTriwulan' => $pub->lintasTriwulan,
                'progressKumulatif' => $pub->progressKumulatif,
                'progressTriwulan' => $pub->progressTriwulan,
            ];
        }));
    }
}