<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\Course;



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

    public function addTeacher(Request $request)
    {
        $data = $request->all();
        
        $error_message = "";
        $isThere_an_error = false;

        if ( empty($data['name']) ) {
            $error_message .= "Nome mancante, ";
            $isThere_an_error = true;
        }
        if ( empty($data['surname']) ) {
            $error_message .= "Cognome mancante, ";
            $isThere_an_error = true;

        }
        if ( empty($data['age']) ) {
            $error_message .= "Età mancante, ";
            $isThere_an_error = true;
        }
        if ( empty($data['address']) ) {
            $error_message .= "Indirizzo mancante, ";
            $isThere_an_error = true;
        }
        if ( empty($data['gender']) ) {
            $error_message .= "Genere mancante, ";
            $isThere_an_error = true;
        }
  
        if ( $isThere_an_error ) {
            return response()->json([
                "success" => false,
                "log" => $error_message
            ]);
        } else {
            $new_teacher = new Teacher;
            $new_teacher->name = $data['name'];
            $new_teacher->surname = $data['surname'];
            $new_teacher->age = $data['age'];
            $new_teacher->gender = $data['gender'];
            $new_teacher->address = $data['address'];

            $new_teacher->save();
            
            return response()->json([
                "success" => true,
                "log" => "Data added correctely",
                "data" => [
                    "name" =>  $new_teacher->name,
                    "surname" => $new_teacher->surname,
                    "age" => $new_teacher->age,
                    "address" => $new_teacher->address,
                    "gender" => $new_teacher->gender,                    
                ]
            ]);
        }     
    }


    public function delete($id)
    {
        $t = Teacher::find($id);

        $teachers_courses = Course::where('teacher_id', $t['id'])->get();
        
        
        $status = "";
        $message = "";
        
        if ( is_null($t)) {
            $status = "failed";
            $message = "This id does not exist";
        } else {
            foreach ($teachers_courses as $tc) {
                $tc['teacher_id'] = null;
                $tc->save();
            }
            
            $t->delete();
            $status = "ok";
            $message = "This teacher has been deleted";
            
        }

        return response()->json([
            "status" => $status,
            "message" => $message
        ]);
    }

    public function edit(Request $request, $id)
    {
        $data = $request->all();
        $error_message = "";
        $isThere_an_error = false;

        if ( empty($data['name']) ) {
            $error_message .= "Nome mancante, ";
            $isThere_an_error = true;
        }
        if ( empty($data['surname']) ) {
            $error_message .= "Cognome mancante, ";
            $isThere_an_error = true;

        }
        if ( empty($data['age']) ) {
            $error_message .= "Età mancante, ";
            $isThere_an_error = true;
        }
        if ( empty($data['address']) ) {
            $error_message .= "Indirizzo mancante, ";
            $isThere_an_error = true;
        }
        if ( empty($data['gender']) ) {
            $error_message .= "Genere mancante, ";
            $isThere_an_error = true;
        }
  
        if ( $isThere_an_error ) {
            return response()->json([
                "success" => false,
                "log" => $error_message
            ]);
        } else {
            $existing_teacher = Teacher::find($id);
            $existing_teacher->fill($data);
           
            $existing_teacher->save();
            
            return response()->json([
                "success" => true,
                "log" => "Data added correctely",
                "data" => [
                    "name" =>  $existing_teacher->name,
                    "surname" => $existing_teacher->surname,
                    "age" => $existing_teacher->age,
                    "address" => $existing_teacher->address,
                    "gender" => $existing_teacher->gender,                    
                ]
            ]);
        }     
    }
}
