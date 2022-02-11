<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'sector_id', 'code'];

   public function sector(){
      return $this->belongsTo(Sector::class, 'sector_id');
   }

   public function users()
   {
       return $this->hasMany(User::class, 'org_id');
   }

   public function usersByName()
   {
       return $this->hasMany(User::class)->orderBy('full_name');
   }
}
