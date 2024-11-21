<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;



class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // var_dump($request->all());
    // Validation with error messages
    $request->validate([
        'patient_id' => 'required|exists:patients,id',
        'item' => 'required|string|max:255',
        'quantity' => 'required|integer|min:1',
        'amount' => 'required|numeric',
        'discount' => 'nullable|numeric',
        'deposit' => 'nullable|numeric',
        'total' => 'required|numeric',
    ], [
        'patient_id.required' => 'Il campo paziente è obbligatorio.',
        'patient_id.exists' => 'Il paziente selezionato non esiste.',
        'item.required' => 'Il campo articolo è obbligatorio.',
        'quantity.required' => 'Il campo quantità è obbligatorio.',
        'quantity.integer' => 'La quantità deve essere un numero intero.',
        'quantity.min' => 'La quantità deve essere maggiore di 0.',
        'amount.required' => 'Il campo importo è obbligatorio.',
        'amount.numeric' => 'L\'importo deve essere un numero.',
        'discount.numeric' => 'Lo sconto deve essere un numero.',
        'deposit.numeric' => 'La caparra deve essere un numero.',
        'total.required' => 'Il campo totale è obbligatorio.',
        'total.numeric' => 'Il totale deve essere un numero.',
    ]);

    // Create a new Invoice instance and fill it with validated data
    $invoice = Invoice::create([
        'patient_id'=> $request->input('patient_id'),
        'item'=> $request->input('item'),
        'quantity'=> $request->input('quantity'),
        'amount'=> $request->input('amount'),
        'discount'=> $request->input('discount'),
        'deposit'=> $request->input('deposit'),
        'total'=> $request->input('total'),
    ]);
    

    // Save the invoice to the database
    $invoice->save();

    // Redirect to the invoices index with a success message
    return view('invoices.preview')->with('success', 'Fattura creata con successo!');
}
    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    public function createInvoice(Request $request)
{
    
}


}
