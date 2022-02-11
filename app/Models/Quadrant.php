<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quadrant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'low_limit', 'upper_limit'];

    public function cniirIndexs()
    {
        return $this->hasMany(CniirIndex::class);
    }

    public function cniirIndexsByName()
    {
        return $this->hasMany(CniirIndex::class)->orderBy('name');
    }
}
