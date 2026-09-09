<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\TechnologyProject;
use App\Models\User;

class TechnologyProjectSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = User::where('email', 'admin@babilas.test')->value('id');

        $projects = [
            [
                'name' => 'PayFlow Africa',
                'sector' => 'FinTech',
                'description' => 'PayFlow Africa delivers robust payment infrastructure and API-driven transaction routing designed to streamline B2B settlements across West Africa. The platform addresses liquidity bottlenecks by enabling instant cross-border clearing and real-time merchant payouts.',
                'investment_stage' => 'Series A',
                'investment_information' => 'Babilas Investment Group supports PayFlow Africa in expanding its core engineering capacity and deepening regulatory compliance frameworks across key regional corridors. Strategic involvement focuses on scaling enterprise merchant acquisition and strengthening security architecture.',
                'website' => 'https://www.payflowafrica-demo.ng',
                'status' => 'Active',
                'is_featured' => true,
                'image' => 'technology-1.jpeg',
            ],
            [
                'name' => 'AgriData Intelligence',
                'sector' => 'Artificial Intelligence',
                'description' => 'AgriData Intelligence deploys proprietary machine learning models and satellite imaging analytics to optimize smallholder agricultural supply chains and crop yields. By transforming raw meteorological data into actionable forecasting, the platform minimizes post-harvest losses and empowers agribusinesses.',
                'investment_stage' => 'Seed',
                'investment_information' => 'Our investment focuses on accelerating algorithmic model training cycles, expanding field deployment across key agricultural belts in Nigeria, and establishing strategic enterprise data-sharing partnerships.',
                'website' => 'https://www.agridataintel-demo.ng',
                'status' => 'Active',
                'is_featured' => true,
                'image' => 'technology-2.jpeg',
            ],
            [
                'name' => 'SwiftLogix Nigeria',
                'sector' => 'E-commerce',
                'description' => 'SwiftLogix operates an integrated fulfillment and last-mile delivery network optimized for high-density urban centers in Nigeria. Through automated dispatch algorithms and dynamic route planning, the company significantly reduces delivery turnaround times for digital retailers.',
                'investment_stage' => 'Series B',
                'investment_information' => 'Babilas Investment Group collaborates with management to scale warehouse automation technology, expand geographic routing coverage across major metropolitan hubs, and integrate merchant inventory management systems.',
                'website' => 'https://www.swiftlogix-demo.ng',
                'status' => 'Active',
                'is_featured' => false,
                'image' => 'technology-3.jpeg',
            ],
            [
                'name' => 'HealthCloud West Africa',
                'sector' => 'Digital Services',
                'description' => 'HealthCloud provides a secure, cloud-based electronic medical records and telemedicine platform connecting urban specialists with regional clinics. The interoperable system standardizes patient data management and enhances diagnostic accuracy across underserved care networks.',
                'investment_stage' => 'Growth',
                'investment_information' => 'Strategic guidance centers on institutional healthcare provider onboarding, bolstering data privacy protocols to meet international standards, and expanding network integration with major HMOs.',
                'website' => 'https://www.healthcloud-demo.ng',
                'status' => 'Active',
                'is_featured' => false,
                'image' => 'technology-4.jpeg',
            ],
            [
                'name' => 'EduTech Solutions Nigeria',
                'sector' => 'Software',
                'description' => 'EduTech Solutions builds scalable learning management systems and vocational training portals tailored for secondary and tertiary institutions in Nigeria. The platform facilitates remote examinations, curriculum delivery, and skills tracking for thousands of active students.',
                'investment_stage' => 'Seed',
                'investment_information' => 'Babilas Investment Group supports product expansion, cloud infrastructure optimization, and partnership development with educational regulatory bodies.',
                'website' => 'https://www.edutechsolutions-demo.ng',
                'status' => 'Planned',
                'is_featured' => false,
                'image' => 'technology-1.jpeg',
            ],
        ];

        foreach ($projects as $data) {
            $imageFile = $data['image'];
            unset($data['image']);

            $data['slug'] = Str::slug($data['name']) . '-' . uniqid();
            $data['created_by'] = $adminId;

            $project = TechnologyProject::firstOrCreate(
                ['name' => $data['name']],
                $data
            );

            if ($project->media()->count() === 0) {
                $project->media()->create([
                    'path' => 'technology/' . $imageFile,
                    'type' => 'image',
                    'is_primary' => true,
                    'sort_order' => 0,
                ]);
            }
        }
    }
}
