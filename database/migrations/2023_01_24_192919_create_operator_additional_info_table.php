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
        Schema::create('operator_additional_info', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->string('date_of_birth', 128)->nullable();
            $table->string('whatsapp', 128)->nullable();
            $table->string('blood_group', 128)->nullable();
            $table->string('present_address', 128)->nullable();
            $table->string('permanent_address', 128)->nullable();
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
        Schema::dropIfExists('operator_additional_info');
    }
};
