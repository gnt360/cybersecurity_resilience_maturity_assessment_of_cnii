<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResilienceFunctionCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'rf_id'];

    public function resilienceFunction(){
        return  $this->belongsTo(ResilienceFunction::class, 'rf_id');
    }

    public function resilienceControls()
    {
        return $this->hasMany(ResilienceControl::class);
    }

    public function resilienceControlsByName()
    {
        return $this->hasMany(ResilienceControl::class)->orderBy('name');
    }
}
