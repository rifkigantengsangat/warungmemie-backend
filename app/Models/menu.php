<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    public $appends = ['images'];
    public function getImagesAttribute()
  {
    return [
      'image' => $this->image,
      'url' => asset('images') . '/' . $this->image,
    ];
  }
   public function testimonis()
   {
       return $this->hasMany(Testimoni::class,'id','testimonis_id');
    
   }
   public function categories()
   {
    return $this->hasOne(Category::class);
   }
}
