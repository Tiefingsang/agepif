<?php
// database/seeders/CategoriesTableSeeder.php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Villas de luxe',
                'slug' => 'villas-de-luxe',
                'icon' => 'fas fa-home',
                'description' => 'Villas haut de gamme avec piscine et jardin',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Appartements',
                'slug' => 'appartements',
                'icon' => 'fas fa-building',
                'description' => 'Appartements modernes en centre-ville',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Terrains',
                'slug' => 'terrains',
                'icon' => 'fas fa-map-marker-alt',
                'description' => 'Terrains constructibles',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Locaux commerciaux',
                'slug' => 'locaux-commerciaux',
                'icon' => 'fas fa-store',
                'description' => 'Boutiques, bureaux et espaces commerciaux',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Résidences',
                'slug' => 'residences',
                'icon' => 'fas fa-city',
                'description' => 'Résidences sécurisées',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Studios',
                'slug' => 'studios',
                'icon' => 'fas fa-bed',
                'description' => 'Studios meublés et équipés',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Maisons individuelles',
                'slug' => 'maisons-individuelles',
                'icon' => 'fas fa-house-user',
                'description' => 'Maisons familiales',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Immeubles',
                'slug' => 'immeubles',
                'icon' => 'fas fa-building',
                'description' => 'Immeubles à usage d\'habitation ou mixte',
                'order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
