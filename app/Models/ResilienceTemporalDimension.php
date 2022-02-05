<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResilienceTemporalDimension extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public $timestamps = false;

    public function resilienceFunctions()
    {
        return $this->hasMany(ResilienceFunction::class);
    }

    public function resilienceFunctionsByName()
    {
        return $this->hasMany(ResilienceFunction::class)->orderBy('name');
    }
}
