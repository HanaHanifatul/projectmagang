<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StepsFinal extends Model
{
    use HasFactory;

    protected $table = 'steps_finals';
    protected $primaryKey = 'step_final_id';
    
    protected $fillable = [
        'actual_start_realized',
        'final_end_realized',
        'final_name',
        'final_desc',
        'final_doc',
        'next_step',
        'step_plan_id'
    ];

    protected $casts = [
        'actual_start_realized' => 'date',
        'final_end_realized' => 'date'
    ];

    // Relasi: Steps Final dimiliki oleh satu Steps Plan
    public function stepsPlan()
    {
        return $this->belongsTo(StepsPlan::class, 'step_plan_id', 'step_plan_id');
    }

    // Relasi: Steps Final memiliki banyak Struggles
    public function struggles()
    {
        return $this->hasMany(Struggle::class, 'step_final_id', 'step_final_id');
    }
}
