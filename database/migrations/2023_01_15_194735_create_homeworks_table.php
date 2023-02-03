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
        Schema::create('homeworks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 128)->nullable();
            $table->integer('teacher_id')->default(0);
            $table->integer('class_id')->default(0);
            $table->integer('section_id')->default(0);
            $table->integer('subject_id')->default(0);
            $table->string('start_date', 128)->nullable();
            $table->string('end_date', 128)->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('homeworks');
    }
};
