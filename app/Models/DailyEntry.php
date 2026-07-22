<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyEntry extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'hours_creative_work',
        'quality_score',
        'notes',
        'entry_date',
    ];

    public function user()
    {

       return $this->belongsTo(User::class);

    }

    public function metricValues()
    {
        return $this->hasMany(CustomMetricValue::class);
    }

}
