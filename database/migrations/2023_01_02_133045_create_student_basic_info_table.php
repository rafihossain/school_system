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
        Schema::create('student_basic_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('department_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('section_id')->nullable();;
            $table->integer('parent_id')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('b_form')->nullable();
            $table->string('registration')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_office_address')->nullable();
            $table->string('guardian_office_phone')->nullable();
            $table->string('guardian_mobile_phone')->nullable();
            $table->string('guardian_mobile_whatsapp')->nullable();
            $table->string('guardian_mobile_email')->nullable();
            $table->string('student_profile_pic')->nullable();
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
        Schema::dropIfExists('student_basic_info');
    }
};
