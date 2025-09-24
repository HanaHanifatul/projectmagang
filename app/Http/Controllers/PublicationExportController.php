<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;  
use App\Exports\PublicationExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class PublicationExportController extends Controller
{
    //  public function export($id)
    // {
    //     // Perbaikan: Gunakan variabel $id yang sudah ada di parameter fungsi
    //     $publication = Publication::with(['stepsplans.stepsFinals.struggles'])->findOrFail($id);

    //     // 1. Export Excel
    //     $excelFileName = "publication_{$id}.xlsx";
    //     $excelPath = "exports/{$excelFileName}";
    //     // Excel::store() akan menyimpan file di storage/app
    //     Excel::store(new PublicationExport($id), $excelPath);

    //     // 2. Buat ZIP
    //     $zipFileName = "publication_{$id}.zip";
    //     $zipPath = storage_path("app/exports/{$zipFileName}");
    //     $zip = new ZipArchive;

    //     // Perbaikan: Pastikan direktori ada sebelum membuat file
    //     $storageExportsPath = storage_path('app/exports');
    //     if (!file_exists($storageExportsPath)) {
    //         mkdir($storageExportsPath, 0777, true);
    //     }

    //     // Buka file zip untuk ditambahkan isinya
    //     if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
    //         // Excel
    //         // Tambahkan file Excel ke dalam zip
    //         $excelFullPath = storage_path("app/{$excelPath}");
    //         if (file_exists($excelFullPath)) {
    //             $zip->addFile($excelFullPath, "publication.xlsx");
    //         }

    //         // Dokumen terkait
    //         foreach ($publication->stepsplans as $plan) {
    //             // Dokumen Plan
    //             if ($plan->plan_doc) {
    //                 $docFullPath = storage_path("app/public/{$plan->plan_doc}");
    //                 if (file_exists($docFullPath)) {
    //                     $zip->addFile($docFullPath, "plans/" . basename($plan->plan_doc));
    //                 }
    //             }
    //             if ($plan->stepsFinals) {
    //                 $final = $plan->stepsFinals;
    //                 // Dokumen Final
    //                 if ($final->final_doc) {
    //                     $docFullPath = storage_path("app/public/{$final->final_doc}");
    //                     if (file_exists($docFullPath)) {
    //                         $zip->addFile($docFullPath, "finals/" . basename($final->final_doc));
    //                     }
    //                 }
    //                 // Dokumen Struggles
    //                 foreach ($final->struggles as $struggle) {
    //                     if ($struggle->solution_doc) {
    //                         $docFullPath = storage_path("app/public/{$struggle->solution_doc}");
    //                         if (file_exists($docFullPath)) {
    //                             $zip->addFile($docFullPath, "struggles/" . basename($struggle->solution_doc));
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //         $zip->close();
    //     }

    //     // 3. Unduh file
    //     // Pastikan file ZIP benar-benar ada sebelum mencoba mengunduhnya
    //     if (file_exists($zipPath)) {
    //         return response()->download($zipPath)->deleteFileAfterSend(true);
    //     } else {
    //         return redirect()->back()->with('error', 'Gagal membuat file ZIP.');
    //     }
    // }

    public function export($id)
    {
        // 1. Ambil data publikasi
        $publication = Publication::with(['stepsplans.stepsFinals.struggles'])->findOrFail($id);

        // 2. Export Excel
        $excelFileName = "publication_{$id}.xlsx";
        $excelPath = "exports/{$excelFileName}";
        // File Excel disimpan di storage/app/exports
        Excel::store(new PublicationExport($id), $excelPath);

        // 3. Buat file ZIP
        $zipFileName = "publication_{$id}.zip";
        $zipPath = "exports/{$zipFileName}";
        $zip = new ZipArchive;

        // Pastikan direktori 'exports' ada
        if (!Storage::exists('exports')) {
            Storage::makeDirectory('exports');
        }

        // Buka file zip untuk ditambahkan isinya
        if ($zip->open(Storage::path($zipPath), ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            
            // Tambahkan file Excel ke dalam zip
            // Menggunakan Storage::path() untuk mendapatkan path absolut yang benar
            $excelFullPath = Storage::path($excelPath);
            if (file_exists($excelFullPath)) {
                $zip->addFile($excelFullPath, "publication.xlsx");
            }

            // Tambahkan dokumen-dokumen terkait ke dalam zip
            foreach ($publication->stepsplans as $plan) {
                // Dokumen Plan (dari storage/app/public)
                if ($plan->plan_doc && Storage::disk('public')->exists($plan->plan_doc)) {
                    $zip->addFile(Storage::disk('public')->path($plan->plan_doc), "plans/" . basename($plan->plan_doc));
                }
                
                if ($plan->stepsFinals) {
                    $final = $plan->stepsFinals;
                    // Dokumen Final (dari storage/app/public)
                    if ($final->final_doc && Storage::disk('public')->exists($final->final_doc)) {
                        $zip->addFile(Storage::disk('public')->path($final->final_doc), "finals/" . basename($final->final_doc));
                    }
                    // Dokumen Struggles (dari storage/app/public)
                    foreach ($final->struggles as $struggle) {
                        if ($struggle->solution_doc && Storage::disk('public')->exists($struggle->solution_doc)) {
                            $zip->addFile(Storage::disk('public')->path($struggle->solution_doc), "struggles/" . basename($struggle->solution_doc));
                        }
                    }
                }
            }
            $zip->close();
        }

        // 4. Unduh file ZIP
        if (Storage::exists($zipPath)) {
            return Storage::download($zipPath);
        } else {
            return redirect()->back()->with('error', 'Gagal membuat file ZIP.');
        }
    }
}