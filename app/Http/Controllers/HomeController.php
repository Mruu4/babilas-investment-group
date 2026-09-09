<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\AgricultureProject;
use App\Models\TechnologyProject;
use App\Models\Automobile;
use App\Models\Investment;
use App\Models\Advertisement;
use App\Models\NewsPost;

class HomeController extends Controller
{
    public function index()
    {
        $propertyCount = Property::count();
        $agricultureCount = AgricultureProject::count();
        $technologyCount = TechnologyProject::count();
        $automobileCount = Automobile::count();
        $investmentCount = Investment::count();

        $totalActive = $propertyCount + $agricultureCount + $technologyCount + $automobileCount + $investmentCount;

        $investmentAreas = [
            [
                'icon' => 'building-2', 'label' => 'Real Estate', 'tagline' => 'Premium Properties',
                'description' => 'Residential developments, commercial spaces, and luxury properties across prime Nigerian locations.',
                'href' => '/real-estate', 'count' => $propertyCount, 'countLabel' => 'Properties',
                'color' => 'text-sky-500', 'bg' => 'bg-sky-50', 'border' => 'border-sky-200',
            ],
            [
                'icon' => 'sprout', 'label' => 'Agriculture', 'tagline' => 'Food & Agri-Business',
                'description' => 'Crop production, livestock farming, agro-processing, and agricultural development projects.',
                'href' => '/agriculture', 'count' => $agricultureCount, 'countLabel' => 'Projects',
                'color' => 'text-emerald-500', 'bg' => 'bg-emerald-50', 'border' => 'border-emerald-200',
            ],
            [
                'icon' => 'cpu', 'label' => 'Technology', 'tagline' => 'Digital Innovation',
                'description' => 'Software platforms, FinTech solutions, AI ventures, and digital services transforming industries.',
                'href' => '/technology', 'count' => $technologyCount, 'countLabel' => 'Ventures',
                'color' => 'text-violet-500', 'bg' => 'bg-violet-50', 'border' => 'border-violet-200',
            ],
            [
                'icon' => 'car', 'label' => 'Automobiles', 'tagline' => 'Premium Vehicles',
                'description' => 'Curated selection of premium, luxury, and commercial vehicles with financing solutions.',
                'href' => '/automobiles', 'count' => $automobileCount, 'countLabel' => 'Vehicles',
                'color' => 'text-orange-500', 'bg' => 'bg-orange-50', 'border' => 'border-orange-200',
            ],
            [
                'icon' => 'trending-up', 'label' => 'Stocks & Investments', 'tagline' => 'Portfolio Management',
                'description' => 'Diversified equity holdings and structured financial instruments delivering long-term value.',
                'href' => '/investments', 'count' => $investmentCount, 'countLabel' => 'Holdings',
                'color' => 'text-big-gold-dark', 'bg' => 'bg-big-gold/10', 'border' => 'border-big-gold-dark/20',
            ],
        ];

        $stats = [
            ['icon' => 'building-2', 'value' => $totalActive . '+', 'label' => 'Active Projects', 'sublabel' => 'Across 5 sectors', 'color' => 'text-big-gold-light'],
            ['icon' => 'map-pin', 'value' => '2', 'label' => 'Cities', 'sublabel' => 'Abuja & Lagos', 'color' => 'text-sky-400'],
            ['icon' => 'award', 'value' => '10+', 'label' => 'Years of Growth', 'sublabel' => 'Building value since inception', 'color' => 'text-emerald-400'],
            ['icon' => 'users', 'value' => '200+', 'label' => 'Partners & Clients', 'sublabel' => 'Trusted relationships', 'color' => 'text-violet-400'],
        ];

        $featuredProperties = Property::with('images')->where('is_featured', true)->latest()->take(3)->get();
        if ($featuredProperties->isEmpty()) {
            $featuredProperties = Property::with('images')->latest()->take(3)->get();
        }

        $activeAd = Advertisement::where('status', 'Active')
            ->where(function ($q) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', now());
            })
            ->orderByDesc('priority')
            ->first();

        $newsArticles = NewsPost::where('status', 'Published')->latest('published_at')->take(3)->get();

        return view('home', compact(
            'investmentAreas', 'stats', 'featuredProperties', 'activeAd', 'newsArticles', 'totalActive'
        ));
    }
}
