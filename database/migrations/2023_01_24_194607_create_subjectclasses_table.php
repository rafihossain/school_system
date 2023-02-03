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
        Schema::create('subjectclasses', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id')->default(0);
            $table->string('subject_name', 128)->nullable();
            $table->string('subject_code', 128)->nullable();
            $table->string('total_mark', 128)->nullable();
            $table->string('theory_mark', 128)->nullable();
            $table->string('practical_mark', 128)->nullable();
            $table->string('city_exam_mark', 128)->nullable();
            $table->string('diary')->nullable();
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
        Schema::dropIfExists('subjectclasses');
    }
};
