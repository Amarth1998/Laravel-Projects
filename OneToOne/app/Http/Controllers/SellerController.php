<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Product;


class SellerController extends Controller
{
    function onetoone(){
        return Seller::find(1)->productData;
    }

    function onetomany(){
      return Seller::find(1)->productonetomany;
    }


    function manytoone(){
      $data=Product::with('seller')->get();
      return $data;
    }
}


