<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResilienceMeasureResponse extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'rm_id', 'rms_id', 'user_id'];

    public function resilienceMeasure(){
        $this->belongsTo(ResilienceMeasure::class, 'rm_id');
    }

    public function resilienceMeasureScale(){
        $this->belongsTo(ResilienceMeasureScale::class, 'rms_id');
    }

    public function user(){
        $this->belongsTo(User::class, 'user_id');
    }

}
