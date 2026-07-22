<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomMetricValue extends Model
{
    protected $fillable = [
        'custom_metric_id',
        'daily_entry_id',
        'value',
    ];

    public function customMetric()
    {
        return $this->belongsTo(CustomMetric::class);
    }

    public function dailyEntry()
    {
        return $this->belongsTo(DailyEntry::class);
    }
}
