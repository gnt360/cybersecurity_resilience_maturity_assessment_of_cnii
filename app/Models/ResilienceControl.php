<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResilienceControl extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'rfc_id'];


    public function resilienceFunctionCategory(){
       return $this->belongsTo(ResilienceFunctionCategory::class, 'rfc_id');
    }

    public function resilienceMeasures()
    {
        return $this->hasMany(ResilienceMeasure::class, 'rc_id');
    }

    public function resilienceMeasuresByName()
    {
        return $this->hasMany(ResilienceMeasure::class)->orderBy('name');
    }
}
