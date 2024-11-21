<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Controlla se l'utente è autenticato
        if (auth()->check()) {
            return view('home'); // restituisce la vista per gli utenti autenticati
        }

        return view('index'); // restituisce la vista per gli utenti non autenticati
    }
}
