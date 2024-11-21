<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age'];

    public function weights()
    {
        return $this->hasMany(PatientWeight::class);
    }

    public function medicalHistories()
    {
        return $this->hasMany(PatientMedicalHistory::class);
    }

    public function heights()
    {
        return $this->hasMany(PatientHeight::class);
    }
}

