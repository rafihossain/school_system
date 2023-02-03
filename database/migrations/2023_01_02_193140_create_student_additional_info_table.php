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
        Schema::create('student_additional_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('residential_address')->nullable();
            $table->string('student_phone')->nullable();
            $table->string('student_mobile')->nullable();
            $table->string('student_whatsapp')->nullable();
            $table->string('religion')->nullable();
            $table->string('nationality')->nullable();
            $table->string('domicile')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('medical_history')->nullable();
            $table->string('special_instruction')->nullable();
            $table->string('admission_cancel_date')->nullable();
            $table->string('transport_required')->nullable();
            $table->string('free_student')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('student_additional_info');
    }
};
