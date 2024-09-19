<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
  function upload(Request $req){
    $path=$req->file('file')->store('public');
    $pathArray=explode("/",$path);
    $imgpath=$pathArray[1];

    $img=new Image();
    $img->path=$imgpath;

    if( $img->save()){
 return redirect("list");}
    else{   return"error"; }
  }

  function list(){
    $images=Image::all();
    return view('display',['imagedata'=>$images]);
  }
}
