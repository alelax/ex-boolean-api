<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();

        return response()->json($courses);
    }

    public function showCourse(Request $request, $id)
    {
        $teacher_request = $request['insegnanti'];
        $student_request = $request['studenti'];

        $course = Course::find($id);
       
        $response = [
            'title' => $course['title'],
            'start_date' => $course['start_date'],
            'end_date' => $course['end_date'],
            'title' => $course['title'],
        ];

        if ( !empty($teacher_request) && ($teacher_request=="true") ) {
            $teacher[] = [ 
                    "name" => $course['teacher']['name'],
                    "surname" => $course['teacher']['surname'],
                    "age" => $course['teacher']['age'],
            ];   
            $response = array_merge($response, ["teacher" => $teacher]); 
            
        } 

        if ( !empty($student_request) && ($student_request=="true") ) {

            $students_for_this_course = $course['students'];
            $students = [];
    
            foreach ($students_for_this_course as $student) {
                $s = [
                    'name' => $student['name'],
                    'surname' => $student['surname'],
                    'age' => $student['age'],
                    'gender' => $student['gender']
                ];
    
                $students[] = $s;
                
            }
            
            $response = array_merge($response, ["students" => $students]);
           
        }        
        
        return response()->json($response);
    }
}
