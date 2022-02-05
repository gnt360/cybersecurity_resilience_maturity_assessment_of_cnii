<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResilienceFunction extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'rtd_id'];


    public function resilienceTemporalDimension(){
        $this->belongsTo(ResilienceTemporalDimension::class, 'rtd_id');
    }

    public function resilienceFunctionCategorys()
    {
        return $this->hasMany(ResilienceFunctionCategory::class);
    }

    public function resilienceFunctionCategorysByName()
    {
        return $this->hasMany(ResilienceFunctionCategory::class)->orderBy('name');
    }
}
