<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_routines', function (Blueprint $table) {
            $table->id();
            $table->integer('session_id')->default(0);
            $table->integer('class_id')->default(0);
            $table->integer('section_id')->default(0);
            $table->integer('subject_id')->default(0);
            $table->integer('classroom_id')->default(0);
            $table->integer('teacher_id')->default(0);
            $table->integer('day_id')->default(0);
            $table->string('start_time', 128)->nullable();
            $table->string('end_time', 128)->nullable();
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
        Schema::dropIfExists('class_routines');
    }
};
