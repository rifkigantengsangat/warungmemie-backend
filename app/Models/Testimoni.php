<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;
    public function users ()
    {
       return  $this->hasOne(User::class,'id','users_id')->select('id','name','created_at');
    }
    public function menus(){
        return $this->belongsTo(Menu::class);
    }
}
