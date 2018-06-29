<?php

use Illuminate\Database\Seeder;
use App\Teacher;

/* use Faker\Generator as Faker; */

require_once 'vendor/autoload.php';

class TeachersTableSeeder extends Seeder
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
        
        for ($i=0; $i < 10; $i++) { 
            $gender = $gender_generator[array_rand($gender_generator)];

            $teacher = [
                'name' => $faker->firstName($gender = $gender),
                'surname' => $faker->lastname,
                'age' => $faker->numberBetween($min = 28, $max = 60),
                'address' => $faker->address,
                'gender' => $gender,
            ];

            $new_teacher = new Teacher;
            $new_teacher->fill($teacher);
            $new_teacher->save();
        }
        

    }
}
