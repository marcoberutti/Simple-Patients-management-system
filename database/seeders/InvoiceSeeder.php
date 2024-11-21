<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Invoice;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class InvoiceSeeder extends Seeder
{
    public function run()
    {
        // Crea un'istanza di Faker
        $faker = Faker::create();

        // Crea un numero specifico di fatture
        for ($i = 0; $i < 10; $i++) {
            Invoice::create([
                'patient_id' => rand(1, 10), // Assicurati che ci siano pazienti con ID da 1 a 10
                'item' => $faker->word, // Genera un nome casuale per l'item
                'quantity' => rand(1, 5), // Quantità casuale tra 1 e 5
                'amount' => $faker->randomFloat(2, 10, 100), // Importo casuale tra 10 e 100
                'discount' => $faker->randomFloat(2, 0, 10), // Sconto casuale tra 0 e 10
                'deposit' => $faker->randomFloat(2, 0, 10), // Deposito casuale tra 0 e 10
                'total' => $faker->randomFloat(2, 10, 100), // Totale casuale tra 10 e 100
            ]);
        }
    }
}
