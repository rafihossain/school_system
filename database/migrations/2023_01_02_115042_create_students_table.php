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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('session_id')->nullable();
            $table->integer('section_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->string('roll_no', 128)->nullable();
            $table->string('admission_date', 128)->nullable();
            $table->string('b_form', 128)->nullable();
            $table->string('registration', 128)->nullable();
            $table->string('guardian_name', 128)->nullable();
            $table->string('guardian_office_address', 128)->nullable();
            $table->string('guardian_office_phone', 128)->nullable();
            $table->string('guardian_mobile_phone', 128)->nullable();
            $table->string('guardian_mobile_whatsapp', 128)->nullable();
            $table->string('guardian_mobile_email', 128)->nullable();
            $table->string('student_profile_pic', 128)->nullable();
            
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
        Schema::dropIfExists('students');
    }
};
