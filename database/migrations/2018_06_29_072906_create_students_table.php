<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->nullable($value = false);
            $table->string('surname', 100)->nullable($value = false);
            $table->smallInteger('age')->nullable($value = false);
            $table->string('address', 100)->nullable($value = false);
            $table->string('gender', 6)->nullable($value = false);
            $table->integer('course_id')->unsigned()->nullable();

            $table->foreign('course_id')->references('id')->on('courses');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
