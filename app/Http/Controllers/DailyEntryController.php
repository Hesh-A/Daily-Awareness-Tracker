<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyEntry;
use App\Models\CustomMetric;
use App\Models\CustomMetricValue;
use Illuminate\Support\Facades\Auth;

class DailyEntryController extends Controller
{
    public function index()
    {
        $entries = DailyEntry::where('user_id', Auth::id())
            ->with('metricValues.customMetric')
            ->orderBy('entry_date', 'desc')
            ->get();

        return view('daily_entries.index', compact('entries'));
    }

    public function create()
    {
        $customMetrics = CustomMetric::where('user_id', Auth::id())->get();

        return view('daily_entries.create', compact('customMetrics'));

    }

    public function show(DailyEntry $entry) 
    {

       $entry->load('metricValues.customMetric');

        return view('daily_entries.show', [
        'entry' => $entry
         ]);
    }

    public function store(Request $request)
    {
      
        $validated = $request->validate([
            'entry_date' => 'required|date',
            'hours_creative_work' => 'required|integer|min:0|max:24',
            'quality_score' => 'required|integer|min:-2|max:2',
            'notes' => 'nullable|string',
            'customMetrics' => 'nullable|array',
            'customMetrics.*' => 'nullable|integer|min:0',
        ]);

        $validated['user_id'] = Auth::id();

        $entry = DailyEntry::create([
            'user_id' => Auth::id(),
            'entry_date' => $validated['entry_date'],
            'hours_creative_work' => $validated['hours_creative_work'],
            'quality_score' => $validated['quality_score'],
            'notes' => $validated['notes'] ?? null,
        ]);

        foreach ($request->customMetrics ?? [] as $metricId => $value) {
          if ($value !== null) {
            $entry->metricValues()->updateOrCreate(
                ['custom_metric_id' => $metricId],
                ['value' => $value]
            );
          }
        }


        return redirect()->route('daily-entries.index')->with('success', 'Daily entry created successfully.');
      
    }

    public function edit(DailyEntry $entry)
    {

         $customMetrics = CustomMetric::where('user_id', Auth::id())->get();
    
         $entry->load('metricValues');

        return view('daily_entries.edit', [
          'entry' => $entry,
          'customMetrics' => $customMetrics
    ]);
    }

    public function destroy(DailyEntry $entry)
    {
        if ($entry->user_id !== Auth::id()) {
            abort(403);
        }

        $entry->delete();

        return redirect()->route('daily-entries.index')->with('success', 'Daily entry deleted successfully.');
    }

    public function update(Request $request, DailyEntry $entry)
    {
        if ($entry->user_id !== Auth::id()){
            abort(403);
        }

        $validated = $request->validate([
            'entry_date' => 'required|date',
            'hours_creative_work' => 'required|integer|min:0|max:24',
            'quality_score' => 'required|integer|min:-2|max:2',
            'notes' => 'nullable|string',
            'customMetrics' => 'nullable|array',
            'customMetrics.*' => 'nullable|integer|min:0'
        ]);

        $entry->update($validated);

        foreach ($request->customMetrics ?? [] as $metricId => $value) {
          if ($value !== null) {
            $entry->metricValues()->updateOrCreate(
                ['custom_metric_id' => $metricId],
                ['value' => $value]
            );
          }
        }


       

        return redirect()->route('daily-entries.index')->with('success', 'Daily entry updated successfully.');
    }
}
