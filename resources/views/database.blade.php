@extends('layouts.app')

<!-- da qui parte il body di chi è loggato -->
<style>
 .patientTbl{
    border-collapse: collapse;
    width: 100%;
 }
td {
    text-align: center;
    padding: 8px;
}
tr:nth-child(even) {
    background-color: cadetblue ;
}
.patientTbl thead{
    background-color: lightgrey;
}
th{
    padding: 8px;
    text-align: center !important;
}
#containerDatabase{
    margin-top: 50px;
}
 h1{
    margin-top: 20px !important;
    text-align: center;
 }
</style>
@section('content')
<div class="container" >
    <div>
        <h1>Patients database</h1>
    </div>
    <div class="row justify-content-center" id="containerDatabase">
        <div class="col-md-8">
            <table class="patientTbl">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Weight</th>
                        <th>Hystory</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $patient)
                        <tr id="{{ $patient->id }}" onclick="window.location='{{ route('home', $patient->id) }}'" style="cursor: pointer;">
                            <td>{{ $patient->id }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->age }}</td>
                            <td>{{ $patient->weights->last()->weight ?? 'N/A' }}</td> <!-- Mostra l'ultimo peso disponibile -->
                            <td>{{ $patient->medicalHistories->last()->medical_history ?? 'N/A' }}</td> <!-- Mostra l'ultima storia medica -->
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

