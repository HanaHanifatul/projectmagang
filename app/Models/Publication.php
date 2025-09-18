<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $table = 'publications';
    protected $primaryKey = 'publication_id';
    
    protected $fillable = [
        'publication_report',
        'publication_name',
        'publication_pic',
        'fk_user_id',
    ];

    // Relasi: Publication dimiliki oleh satu User
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'user_id');
    // }

    // Relasi: Publication memiliki banyak Steps Plans
    public function stepsPlans()
    {
        return $this->hasMany(StepsPlan::class, 'publication_id', 'publication_id');
    }
}