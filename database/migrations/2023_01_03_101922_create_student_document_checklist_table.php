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
        Schema::create('student_document_checklist', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('attested_passport_size_photograph')->nullable();
            $table->string('attested_national_id_card')->nullable();
            $table->string('attested_all_certificate')->nullable();
            $table->string('attested_relevent_document')->nullable();
            $table->string('migration_certificate_different_board')->nullable();
            $table->string('previous_school_leaving_certificate')->nullable();
            $table->string('b_from_goverment')->nullable();
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
        Schema::dropIfExists('student_document_checklist');
    }
};
