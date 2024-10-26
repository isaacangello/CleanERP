<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('employee_id');
            $table->dateTime('schedule_date');
            $table->string('loop')->nullable();
            $table->string('notes', 3000)->nullable();
            $table->string('instructions', 3000)->nullable();
            $table->string('who_saved');
            $table->string('who_saved_id');
            $table->string('denomination',100)->nullable();
            $table->string('team')->nullable();
            $table->unsignedBigInteger('team_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('schedules');
        Schema::enableForeignKeyConstraints();
    }
};
