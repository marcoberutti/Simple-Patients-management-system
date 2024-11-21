<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientWeight extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'weight'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
