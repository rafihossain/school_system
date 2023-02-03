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
        Schema::create('announcement_notifies', function (Blueprint $table) {
            $table->id();
            $table->string('student_name', 128)->nullable();
            $table->string('student_email', 128)->nullable();
            $table->string('student_phone', 128)->nullable();
            $table->string('mail_subject', 128)->nullable();
            $table->text('mail_message')->nullable();
            $table->integer('mail_status')->default(0);
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
        Schema::dropIfExists('announcement_notifies');
    }
};
