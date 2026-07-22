<?php

namespace App\Http\Controllers;
use App\Models\DailyEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function index()
{
    $entries = DailyEntry::where('user_id', Auth::id())
    ->with('metricValues.customMetric')
    ->orderBy('entry_date', 'desc')
    ->get();

    $latestEntry = $entries->first();


    return view('dashboard.dashboard', compact('latestEntry'));
}

}
