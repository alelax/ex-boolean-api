<?php

use Illuminate\Database\Seeder;
use App\Teacher;
use App\Course;

require_once 'vendor/autoload.php';

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();
        
        $start_date = $faker->dateTimeBetween($startDate = '2018-09-01', $endDate = '2019-02-01', $timezone = null);
        $end_date = $faker->dateTimeBetween($startDate = '2019-09-01', $endDate = '2020-02-01', $timezone = null);
        

        $course_available = ["Elettronica Digitale", "Sistemi Elettronici", "Javascript&jJQuery", "Java", "PHP&MySql",
                             "Matematica", "Fisica", "Storia", "Angular", "NodeJs", "Filsofia", "Yoga", "CrossFit", 
                             "Alpinisimo"];
        

        
        for ($i=0; $i < sizeof($course_available) ; $i++) { 

            $teacher_of_course = Teacher::inRandomOrder()->first(); 
            $teacher_id = $teacher_of_course['id'];

            $course = [
                    'title' => $course_available[$i],
                    'start_date' => $faker->dateTimeBetween($startDate = '2018-09-01', $endDate = '2019-02-01', $timezone = null),
                    'end_date' => $faker->dateTimeBetween($startDate = '2019-09-01', $endDate = '2020-02-01', $timezone = null),
                    'teacher_id' => $teacher_id
            ];

            
            $new_course = new Course;
            $new_course->fill($course);
            $new_course->save();
            
        }


    }
}
