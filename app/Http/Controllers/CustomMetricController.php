<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomMetric;
use Illuminate\Support\Facades\Auth;

class CustomMetricController extends Controller
{
    public function index(){

        $metrics = CustomMetric::where('user_id', Auth::id())->get();
        return view('custom_metrics.index', compact('metrics'));

    }

    public function create(){
        return view('custom_metrics.create');
    }

    public function store(Request $request){

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();

        CustomMetric::create($validated);

        return redirect()->route('custom_metrics.index')->with('success', 'Custom metric created successfully.');
    }

    public function destroy(CustomMetric $customMetric){

        if($customMetric->user_id != Auth::id()){
            abort(403);
        }

        $customMetric->delete();

        return redirect()->route('custom_metrics.index')->with('success', 'Custom metric deleted successfully.');
    }
}
