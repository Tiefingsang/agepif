<?php
// database/seeders/PropertiesTableSeeder.php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PropertiesTableSeeder extends Seeder
{
    public function run(): void
    {
        $properties = [
            // Propriété 1 - Villa de luxe à Cocody
            [
                'category_id' => 1,
                'title' => 'Villa de luxe à Cocody Riviera',
                'slug' => 'villa-de-luxe-a-cocody-riviera-1',
                'description' => 'Magnifique villa moderne avec piscine à débordement, grand jardin paysager et vue imprenable sur la lagune.',
                'long_description' => 'Cette superbe villa de 350m² est située dans le quartier résidentiel de la Riviera à Cocody. Elle offre un cadre de vie exceptionnel avec ses 5 chambres spacieuses, chacune disposant de sa salle de bain privative. La cuisine américaine est entièrement équipée, le salon est spacieux avec une hauteur sous plafond impressionnante. La propriété comprend également une dépendance pour le personnel, un garage pour 4 voitures et une piscine à débordement avec vue sur la lagune. Les finitions sont de haute qualité avec des matériaux nobles.',
                'price' => 250000000,
                'surface' => 350.00,
                'rooms' => 8,
                'bedrooms' => 5,
                'bathrooms' => 5,
                'garage' => 4,
                'city' => 'Abidjan',
                'neighborhood' => 'Cocody Riviera',
                'address' => 'Riviera Golf, non loin du palais des sports',
                'postal_code' => '01 BP 1234',
                'country' => 'Côte d\'Ivoire',
                'type' => 'house',
                'transaction_type' => 'sale',
                'status' => 'published',
                'features' => json_encode([
                    'piscine', 'jardin', 'parking', 'climatisation', 'garde',
                    'groupe électrogène', 'forage', 'alarme', 'vidéosurveillance'
                ]),
                'images' => json_encode([
                    'properties/villa-cocody-1.jpg',
                    'properties/villa-cocody-2.jpg',
                    'properties/villa-cocody-3.jpg',
                    'properties/villa-cocody-4.jpg',
                ]),
                'video_url' => 'https://www.youtube.com/watch?v=example1',
                'virtual_tour_url' => null,
                'is_featured' => true,
                'views' => 0,
                'available_from' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Propriété 2 - Appartement moderne au Plateau
            [
                'category_id' => 2,
                'title' => 'Appartement moderne au Plateau - Centre-ville',
                'slug' => 'appartement-moderne-au-plateau-centre-ville-2',
                'description' => 'Superbe appartement F3 de 120m² au cœur du Plateau, entièrement rénové avec vue panoramique.',
                'long_description' => 'Appartement de standing situé au 12ème étage d\'un immeuble moderne avec ascenseur et sécurité 24/7. Il comprend un grand salon, une cuisine équipée, 3 chambres dont une suite parentale, 2 salles de bain. Idéal pour cadre expatrié ou professionnel. À proximité de toutes les commodités : banques, restaurants, commerces.',
                'price' => 85000000,
                'surface' => 120.00,
                'rooms' => 4,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'garage' => 1,
                'city' => 'Abidjan',
                'neighborhood' => 'Le Plateau',
                'address' => 'Avenue Franchet d\'Esperey',
                'postal_code' => '01 BP 5678',
                'country' => 'Côte d\'Ivoire',
                'type' => 'apartment',
                'transaction_type' => 'sale',
                'status' => 'published',
                'features' => json_encode([
                    'ascenseur', 'climatisation', 'parking', 'garde', 'vue panoramique'
                ]),
                'images' => json_encode([
                    'properties/appart-plateau-1.jpg',
                    'properties/appart-plateau-2.jpg',
                ]),
                'video_url' => null,
                'virtual_tour_url' => null,
                'is_featured' => true,
                'views' => 0,
                'available_from' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Propriété 3 - Terrain à Yamoussoukro
            [
                'category_id' => 3,
                'title' => 'Terrain constructible à Yamoussoukro',
                'slug' => 'terrain-constructible-a-yamoussoukro-3',
                'description' => 'Magnifique terrain de 1000m² en zone résidentielle, viabilisé et titré.',
                'long_description' => 'Terrain plat de 1000m² situé dans un quartier résidentiel calme à Yamoussoukro. Idéal pour la construction d\'une villa ou d\'une résidence. Le terrain est viabilisé (eau, électricité, réseau) et dispose d\'un titre foncier. Proche de toutes les commodités et des axes principaux.',
                'price' => 25000000,
                'surface' => 1000.00,
                'rooms' => 0,
                'bedrooms' => 0,
                'bathrooms' => 0,
                'garage' => 0,
                'city' => 'Yamoussoukro',
                'neighborhood' => 'Quartier résidentiel',
                'address' => 'Zone 4, non loin du palais présidentiel',
                'postal_code' => 'BP 101',
                'country' => 'Côte d\'Ivoire',
                'type' => 'land',
                'transaction_type' => 'sale',
                'status' => 'published',
                'features' => json_encode([
                    'viabilisé', 'titre foncier', 'zone résidentielle', 'plat'
                ]),
                'images' => json_encode([
                    'properties/terrain-yamoussoukro-1.jpg',
                ]),
                'video_url' => null,
                'virtual_tour_url' => null,
                'is_featured' => false,
                'views' => 0,
                'available_from' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Propriété 4 - Local commercial à Marcory
            [
                'category_id' => 4,
                'title' => 'Local commercial à Marcory - Zone 4',
                'slug' => 'local-commercial-a-marcory-zone-4-4',
                'description' => 'Boutique de 80m² en plein centre commercial, idéale pour commerce.',
                'long_description' => 'Local commercial bien situé dans la zone 4 de Marcory, zone très fréquentée. Surface de 80m² avec devanture sur rue. Idéal pour boutique de vêtements, restaurant, agence ou bureau. Très bon potentiel commercial.',
                'price' => 120000000,
                'surface' => 80.00,
                'rooms' => 2,
                'bedrooms' => 0,
                'bathrooms' => 1,
                'garage' => 0,
                'city' => 'Abidjan',
                'neighborhood' => 'Marcory Zone 4',
                'address' => 'Rue des commerces',
                'postal_code' => '04 BP 9876',
                'country' => 'Côte d\'Ivoire',
                'type' => 'commercial',
                'transaction_type' => 'rent',
                'status' => 'published',
                'features' => json_encode([
                    'vitrine', 'climatisation', 'électricité', 'eau'
                ]),
                'images' => json_encode([
                    'properties/local-marcory-1.jpg',
                    'properties/local-marcory-2.jpg',
                ]),
                'video_url' => null,
                'virtual_tour_url' => null,
                'is_featured' => true,
                'views' => 0,
                'available_from' => '2026-05-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Propriété 5 - Villa à louer à Angré
            [
                'category_id' => 7,
                'title' => 'Villa 4 chambres à Angré - Château',
                'slug' => 'villa-4-chambres-a-angre-chateau-5',
                'description' => 'Belle villa familiale de 250m² avec jardin, à louer à Angré.',
                'long_description' => 'Villa spacieuse située dans le quartier résidentiel d\'Angré. Elle comprend 4 chambres, 3 salles de bain, un grand salon, une cuisine équipée, un jardin avec espace de jeux, et un parking pour 2 voitures. Environnement calme et sécurisé.',
                'price' => 800000,
                'surface' => 250.00,
                'rooms' => 6,
                'bedrooms' => 4,
                'bathrooms' => 3,
                'garage' => 2,
                'city' => 'Abidjan',
                'neighborhood' => 'Angré Château',
                'address' => 'Rue des jardins',
                'postal_code' => '08 BP 3456',
                'country' => 'Côte d\'Ivoire',
                'type' => 'house',
                'transaction_type' => 'rent',
                'status' => 'published',
                'features' => json_encode([
                    'jardin', 'parking', 'climatisation', 'garde', 'meublé'
                ]),
                'images' => json_encode([
                    'properties/villa-angre-1.jpg',
                    'properties/villa-angre-2.jpg',
                    'properties/villa-angre-3.jpg',
                ]),
                'video_url' => null,
                'virtual_tour_url' => null,
                'is_featured' => false,
                'views' => 0,
                'available_from' => '2026-04-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Propriété 6 - Studio à louer à Cocody
            [
                'category_id' => 6,
                'title' => 'Studio meublé à Cocody - 2 Plateaux',
                'slug' => 'studio-meuble-a-cocody-2-plateaux-6',
                'description' => 'Studio moderne entièrement meublé, idéal pour étudiant ou jeune professionnel.',
                'long_description' => 'Studio de 35m² situé dans une résidence sécurisée aux 2 Plateaux. Entièrement meublé et équipé (climatisation, machine à laver, frigo, lit). Parfait pour un célibataire. Proche de l\'université et des commodités.',
                'price' => 250000,
                'surface' => 35.00,
                'rooms' => 1,
                'bedrooms' => 1,
                'bathrooms' => 1,
                'garage' => 0,
                'city' => 'Abidjan',
                'neighborhood' => 'Cocody 2 Plateaux',
                'address' => 'Rue des universités',
                'postal_code' => '08 BP 7890',
                'country' => 'Côte d\'Ivoire',
                'type' => 'apartment',
                'transaction_type' => 'rent',
                'status' => 'published',
                'features' => json_encode([
                    'meublé', 'climatisation', 'résidence sécurisée', 'ascenseur'
                ]),
                'images' => json_encode([
                    'properties/studio-cocody-1.jpg',
                ]),
                'video_url' => null,
                'virtual_tour_url' => null,
                'is_featured' => false,
                'views' => 0,
                'available_from' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Propriété 7 - Immeuble à Treichville
            [
                'category_id' => 8,
                'title' => 'Immeuble R+3 à Treichville',
                'slug' => 'immeuble-r3-a-treichville-7',
                'description' => 'Immeuble de rapport avec 8 appartements, investissement rentable.',
                'long_description' => 'Immeuble de 4 niveaux comprenant 8 appartements (2 F2, 4 F3, 2 F4). Idéal pour investissement locatif. Revenus locatifs mensuels estimés à 2,5 millions FCFA. L\'immeuble est en bon état et bien entretenu.',
                'price' => 450000000,
                'surface' => 800.00,
                'rooms' => 24,
                'bedrooms' => 16,
                'bathrooms' => 8,
                'garage' => 2,
                'city' => 'Abidjan',
                'neighborhood' => 'Treichville',
                'address' => 'Avenue 15',
                'postal_code' => '01 BP 2345',
                'country' => 'Côte d\'Ivoire',
                'type' => 'commercial',
                'transaction_type' => 'sale',
                'status' => 'published',
                'features' => json_encode([
                    'ascenseur', 'groupe électrogène', 'garde', '8 appartements'
                ]),
                'images' => json_encode([
                    'properties/immeuble-treichville-1.jpg',
                    'properties/immeuble-treichville-2.jpg',
                ]),
                'video_url' => null,
                'virtual_tour_url' => null,
                'is_featured' => true,
                'views' => 0,
                'available_from' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Propriété 8 - Villa haut standing à Bingerville
            [
                'category_id' => 1,
                'title' => 'Villa haut standing à Bingerville',
                'slug' => 'villa-haut-standing-a-bingerville-8',
                'description' => 'Villa architecturale avec vue sur mer, 6 chambres, piscine, salle de sport.',
                'long_description' => 'Villa d\'exception située sur les hauteurs de Bingerville avec une vue imprenable sur l\'océan. Architecture contemporaine, matériaux nobles, finitions de luxe. Surface de 500m² sur un terrain de 2000m². Comprend 6 chambres suite, salle de sport, hammam, piscine à débordement, grand jardin tropical.',
                'price' => 650000000,
                'surface' => 500.00,
                'rooms' => 10,
                'bedrooms' => 6,
                'bathrooms' => 6,
                'garage' => 6,
                'city' => 'Bingerville',
                'neighborhood' => 'Plateau',
                'address' => 'Route de Bingerville',
                'postal_code' => 'BP 123',
                'country' => 'Côte d\'Ivoire',
                'type' => 'house',
                'transaction_type' => 'sale',
                'status' => 'published',
                'features' => json_encode([
                    'piscine', 'salle de sport', 'hammam', 'vue mer', 'jardin',
                    'groupe électrogène', 'forage', 'alarme', 'domotique'
                ]),
                'images' => json_encode([
                    'properties/villa-bingerville-1.jpg',
                    'properties/villa-bingerville-2.jpg',
                    'properties/villa-bingerville-3.jpg',
                    'properties/villa-bingerville-4.jpg',
                ]),
                'video_url' => 'https://www.youtube.com/watch?v=example2',
                'virtual_tour_url' => null,
                'is_featured' => true,
                'views' => 0,
                'available_from' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Propriété 9 - Appartement à louer à Abobo
            [
                'category_id' => 2,
                'title' => 'Appartement F3 à Abobo - Kennedy',
                'slug' => 'appartement-f3-a-abobo-kennedy-9',
                'description' => 'Bel appartement familial de 95m², calme et spacieux.',
                'long_description' => 'Appartement F3 situé dans une résidence calme à Abobo Kennedy. 2 chambres, salon, cuisine, salle de bain, WC invités. Environnement sécurisé, proche des transports et commerces.',
                'price' => 350000,
                'surface' => 95.00,
                'rooms' => 3,
                'bedrooms' => 2,
                'bathrooms' => 1,
                'garage' => 1,
                'city' => 'Abidjan',
                'neighborhood' => 'Abobo Kennedy',
                'address' => 'Rue 45',
                'postal_code' => '02 BP 4567',
                'country' => 'Côte d\'Ivoire',
                'type' => 'apartment',
                'transaction_type' => 'rent',
                'status' => 'published',
                'features' => json_encode([
                    'climatisation', 'parking', 'résidence calme'
                ]),
                'images' => json_encode([
                    'properties/appart-abobo-1.jpg',
                ]),
                'video_url' => null,
                'virtual_tour_url' => null,
                'is_featured' => false,
                'views' => 0,
                'available_from' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Propriété 10 - Terrain à Grand-Bassam
            [
                'category_id' => 3,
                'title' => 'Terrain de 1500m² à Grand-Bassam',
                'slug' => 'terrain-de-1500m2-a-grand-bassam-10',
                'description' => 'Superbe terrain en bord de mer, idéal pour résidence secondaire.',
                'long_description' => 'Terrain exceptionnel de 1500m² situé à Grand-Bassam, face à l\'océan. Idéal pour la construction d\'une résidence secondaire ou d\'un hôtel boutique. Zone en plein développement touristique.',
                'price' => 45000000,
                'surface' => 1500.00,
                'rooms' => 0,
                'bedrooms' => 0,
                'bathrooms' => 0,
                'garage' => 0,
                'city' => 'Grand-Bassam',
                'neighborhood' => 'Bord de mer',
                'address' => 'Route de l\'aéroport',
                'postal_code' => 'BP 456',
                'country' => 'Côte d\'Ivoire',
                'type' => 'land',
                'transaction_type' => 'sale',
                'status' => 'published',
                'features' => json_encode([
                    'bord de mer', 'viabilisé', 'titre foncier', 'vue mer'
                ]),
                'images' => json_encode([
                    'properties/terrain-bassam-1.jpg',
                ]),
                'video_url' => null,
                'virtual_tour_url' => null,
                'is_featured' => false,
                'views' => 0,
                'available_from' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insertion directe sans passer par le modèle pour éviter les problèmes de boot
        foreach ($properties as $propertyData) {
            Property::create($propertyData);
        }

        $this->command->info('10 propriétés ont été ajoutées avec succès!');
    }
}
