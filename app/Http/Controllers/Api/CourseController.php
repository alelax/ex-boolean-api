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
}
