<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\AgricultureProject;
use App\Models\User;

class AgricultureProjectSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = User::where('email', 'admin@babilas.test')->value('id');

        $projects = [
            [
                'name' => 'Kaduna Valley Rice Initiative',
                'location' => 'Kaduna State',
                'agriculture_type' => 'Crop Production',
                'description' => 'This large-scale rice cultivation project aims to enhance national food security by utilizing modern, mechanized farming techniques on premium alluvial soil. The initiative focuses on high-yield varieties and robust supply chain integration.',
                'investment_information' => 'Spanning 2,000 hectares of irrigable land in the Kaduna River basin, the project implements pivot irrigation and advanced seed technology to achieve multiple harvest cycles per year. The investment covers machinery, irrigation infrastructure, and post-harvest storage solutions.',
                'status' => 'Active',
                'is_featured' => true,
                'image' => 'agriculture-3.jpeg',
            ],
            [
                'name' => 'Kano Integrated Poultry Farm',
                'location' => 'Kano State',
                'agriculture_type' => 'Livestock',
                'description' => 'This project established a modern, climate-controlled poultry operation to meet the rising urban demand for high-quality animal protein in Northern Nigeria. It incorporates sustainable waste-to-energy solutions and bio-security protocols.',
                'investment_information' => 'The facility features four large-scale, automated broiler houses with a combined capacity of 200,000 birds per cycle. Investment includes hatchery operations, feed mill production, and cold-chain logistics for distribution to regional markets.',
                'status' => 'Active',
                'is_featured' => true,
                'image' => 'agriculture-1.jpeg',
            ],
            [
                'name' => 'Benue Agro-Processing Hub',
                'location' => 'Benue State',
                'agriculture_type' => 'Agro-processing',
                'description' => 'Strategically located in Nigeria\'s "Food Basket," this hub adds value to local fruit and tuber production, reducing post-harvest losses and creating processed products for domestic consumption and export.',
                'investment_information' => 'The complex houses processing lines for cassava flour and concentrated fruit juice. The investment includes 1,500 metric tons of silo storage, industrial-grade peeling and drying equipment, and a 2-megawatt dedicated power solution.',
                'status' => 'Completed',
                'is_featured' => false,
                'image' => 'agriculture-2.jpeg',
            ],
            [
                'name' => 'Niger State Commercial Maize Farm',
                'location' => 'Niger State',
                'agriculture_type' => 'Crop Production',
                'description' => 'A premier investment in broad-acre commercial cereal production, focusing on utilizing drone technology and precision agriculture to maximize efficiency and optimize input management in the central Guinea Savanna zone.',
                'investment_information' => 'The project encompasses 3,500 hectares of rain-fed maize cultivation, complemented by supplemental center-pivot irrigation for off-season resilience. The investment supports grain drying facilities and partnerships with regional feed manufacturers.',
                'status' => 'Active',
                'is_featured' => false,
                'image' => 'agriculture-4.jpeg',
            ],
            [
                'name' => 'Cross River Palm Oil Plantation Development',
                'location' => 'Cross River State',
                'agriculture_type' => 'Agricultural Development',
                'description' => 'This long-term developmental project is establishing sustainable palm oil plantations and an integrated milling facility, reviving a critical regional commodity sector while ensuring adherence to environmental and community best practices.',
                'investment_information' => 'The project is progressively developing 5,000 hectares of high-yield palm trees. The planned investment covers the complete cycle: from nursing seedlings and plantation infrastructure to the construction of a state-of-the-art 30-ton-per-hour crude palm oil (CPO) extraction mill.',
                'status' => 'Planned',
                'is_featured' => false,
                'image' => 'agriculture-5.jpeg',
            ],
        ];

        foreach ($projects as $data) {
            $imageFile = $data['image'];
            unset($data['image']);

            $data['slug'] = Str::slug($data['name']) . '-' . uniqid();
            $data['created_by'] = $adminId;

            $project = AgricultureProject::firstOrCreate(
                ['name' => $data['name']],
                $data
            );

            if ($project->media()->count() === 0) {
                $project->media()->create([
                    'path' => 'agriculture/' . $imageFile,
                    'type' => 'image',
                    'is_primary' => true,
                    'sort_order' => 0,
                ]);
            }
        }
    }
}
