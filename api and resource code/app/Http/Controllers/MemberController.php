<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Student;
class MemberController extends Controller
{
    // Display a listing of the resource.
     public function index()
    {
        return Student::all();
    }
     // Show the form for creating a new resource.
      public function create()
    {
    }

    // Store a newly created resource in storage.
    public function store(Request $req)
    {   // Validation rules
        $rules = [
            'name' => 'required|min:2|max:10',
            'email' => 'required|email',
            'phone' => 'required|min:10|max:15',
        ];
        $validator = Validator::make($req->all(), $rules);  // Validator for request input
    
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
    
//  Display the specified resource.
      public function show(string $id)
    {
        //
    }

    // Show the form for editing the specified resource.
    public function edit(string $id)
    {
        //
    }


//Update the specified resource in storage.
     public function update(Request $req, string $id)
{   
    // Find the student by the ID passed from the URL
    $student = Student::find($id);

    // Check if student exists
    if (!$student) {
        return response()->json(['message' => 'Student not found'], 404); // Return a 404 if the student is not found
    }

    // Update student properties from the request
    $student->name = $req->name;
    $student->email = $req->email;
    $student->phone = $req->phone;

    // Save updated student data
    if ($student->save()) {
        return response()->json(['message' => 'Data updated successfully!'], 200); // 200 for successful update
    } else {
        return response()->json(['message' => 'Data update failed'], 500); // 500 for server error
    }}

    // Remove the specified resource from storage. 
    public function destroy(string $id)
    {
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
