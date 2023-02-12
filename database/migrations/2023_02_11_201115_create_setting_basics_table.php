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
        Schema::create('setting_basics', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->nullable();
            $table->string('short_name', 128)->nullable();
            $table->string('email', 128)->nullable();
            $table->string('phone', 128)->nullable();
            $table->text('adddress')->nullable();
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->string('dark_mode_logo')->nullable();
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
        Schema::dropIfExists('setting_basics');
    }
};
