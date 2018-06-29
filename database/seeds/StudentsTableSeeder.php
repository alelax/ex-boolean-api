<?php

use Illuminate\Database\Seeder;
use App\Student;
use App\Course;

require_once 'vendor/autoload.php';


class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

       

        $gender_generator = ['male', 'female'];
        
        for ($i=0; $i < 200; $i++) { 
            
            $gender = $gender_generator[array_rand($gender_generator)];
            
            $course_for_student = Course::inRandomOrder()->first(); 
            $course_id = $course_for_student['id'];

            $student = [
                'name' => $faker->firstName($gender = $gender),
                'surname' => $faker->lastname,
                'age' => $faker->numberBetween($min = 18, $max = 50),
                'address' => $faker->address,
                'gender' => $gender,
                'course_id' => $course_id
            ];

            $new_student = new Student;
            $new_student->fill($student);
            $new_student->save();
        }
    }
}
