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
            $table->string('residential_address', 128)->nullable();
            $table->string('student_phone', 128)->nullable();
            $table->string('student_mobile', 128)->nullable();
            $table->string('student_whatsapp', 128)->nullable();
            $table->string('religion', 128)->nullable();
            $table->string('nationality', 128)->nullable();
            $table->string('domicile', 128)->nullable();
            $table->string('blood_group', 128)->nullable();
            $table->string('medical_history', 128)->nullable();
            $table->string('special_instruction', 128)->nullable();
            $table->string('admission_cancel_date', 128)->nullable();
            $table->string('transport_required', 128)->nullable();
            $table->string('free_student', 128)->nullable();
            $table->string('status', 128)->nullable();
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
