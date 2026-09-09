<?php

namespace App\View\Composers;

use App\Models\Advertisement;
use App\Models\Enquiry;
use App\Models\ContactMessage;
use Illuminate\View\View;

class AdminNavComposer
{
    public function compose(View $view): void
    {
        $view->with('navBadges', [
            'advertisements' => Advertisement::where('status', 'Active')->count(),
            'enquiries' => Enquiry::where('is_read', false)->count(),
            'contact_messages' => ContactMessage::where('is_read', false)->count(),
        ]);
    }
}
