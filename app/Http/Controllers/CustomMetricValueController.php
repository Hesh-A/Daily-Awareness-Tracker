<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomMetric;
use App\Models\CustomMetricValue;
use Illuminate\Support\Facades\Auth;

class CustomMetricValueController extends Controller
{
    public function store(Request $request){

        $validated = $request->validate([
            'daily_entry_id' => 'required|integer|exists:daily_entries,id',
            'custom_metric_id' => 'required|integer|exists:custom_metrics,id',
            'value' => 'required|integer|min:0',
        ]);

        $metric = CustomMetric::findOrFail($validated['custom_metric_id']);
        if ($metric->user_id !== Auth::id()) {
            abort(403);
        }

        CustomMetricValue::updateOrCreate(
            [
                'daily_entry_id' => $validated['daily_entry_id'],
                'custom_metric_id' => $validated['custom_metric_id'],
            ],
            [
                'value' => $validated['value'],
            ]
        );

        return back()->with('success', 'Metric value saved.');
    }
}
