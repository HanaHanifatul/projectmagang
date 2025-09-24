<?php

namespace App\Exports;

use App\Models\Publication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PublicationExport implements FromCollection, WithHeadings
{
    protected $publicationId;

    public function __construct($publicationId)
    {
        $this->publicationId = $publicationId;
    }
    
    public function collection()
    {
        $publication = Publication::with(['stepsplans.stepsFinals.struggles'])
            ->where('publication_id', $this->publicationId)
            ->first();

        $rows = collect();

        // Tambahkan baris untuk setiap plan
        foreach ($publication->stepsplans as $plan) {
            $final = $plan->stepsFinals;
            if ($final) {
                // Jika ada struggles, buat baris untuk setiap struggle
                if ($final->struggles->count()) {
                    foreach ($final->struggles as $struggle) {
                        $rows->push([
                            $publication->publication_name,
                            $plan->plan_type,
                            $plan->plan_name,
                            $plan->plan_start_date,
                            $plan->plan_end_date,
                            $plan->plan_desc,
                            $final->actual_started,
                            $final->actual_ended,
                            $final->final_desc,
                            $final->next_step,
                            $struggle->struggle_desc,
                            $struggle->solution_desc,
                        ]);
                    }
                } else {
                    // Jika tidak ada struggles, buat satu baris kosong
                    $rows->push([
                        $publication->publication_name,
                        $plan->plan_type,
                        $plan->plan_name,
                        $plan->plan_start_date,
                        $plan->plan_end_date,
                        $plan->plan_desc,
                        $final->actual_started,
                        $final->actual_ended,
                        $final->final_desc,
                        $final->next_step,
                        null, // Struggle kosong
                        null, // Solution kosong
                    ]);
                }
            } else {
                 // Jika tidak ada stepsFinals, buat satu baris kosong
                $rows->push([
                    $publication->publication_name,
                    $plan->plan_type,
                    $plan->plan_name,
                    $plan->plan_start_date,
                    $plan->plan_end_date,
                    $plan->plan_desc,
                    null, null, null, null, null, null,
                ]);
            }
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            'Publication Name',
            'Plan Type',
            'Plan Name',
            'Plan Start',
            'Plan End',
            'Plan Desc',
            'Final Start',
            'Final End',
            'Final Desc',
            'Next Step',
            'Struggle',
            'Solution',
        ];
    }
}