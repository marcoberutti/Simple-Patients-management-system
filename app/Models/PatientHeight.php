<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientHeight extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'height'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}







// Aggiornare l'altezza
// $patient = Patient::find($patientId);
// $patient->heights()->create(['height' => $newHeight]);

// public function calculateBMI($patientId)
// {
//     $latestWeight = PatientWeight::where('patient_id', $patientId)->latest()->first();
//     $latestHeight = PatientHeight::where('patient_id', $patientId)->latest()->first();

//     if ($latestWeight && $latestHeight) {
//         $weight = $latestWeight->weight;
//         $height = $latestHeight->height; // altezza in metri
//         return $weight / ($height * $height); // formula BMI
//     }

//     return null; // o un valore di default
// }


