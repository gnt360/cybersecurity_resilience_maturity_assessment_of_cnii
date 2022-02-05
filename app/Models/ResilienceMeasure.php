<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResilienceMeasure extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'rc_id', 'order'];

    public function resilienceControl(){
        $this->belongsTo(ResilienceControl::class, 'rc_id');
    }

    public function resilienceMeasureScales()
    {
        return $this->hasMany(ResilienceMeasureScale::class);
    }

    public function resilienceMeasureScalesByName()
    {
        return $this->hasMany(ResilienceMeasureScale::class)->orderBy('name');
    }

    public function resilienceMeasureResponses()
    {
        return $this->hasMany(ResilienceMeasureResponse::class);
    }
}
