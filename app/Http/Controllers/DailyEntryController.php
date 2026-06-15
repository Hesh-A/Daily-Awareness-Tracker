<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyEntry;
use Illuminate\Support\Facades\Auth;

class DailyEntryController extends Controller
{
    public function index()
    {
        $entries = DailyEntry::where('user_id', Auth::id())
            ->with('metricValues')
            ->orderBy('entry_date', 'desc')
            ->get();

        return view('daily_entries.index', compact('entries'));
    }

    public function create()
    {
        $metrics = auth()->user()->customMetrics;

        return view('daily_entries.create', compact('metrics'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'entry_date' => 'required|date',
            'hours_creative_work' => 'required|integer|min:0|max:24',
            'quality_score' => 'required|integer|min:-2|max:2',
            'notes' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        $entry = DailyEntry::create($validated);

        if ($request->metrics) {
            foreach ($request->metrics as $metricId => $value) {
                if ($value !== null && $value !== '') {
                    $entry->metricValues()->create([
                        'custom_metric_id' => $metricId,
                        'value' => $value,
                    ]);
                }
            }
        }

        return redirect()
            ->route('daily_entries.index')
            ->with('success', 'Daily entry created successfully.');
    }

    public function edit(DailyEntry $dailyEntry)
    {
        if ($dailyEntry->user_id !== Auth::id()) {
            abort(403);
        }

        $dailyEntry->load('metricValues');
        $metrics = auth()->user()->customMetrics;

        return view('daily_entries.edit', compact('dailyEntry', 'metrics'));
    }

    public function update(Request $request, DailyEntry $dailyEntry)
    {
        if ($dailyEntry->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'entry_date' => 'required|date',
            'hours_creative_work' => 'required|integer|min:0|max:24',
            'quality_score' => 'required|integer|min:-2|max:2',
            'notes' => 'nullable|string',
        ]);

        $dailyEntry->update($validated);

        if ($request->metrics) {
            foreach ($request->metrics as $metricId => $value) {
                if ($value !== null && $value !== '') {
                    $dailyEntry->metricValues()->updateOrCreate(
                        ['custom_metric_id' => $metricId],
                        ['value' => $value]
                    );
                }
            }
        }

        return redirect()
            ->route('daily_entries.index')
            ->with('success', 'Daily entry updated successfully.');
    }

    public function destroy(DailyEntry $dailyEntry)
    {
        if ($dailyEntry->user_id !== Auth::id()) {
            abort(403);
        }

        $dailyEntry->delete();

        return redirect()
            ->route('daily_entries.index')
            ->with('success', 'Daily entry deleted successfully.');
    }
}
