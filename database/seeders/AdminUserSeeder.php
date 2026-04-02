<?php
// database/seeders/AdminUserSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Créer l'administrateur principal
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@agepif.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '+225 01 23 45 67',
            'email_verified_at' => now(),
        ]);

        // Créer un utilisateur de test
        User::create([
            'name' => 'Jean Dupont',
            'email' => 'jean.dupont@email.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'phone' => '+225 07 89 10 11',
            'email_verified_at' => now(),
        ]);

        // Créer un deuxième administrateur
        User::create([
            'name' => 'Marie Konan',
            'email' => 'marie@agepif.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '+225 05 55 66 77',
            'email_verified_at' => now(),
        ]);
    }
}
