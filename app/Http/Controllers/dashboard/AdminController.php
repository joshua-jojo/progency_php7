<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Agen;
use App\Models\Developer;
use App\Models\Perumahan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $master = [
            'total_perumahan' => Perumahan::count(),
            'perumahan_tersedia' => Perumahan::where('status', 'tersedia')->count(),
            'perumahan_terjual' => Perumahan::where('status', 'sold')->count(),
            'perumahan_booking' => Perumahan::where('status', 'dp')->count(),
            'agen' => Agen::count(),
            'developer' => Developer::count(),
        ];
        return inertia()->render('dashboard/admin', compact('master'));
    }
}
