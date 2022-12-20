<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CniirIndex extends Model
{
    use HasFactory;

    protected $fillable = ['org_id', 'quadrant_id', 'score', 'user_id', 'pre_event_rtd_score', 'during_event_rtd_score', 'post_event_rtd_score'];


    public function organisation(){
       return $this->belongsTo(Organisation::class, 'org_id');
    }

    public function quadrant(){
        return $this->belongsTo(Quadrant::class, 'quadrant_id');
     }


}
