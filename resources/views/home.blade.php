@extends('layouts.app')

<style>
 .patientTbl {
    border-collapse: collapse;
    width: 100%;
 }
 td {
    text-align: center;
    padding: 8px;
 }
 tr:nth-child(even) {
    background-color: cadetblue;
 }
 .patientTbl thead {
    background-color: lightgrey;
 }
 th {
    padding: 8px;
    text-align: center !important;
 }
 #containerHome{
    margin-top: 50px;
}
 h1{
    margin-top: 20px !important;
    text-align: center;
 }
</style>

@section('content')
<div class="container">
    <h1>Patient: {{session('name')}}</h1>
    <div class="row justify-content-center" id="containerHome">
        <div class="col-md-8">
            <table class="patientTbl">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Weight</th>
                        <th>History</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($patient)) <!-- Controlla se la variabile $patient esiste -->
                        <tr>
                            <td>{{ $patient->id }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->age }}</td>
                            <td>{{ $patient->weights->last()->weight ?? 'N/A' }}</td> <!-- Mostra l'ultimo peso disponibile -->
                            <td>{{ $patient->medicalHistories->last()->medical_history ?? 'N/A' }}</td> <!-- Mostra l'ultima storia medica -->
                        </tr>
                    @else
                        <tr>
                            <td colspan="5">Nessun paziente selezionato.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
