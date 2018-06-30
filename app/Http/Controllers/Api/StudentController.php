<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Student;
use App\Course;

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

    public function addStudent(Request $request)
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
            $new_student = new Student;
            $new_student->name = $data['name'];
            $new_student->surname = $data['surname'];
            $new_student->age = $data['age'];
            $new_student->gender = $data['gender'];
            $new_student->address = $data['address'];
            
            if ( !empty($data['course_id']) ) {
                $available_id = Course::pluck('id');

                $id_exists = false;
                $i = 0;
                do {
                    if ($data['course_id'] == $available_id[$i]) {
                        $id_exists = true;                        
                    } else {
                        $i++;
                    }   
                } while ((!$id_exists) && ( $i < sizeof($available_id) ) );

                if ($id_exists) {
                    $new_student->course_id = $data['course_id']; 
                }
            }

            $new_student->save();
            
            return response()->json([
                "success" => true,
                "log" => "Data added correctely",
                "data" => [
                    "name" =>  $new_student->name,
                    "surname" => $new_student->surname,
                    "age" => $new_student->age,
                    "address" => $new_student->address,
                    "gender" => $new_student->gender,
                    "course_id" => $new_student->course_id
                ]
            ]);
        }     
    }

    public function delete($id)
    {
        $t = Student::find($id);
        $status = "";
        $message = "";

        if ( is_null($t)) {
            $status = "failed";
            $message = "This id does not exist";
        } else {
            $t->delete();
            $status = "ok";
            $message = "This student has been deleted";
            
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
        if ( !empty($data['course_id']) ) {
            
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
