<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\CustomMetric;
use Illuminate\Support\Facades\Auth;

class CustomMetricController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        CustomMetric::create($validated);

        return redirect('/custom-metrics');
    }

    public function create()
    {
      
      return view('custom_metrics.create');
     
    }

    public function index()
    {

        $metrics = CustomMetric::where('user_id', Auth::id())->get();

        return view('custom_metrics.index', compact('metrics'));
    }


    public function destroy(CustomMetric $metric)
    {
       if ($metric->user_id !== Auth::id()) {
            abort(403);
        }

        $metric->delete();

        return redirect()->route('custom-metrics.index')->with('success', 'Custom metric deleted successfully.');
        
    }

    public function update(Request $request, CustomMetric $metric)
    {

        if ($metric->user_id !== Auth::id()){
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $metric->update($validated);

        return redirect()->route('custom-metrics.index')->with('success', 'Custom metric updated successfully.');

    }

}
