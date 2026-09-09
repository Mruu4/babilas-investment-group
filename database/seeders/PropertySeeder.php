<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Property;
use App\Models\User;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $adminId = User::where('email', 'admin@babilas.test')->value('id');

        $properties = [
            [
                'name' => 'Maitama Heights Residence',
                'property_type' => 'Apartment',
                'location' => 'Maitama, Abuja',
                'price' => 450000000,
                'currency' => 'NGN',
                'description' => 'An epitome of luxury high-rise living situated in the heart of Abuja\'s most prestigious diplomatic district. This expansive apartment offers panoramic city views, bespoke contemporary interior finishes, and world-class amenities designed for discerning buyers.',
                'bedrooms' => 4,
                'bathrooms' => 5,
                'size' => '3,800 sqft',
                'features' => ['Heated Swimming Pool', '24/7 Concierge & Security', 'Integrated Solar Power Backup', 'Underground Private Parking'],
                'status' => 'Available',
                'is_featured' => true,
                'image' => 'property-1-maitama-heights.png',
            ],
            [
                'name' => 'The Imperial Waterfront Villa',
                'property_type' => 'House',
                'location' => 'Ikoyi, Lagos',
                'price' => 1850000,
                'currency' => 'USD',
                'description' => 'Nestled along the serene shores of Ikoyi, this ultra-exclusive waterfront estate seamlessly blends indoor and outdoor tropical living. Featuring floor-to-ceiling glass paneling, a private jetty, and open-concept entertainment lounges, it represents coastal luxury at its absolute finest.',
                'bedrooms' => 5,
                'bathrooms' => 6,
                'size' => '6,200 sqft',
                'features' => ['Private Boat Jetty', 'Infinity Edge Pool', 'Smart Home Automation', 'Private Cinema Room'],
                'status' => 'Available',
                'is_featured' => true,
                'image' => 'property-2-imperial-waterfront.png',
            ],
            [
                'name' => 'Zenith Financial Tower',
                'property_type' => 'Commercial',
                'location' => 'Victoria Island, Lagos',
                'price' => 12000000,
                'currency' => 'USD',
                'description' => 'A state-of-the-art Grade-A commercial tower strategic to the commercial pulse of Lagos. Designed with high-performance energy-efficient glass facades, flexible open-floor office layouts, and top-tier infrastructure for corporate headquarters and multinational enterprises.',
                'bedrooms' => null,
                'bathrooms' => null,
                'size' => '45,000 sqft',
                'features' => ['High-Speed Passenger Elevators', 'Fibre-Optic Connectivity', 'Multi-Tier Security Access', 'Rooftop Corporate Lounge'],
                'status' => 'Under Development',
                'is_featured' => false,
                'image' => 'property-3-zenith-tower.png',
            ],
            [
                'name' => 'Banana Island Sanctuary Duplex',
                'property_type' => 'House',
                'location' => 'Banana Island, Ikoyi, Lagos',
                'price' => 1200000000,
                'currency' => 'NGN',
                'description' => 'Situated within Nigeria\'s most secure gated community, this detached smart mansion boasts architectural sophistication and absolute privacy. Perfectly fitted with Italian marble finishes, expansive master suites, and a private wellness spa.',
                'bedrooms' => 5,
                'bathrooms' => 7,
                'size' => '5,500 sqft',
                'features' => ['Private Swimming Pool & Spa', 'Automated Biometric Security', "Fully Fitted Chef's Kitchen", '2-Room BQ'],
                'status' => 'Sold',
                'is_featured' => false,
                'image' => 'property-4-banana-island.png',
            ],
            [
                'name' => 'The Guzape Vista Crest',
                'property_type' => 'House',
                'location' => 'Guzape, Abuja',
                'price' => 650000000,
                'currency' => 'NGN',
                'description' => 'Elevated atop the picturesque hills of Guzape, this striking contemporary cantilevered villa captures breathtaking vistas of the Federal Capital Territory skyline. An architectural masterpiece tailored for grand hosting and high-end living.',
                'bedrooms' => 4,
                'bathrooms' => 5,
                'size' => '4,100 sqft',
                'features' => ['Panoramic Terrace Deck', 'Solar Hybrid Energy Grid', 'Perimeter Motion Sensors', 'Landscaped Garden'],
                'status' => 'Coming Soon',
                'is_featured' => true,
                'image' => 'property-5-guzape-vista.png',
            ],
        ];

        foreach ($properties as $data) {
            $imageFile = $data['image'];
            unset($data['image']);

            $data['slug'] = Str::slug($data['name']) . '-' . uniqid();
            $data['created_by'] = $adminId;

            $property = Property::firstOrCreate(
                ['name' => $data['name']],
                $data
            );

            if ($property->images()->count() === 0) {
                $property->images()->create([
                    'path' => 'properties/' . $imageFile,
                    'is_primary' => true,
                    'sort_order' => 0,
                ]);
            }
        }
    }
}
