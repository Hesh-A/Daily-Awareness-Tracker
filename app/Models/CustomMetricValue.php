<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomMetricValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'daily_entry_id',
        'custom_metric_id',
        'value',
    ];

    public function dailyEntry(){

        return $this->belongsTo(DailyEntry::class);
    }

    public function metric()
    {
    return $this->belongsTo(CustomMetric::class);
    }

}
