<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

   function productData(){
    return $this->hasOne('App\Models\Product');
   }

// if your id name is different
// function productData(){
//     return $this->hasOne('App\Models\Product',"owner_id");
//    }


function productonetomany(){
    return $this->hasMany('App\Models\Product');
}

}
