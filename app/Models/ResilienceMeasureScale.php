<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResilienceMeasureScale extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'rm_id', 'weight', 'order'];

    public function resilienceMeasure(){
        $this->belongsTo(ResilienceMeasure::class, 'rm_id');
    }

    public function resilienceMeasureResponses()
    {
        return $this->hasMany(ResilienceMeasureResponse::class);
    }

}
