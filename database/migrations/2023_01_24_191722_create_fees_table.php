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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->default(0);
            $table->integer('parent_id')->default(0);
            $table->string('txn_number', 128)->nullable();
            $table->integer('invoice_type')->default(0);
            $table->integer('feetype_id')->default(0);
            $table->integer('class_id')->default(0);
            $table->integer('section_id')->default(0);
            $table->string('amount_due', 128)->nullable();
            $table->string('due_date', 128)->nullable();
            $table->text('fee_description')->nullable();
            $table->integer('fee_status')->default(0);
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
        Schema::dropIfExists('fees');
    }
};
