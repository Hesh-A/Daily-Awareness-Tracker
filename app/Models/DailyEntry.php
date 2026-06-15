<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'entry_date',
        'hours_creative_work',
        'quality_score',
        'notes',

    ];

    public function user(){

        return $this->belongsTo(User::class);
    }


    public function metricValues()
    {

    return $this->hasMany(CustomMetricValue::class);

    }

}
