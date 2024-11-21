<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PatientWeight;
use App\Models\PatientMedicalHistory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PatientController extends Controller
{
    public function store(Request $request)
    {
        // Validazione dei dati
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'weight' => 'required|numeric|min:0',
            'history' => 'required|string',
        ]);
        // dd($request->all());

        // Creazione del paziente
        $patient = Patient::create([
            'name' => $request->input('name'),
            'age' => $request->input('age'),
        ]);

        // Salvataggio del peso
        PatientWeight::create([
            'patient_id' => $patient->id,
            'weight' => $request->input('weight'),
        ]);

        // Salvataggio della storia clinica
        PatientMedicalHistory::create([
            'patient_id' => $patient->id,
            'medical_history' => $request->input('history'),
        ]);

        // Reindirizza con un messaggio di successo
        return redirect()->route('home', ['id' => $patient->id])
        ->with('success', 'Patient added successfully!');    }

    public function databasePatients()
    {
        // Recupera tutti i pazienti dal database
        $patients = Patient::with(['weights', 'medicalHistories'])->get();
        
        // Passa i pazienti alla vista
        return view('database', compact('patients'));
    }

//recupera il paziente dal database e lo mostra nella home
    public function show($id)
    {
        Log::info("Fetching patient with ID: $id");

        $patient = Patient::with(['weights', 'medicalHistories'])->find($id);

        session(['patient_id' => $patient->id]); 
        session(['name' => $patient->name]);//lo memorizza in sessione cosi ovunque sia se torno alla home lui ce ancora

        if (!$patient) {
            Log::error("Patient not found with ID: $id");
            return redirect('/home')->with('error', 'Patient not found.');
        }

        Log::info("Patient found: " . json_encode($patient)); // Log dettagli del paziente

        return view('home', compact('patient'));
    }

    public function update(Request $request, $id)
{
    // Validazione dei dati
    $validated = $request->validate([
        'age' => 'required|integer|min:0',
        'weight' => 'required|numeric|min:0',
        'history' => 'required|string',
    ]);
    // Recupera il paziente usando l'ID
    $patient = Patient::findOrFail($id); // Assicurati di importare il modello Patient
    // Aggiorna i campi del paziente
    $patient->age = $validated['age'];
    $patient->save(); // Salva le modifiche nel database

    // Aggiorna il peso nella tabella patient_weights
    $patientWeight = $patient->weight; // Assicurati che ci sia un metodo per ottenere il peso attuale
    if ($patientWeight) {
        $patientWeight->weight = $validated['weight'];
        $patientWeight->save();
    } else {
        // Se il peso non esiste, crealo
        $patient->weights()->create(['weight' => $validated['weight']]);
    }

    // Aggiorna la storia medica
    $patientHistory = $patient->medicalHistory; // Assicurati che ci sia un metodo per ottenere la storia medica
    if ($patientHistory) {
        $patientHistory->medical_history = $validated['history'];
        $patientHistory->save();
    } else {
        // Se la storia medica non esiste, creala
        $patient->medicalHistories()->create(['medical_history' => $validated['history']]);
    }

    return redirect()->route('home', ['id' => $patient->id])->with('success', 'Dati aggiornati con successo');}

    


}

