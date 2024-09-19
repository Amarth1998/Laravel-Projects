<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Student;
class StudentController extends Controller
{
    function list(){ return Student::all();}



    function addStudent(Request $req)
    {
        // Validation rules
        $rules = [
            'name' => 'required|min:2|max:10',
            'email' => 'required|email',
            'phone' => 'required|min:10|max:15',
        ];
    
        // Validator for request input
        $validator = Validator::make($req->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            // Return validation errors
            return response()->json($validator->errors(), 400); // 400 for bad request
        } 
    
        // Proceed to add the student if validation passes
        $student = new Student();
        $student->name = $req->name;  // Using name from the request
        $student->email = $req->email;
        $student->phone = $req->phone;
    
        // Save student and return response
        if ($student->save()) {
            return response()->json(['message' => 'Data saved successfully!'], 201); // 201 for created resource
        } else {
            return response()->json(['message' => 'Failed to save data'], 500); // 500 for internal server error
        }
    }
    

    function updateStudent(Request $req){
        $student = Student::find($req->id);
        $student->name=$req->name;
        $student->email=$req->email;
        $student->phone=$req->phone;
if($student->save()){return "data update";}
            else{return "data not update";}
}



//delete 
function deleteStudent($id){
    $student = Student::destroy($id);
    if($student){return "data delete";}
    else{return 'not deleted';}
}


//search 
function searchStudent($name){
    $student = Student::where('name','like',"%$name%")->get();
    if($student){
        return ["result"=>$student];
    }
    else{
        return ["result"=>"not found"];
    }

    // if($student){return $student;}
    // else{return 'not found';}
}


}
