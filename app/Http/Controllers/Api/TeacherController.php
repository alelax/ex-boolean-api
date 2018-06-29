<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Teacher;



class TeacherController extends Controller
{
    public function index()
    {

        $teachers = Teacher::all();
       
        return response()->json($teachers);
    }


    public function showTeacher($id)
    {
        $teacher = Teacher::find($id);

        $courses_of_teacher = $teacher['courses'];

        $courses = [];

        foreach ($courses_of_teacher as $course) {

            $c = [
                'title' => $course['title'],
                'start_date' => $course['start_date'],
                'end_date' => $course['end_date']
            ];

            $courses[] = $c;

        }

        $response = [
            'name' => $teacher['name'],
            'surname' => $teacher['surname'],
            'age' => $teacher['age'],
            'gender' => $teacher['gender'],
            'courses' => $courses
        ];

        return response()->json($response);
    }
}
