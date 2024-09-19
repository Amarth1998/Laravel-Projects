<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
class StudentController extends Controller
{
    function list(){
return Student::all();
    }

    function save(){
        $student=new Student();
        $student->name="bruce";
        $student->email="bruce@gmail.com";
        $student->phone="123456789";

        if($student->save()){
            return "Student saved successfully";
        }
        else{
            return "Error while saving student";
            }

            }

}
