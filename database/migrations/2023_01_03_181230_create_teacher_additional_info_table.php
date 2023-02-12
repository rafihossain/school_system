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
        Schema::create('teacher_additional_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('department_id')->nullable();
            $table->integer('designation_id')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->integer('blood_id')->nullable();
            $table->text('present_address')->nullable();
            $table->string('teacher_profile_pic', 128)->nullable();
            $table->integer('status')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('teacher_additional_info');
    }
};
