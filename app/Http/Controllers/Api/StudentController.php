<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Student;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        return response()->json($students);
    }

    public function showStudent($id)
    {   
        $student = Student::find($id);

        $student_detail = [
            'name' => $student['name'],
            'surname' => $student['surname'],
            'age' => $student['age'],
            'gender' => $student['gender'],
            'course' => $student['course']['title']
        ];

        return response()->json($student_detail);
        
    }
}
