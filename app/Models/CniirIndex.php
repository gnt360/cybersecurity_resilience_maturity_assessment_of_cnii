<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CniirIndex extends Model
{
    use HasFactory;

    protected $fillable = ['org_id', 'quadrant_id', 'score', 'user_id'];


    public function organisation(){
       return $this->belongsTo(Organisation::class, 'org_id');
    }

    public function quadrant(){
        return $this->belongsTo(Quadrant::class, 'quadrant_id');
     }


}
