<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
    .dropdown-item:hover{
        background-color: lightgrey;
    }
    #patientSessionNav a{
        text-decoration: none;
        color: grey !important;
    }
    #patientSessionNav a:hover{
        text-decoration: none;
        color: rgb(59, 59, 161) !important;
        font-weight: 600;
    }
    .modal-dialog{
        margin-top: 200px;
    }
    .styled-table tr:nth-child(even) {
        background-color: #D6EEEE;
    }
    .styled-table th{
        background-color: lightgray;
    }


    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="http://127.0.0.1:8000/home/{{session('patient_id')}}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                @if (session('name') && session('patient_id'))
                <div id="patientSessionNav">
                    <div>
                        <a href="{{route('home',['id'=>session('patient_id')])}}">Patient id: {{session('patient_id')}}</a>
                    </div>
                    <div>
                        <a href="{{route('home',['id'=>session('patient_id')])}}">Patient Name: {{session('name')}}</a>                
                    </div>
                </div>
                @endif
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <!-- Aggiungi eventuali link qui -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown" style="margin-right: 50px;">
                                @if (Route::has('login'))
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Patients</a>
                                @endif
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/database">Patients database</a>
                                    <a class="dropdown-item" href="#" onclick="openChangeDataModal()" data-bs-toggle="modal" data-bs-target="#changeDataModal">Change patient data</a>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addPatientModal">Add patient</a>
                                    <a class="dropdown-item" href="">other thing</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown" style="margin-right: 50px;">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Payments
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#invoiceModal">New invoice</a>
                                    <a class="dropdown-item" href="">Payment database</a>
                                    <a class="dropdown-item" href="">Accountability</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>
                    <div class="modal fade" id="changeDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Change patient data for:{{session('name')}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                @if(isset($patient))
                                    <form action="

                                    {{ route('patients.update', ['id' => $patient->id]) }}
                                    " method="post">
                                    @csrf
                                    @method('PUT')
                                        <div class="mb-3">
                                            <label class="form-label" for="age">Age</label>
                                            <input class="form-control" type="number" name="age" id="age">
                                        </div>
                                        <div class="mb-3">
                                        <label class="form-label" for="weight">Weight</label>
                                        <input class="form-control" type="number" name="weight" id="weight">                                    
                                        </div> 
                                        <div class="mb-3">
                                        <label class="form-label" for="history">Hystory</label>
                                        <input class="form-control" type="text" name="history" id="history">
                                        </div>
                                    
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>



                    <div class="modal fade" id="addPatientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add patient to database</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('patients.store') }}" method="post">
                                    @csrf
                                    @method('POST')
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Name</label>
                                        <input class="form-control" type="text" name="name" id="name">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="age">Age</label>
                                            <input class="form-control" type="number" name="age" id="age">
                                        </div>
                                        <div class="mb-3">
                                        <label class="form-label" for="weight">Weight</label>
                                        <input class="form-control" type="number" name="weight" id="weight">                                    
                                        </div> 
                                        <div class="mb-3">
                                        <label class="form-label" for="history">Hystory</label>
                                        <input class="form-control" type="text" name="history" id="history">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                            <div class="modal" id="invoiceModal" tabindex="-1"  style="margin-top: -100px" >
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Make invoice</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div style="display: flex; flex-direction:row; align-items:baseline;">
                                            <h5><p>Patient Id: {{session('patient_id')}} </p></h5>
                                            <h6 style="margin-left: 15px;" id="idReceiptForm"></h6>
                                        </div>
                                        <div style="display: flex; flex-direction:row; align-items:baseline;">
                                            <h5><p>Patient Name: {{session('name')}}</p></h5>
                                            <h6 style="margin-left: 15px;" id="NamereceiptForm"></h6>
                                        </div>
                                        <form action="{{ route('invoices.store') }}" method="post">
                                        @csrf
                                        @method('POST')
                                            <div class="mb-3" id="quotationTable">
                                                <input hidden type="number" name="patient_id" value="{{session('patient_id')}}">
                                                <table class="styled-table" >
                                                    <thead>
                                                        <tr>
                                                            <th>Item</th>
                                                            <th>Unit amount</th>
                                                            <th>Quantity</th>
                                                            <th>Discount</th>
                                                            <th>Deposit</th>
                                                            <th>Supposed total</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="newItems">
                                                            <tr>
                                                                <td><input name="item" type="text" class="form-control" placeholder="Item" id="item-1"></td>
                                                                <td><input name="quantity" type="number" class="form-control" placeholder="Quantity" id="quantity-1"></td>
                                                                <td><input name="amount" type="number" class="form-control" placeholder="Price" id="price-1"></td>
                                                                <td><input name="discount" type="number" class="form-control" placeholder="Discount" id="discount-1"></td>
                                                                <td><input name="deposit" type="number" class="form-control" placeholder="Deposit" id="deposit-1"></td>
                                                                <td><input name="total" type="number" class="form-control" placeholder="Total price" readonly id="total-1"></td>
                                                            </tr>
                                                        </tbody>
                                                </table>
                                                <button id="addItem" type="button" class="btn btn-primary">Add row</button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Show preview</button>
                                            </div>
                                        </form>
                                        
                                    </div>
                                    
                                    </div>
                                </div>
                            </div>
        </nav>
        <main class="py-4">
            <div class="alert">
                                                    
            </div>
            @yield('content')  <!-- Assicurati che questo sia qui -->
        </main>
    </div>
</body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</html>
<script>
    $(document).ready(function(){
        const patientIdStore = localStorage.getItem('{{session('patient_id')}}');
        const patientNameStore = localStorage.getItem("{{session('name')}}");
    })
        let rowCounter = 1;
    $('#addItem').on('click', function(){ 
        rowCounter++; // Increment the counter when a new row is added
        $("#newItems").append(`
            <tr>
                <td><input name="item[]" type="text" class="form-control" id="item-${rowCounter}" placeholder="Item"></td>
                <td><input name="quantity[]" type="number" class="form-control" id="quantity-${rowCounter}" placeholder="Quantity"></td>
                <td><input name="amount[]" type="number" class="form-control" placeholder="Price" id="price-1"></td>
                <td><input name="discount[]" type="number" class="form-control" id="discount-${rowCounter}" placeholder="Discount"></td>
                <td><input name="deposit[]" type="number" class="form-control" id="deposit-${rowCounter}" placeholder="Deposit"></td>
                <td><input name="total[]" type="number" class="form-control" id="total-${rowCounter}" placeholder="Total price" readonly></td>
            </tr>
        `);
    })
        $("#newItems").on('input', 'input[type="number"], input[type="text"]', function() {
            const row = $(this).closest('tr');
            const quantity = parseFloat(row.find('input[id^="quantity-"]').val()) || 0;
            const unitPrice = parseFloat(row.find('input[id^="price-"]').val()) || 0;
            const discount = parseFloat(row.find('input[id^="discount-"]').val()) || 0;
            const deposit = parseFloat(row.find('input[id^="deposit-"]').val()) || 0;
        
            // Calcola il Prezzo Totale
            const totalPrice = (quantity * unitPrice) - discount - deposit;
            row.find('input[id^="total-"]').val(totalPrice.toFixed(2)); // Mostra 2 decimali
        });

        $(document).ready(function() {
    $('#printBtn').on('click', function(evt) { 
        evt.preventDefault();  // Previeni il comportamento predefinito del bottone

        for (let i = 1; i <= rowCounter; i++) {
            // Raccogli i valori inseriti nei campi di input per ogni riga
            $(`#item-${i}`).attr('value', $(`#item-${i}`).val());
            $(`#quantity-${i}`).attr('value', $(`#quantity-${i}`).val());
            $(`#price-${i}`).attr('value', $(`#price-${i}`).val());
            $(`#discount-${i}`).attr('value', $(`#discount-${i}`).val());
            $(`#deposit-${i}`).attr('value', $(`#deposit-${i}`).val());
            $(`#total-${i}`).attr('value', $(`#total-${i}`).val());
        }

        // Ottieni il contenuto della tabella e lo memorizza in localStorage
//         var tabella = document.getElementById("quotationTable").innerHTML;
//         localStorage.setItem('tabella', tabella);

//         // Naviga verso l'URL di anteprima

//         if (typeof(Storage) !== "undefined") {
//     // Se esiste, itera su tutte le chiavi e visualizza le coppie chiave-valore
//     for (let i = 0; i < localStorage.length; i++) {
//       let key = localStorage.key(i);
//       let value = localStorage.getItem(key);
//       console.log(key + ": " + value);   

//     }
//   } else {
//     console.log("Il tuo browser non supporta localStorage.");
//   }
    });
});




</script>






{{-- public function store(Request $request)
{
    var_dump($request->all());
    // Validation with error messages
    $validated = $request->validate([
        'patient_id' => 'required|exists:patients,id',
        'items' => 'required|array',
        'items.*.item' => 'required|string|max:255',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.amount' => 'required|numeric',
        'items.*.discount' => 'nullable|numeric',
        'items.*.deposit' => 'nullable|numeric',
        'items.*.total' => 'required|numeric',
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

    foreach ($validated['items'] as $item)
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
    return view ('invoices/preview')->with('success', 'Fattura creata con successo!');
} --}}