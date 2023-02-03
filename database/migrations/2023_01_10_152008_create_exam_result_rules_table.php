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
        Schema::create('exam_result_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('gpa')->nullable();
            $table->string('min_mark')->nullable();
            $table->string('max_mark')->nullable();
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
        Schema::dropIfExists('exam_result_rules');
    }
};
