<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\View;
use  Illuminate\Support\Facades\DB;
use App\Models\Student;

class UserController extends Controller
{ 
    // insert data 
    function add(Request $req){
    $student=new Student();
    $student->name=$req->name;
    $student->email=$req->email;
    $student->phone=$req->phone;
$student->save();
if($student){return redirect("list");}
else{ return "failed";}
}

// get data in ui 
function list(){
   $student=Student::paginate(5);
    return view('about',['students'=>$student]);
}


//delete
function delete($id){
    $isdeleted=Student::destroy($id);
    if($isdeleted){
        return redirect('list');
    }
}

//patch data for update
function edit($id){
    $student=Student::find($id);
    return view('edit',['data'=>$student]);
}

//update 
function update(Request $req ,$id ){
 $student=Student::find($id);
 $student->name=$req->name;
 $student->email=$req->email;
 $student->phone=$req->phone;

if($student->save()){return redirect('list');}
else{return "failed";}

}

//search

function search(Request $req){
    $student=Student::where('name', 'like' , "%$req->search%")->paginate(5);
    return view('about',['students'=>$student,'search'=>$req->search]);
}


//delete multiple
function deleteMultiple(Request $req ){
    $result= Student::destroy($req->ids);
    if($result){
     return redirect('list');
    }
    else{  return "student data not deletd"; }
}
}
