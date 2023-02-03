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
        Schema::create('system_systems', function (Blueprint $table) {
            $table->id();
            $table->string('sidebar_bgcolor', 128)->nullable();
            $table->string('navigation_bgcolor', 128)->nullable();
            $table->string('sidebar_txtcolor', 128)->nullable();
            $table->string('navigation_txtcolor', 128)->nullable();
            $table->string('left_nav_position', 128)->nullable();
            $table->string('top_nav_position', 128)->nullable();
            $table->string('full_width_layout', 128)->nullable();
            $table->string('box_layout', 128)->nullable();
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
        Schema::dropIfExists('system_systems');
    }
};
