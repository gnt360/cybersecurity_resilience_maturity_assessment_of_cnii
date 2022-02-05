<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public $timestamps = false;

    public function organisations()
    {
        return $this->hasMany(Organisation::class);
    }

    public function organisationsByName()
    {
        return $this->hasMany(Organisation::class)->orderBy('name');
    }
}
