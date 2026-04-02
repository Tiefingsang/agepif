<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Property;
use App\Models\Rental;
use Illuminate\Database\Seeder;

class RentalSeeder extends Seeder
{
    public function run(): void
    {
        $client = Client::first();
        $property = Property::where('transaction_type', 'rent')->first();

        if ($client && $property) {
            Rental::create([
                'client_id' => $client->id,
                'property_id' => $property->id,
                'start_date' => now(),
                'end_date' => now()->addYear(),
                'monthly_rent' => $property->price,
                'deposit' => $property->price * 2,
                'status' => 'active',
                'contract_notes' => 'Contrat de location standard',
            ]);
        }
    }
}
