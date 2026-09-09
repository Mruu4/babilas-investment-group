<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\AgricultureProject;
use App\Models\TechnologyProject;
use App\Models\Automobile;
use App\Models\Investment;
use App\Models\Advertisement;
use App\Models\NewsPost;
use App\Models\Enquiry;

class DashboardController extends Controller
{
    public function index()
    {
        $propertyStatus = Property::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');
        $agricultureStatus = AgricultureProject::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');
        $technologyStatus = TechnologyProject::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');
        $automobileStatus = Automobile::selectRaw('availability, count(*) as total')->groupBy('availability')->pluck('total', 'availability');
        $investmentStatus = Investment::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');
        $adStatus = Advertisement::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');
        $newsStatus = NewsPost::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');

        $cards = [
            [
                'label' => 'Total Properties',
                'value' => Property::count(),
                'subValue' => ($propertyStatus['Available'] ?? 0) . ' Available',
                'note' => collect($propertyStatus)->map(fn ($v, $k) => "{$v} {$k}")->implode(' · ') ?: 'No records yet',
                'icon' => 'building-2',
                'color' => 'sky',
                'href' => route('admin.properties.index'),
            ],
            [
                'label' => 'Agriculture Projects',
                'value' => AgricultureProject::count(),
                'subValue' => ($agricultureStatus['Active'] ?? 0) . ' Active',
                'note' => collect($agricultureStatus)->map(fn ($v, $k) => "{$v} {$k}")->implode(' · ') ?: 'No records yet',
                'icon' => 'sprout',
                'color' => 'emerald',
                'href' => '#',
            ],
            [
                'label' => 'Technology Projects',
                'value' => TechnologyProject::count(),
                'subValue' => ($technologyStatus['Active'] ?? 0) . ' Active',
                'note' => collect($technologyStatus)->map(fn ($v, $k) => "{$v} {$k}")->implode(' · ') ?: 'No records yet',
                'icon' => 'cpu',
                'color' => 'violet',
                'href' => '#',
            ],
            [
                'label' => 'Automobiles',
                'value' => Automobile::count(),
                'subValue' => ($automobileStatus['Available'] ?? 0) . ' Available',
                'note' => collect($automobileStatus)->map(fn ($v, $k) => "{$v} {$k}")->implode(' · ') ?: 'No records yet',
                'icon' => 'car',
                'color' => 'orange',
                'href' => '#',
            ],
            [
                'label' => 'Investment Holdings',
                'value' => Investment::count(),
                'subValue' => ($investmentStatus['Active'] ?? 0) . ' Active',
                'note' => collect($investmentStatus)->map(fn ($v, $k) => "{$v} {$k}")->implode(' · ') ?: 'No records yet',
                'icon' => 'trending-up',
                'color' => 'gold',
                'href' => '#',
            ],
            [
                'label' => 'Active Advertisements',
                'value' => $adStatus['Active'] ?? 0,
                'subValue' => ($adStatus['Scheduled'] ?? 0) . ' Scheduled',
                'note' => collect($adStatus)->map(fn ($v, $k) => "{$v} {$k}")->implode(' · ') ?: 'No records yet',
                'icon' => 'megaphone',
                'color' => 'pink',
                'href' => '#',
            ],
            [
                'label' => 'News Articles',
                'value' => NewsPost::count(),
                'subValue' => ($newsStatus['Published'] ?? 0) . ' Published',
                'note' => collect($newsStatus)->map(fn ($v, $k) => "{$v} {$k}")->implode(' · ') ?: 'No records yet',
                'icon' => 'file-text',
                'color' => 'cyan',
                'href' => '#',
            ],
            [
                'label' => 'New Enquiries',
                'value' => Enquiry::where('is_read', false)->count(),
                'subValue' => 'Unread',
                'note' => Enquiry::where('is_read', false)->count() > 0 ? 'Requires attention' : 'All caught up',
                'icon' => 'message-square',
                'color' => 'red',
                'href' => '#',
                'alert' => Enquiry::where('is_read', false)->count() > 0,
            ],
        ];

        // Flat stats kept for the "get started" empty-state check
        $stats = [
            'properties' => Property::count(),
            'agriculture' => AgricultureProject::count(),
            'technology' => TechnologyProject::count(),
            'automobiles' => Automobile::count(),
            'investments' => Investment::count(),
            'active_ads' => $adStatus['Active'] ?? 0,
            'news_articles' => NewsPost::count(),
            'new_enquiries' => Enquiry::where('is_read', false)->count(),
        ];


        // Enquiries trend: last 6 months, real counts grouped by month
        $enquiriesTrend = collect(range(5, 0))->map(function ($monthsAgo) {
            $date = now()->startOfMonth()->subMonths($monthsAgo);
            return [
                'label' => $date->format('M'),
                'count' => Enquiry::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
            ];
        });

        // Investment distribution: real counts by category across content modules
        $distribution = [
            'Real Estate' => Property::count(),
            'Agriculture' => AgricultureProject::count(),
            'Technology' => TechnologyProject::count(),
            'Automobiles' => Automobile::count(),
            'Investments' => Investment::count(),
        ];

        // Recent activity: real latest records across modules, unified and sorted
        $activity = collect()
            ->concat(Property::latest()->take(5)->get()->map(fn ($p) => [
                'icon' => 'building-2', 'color' => 'sky',
                'action' => 'Property added', 'subject' => $p->name,
                'time' => $p->created_at, 'user' => $p->creator->name ?? 'System',
            ]))
            ->concat(Enquiry::latest()->take(5)->get()->map(fn ($e) => [
                'icon' => 'message-square', 'color' => 'red',
                'action' => 'New enquiry received', 'subject' => $e->full_name . ' — ' . $e->area_of_interest,
                'time' => $e->created_at, 'user' => 'System',
            ]))
            ->sortByDesc('time')
            ->take(7)
            ->values();

        return view('dashboard', compact('stats', 'cards', 'enquiriesTrend', 'distribution', 'activity'));
    }
}
