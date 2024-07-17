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
        Schema::create('scheduling_control_residential', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $this->extracted($table);
            $table->foreign('service_id')->references('id')->on('services');
        });
        Schema::create('scheduling_control_commercial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('schedule_id');
            $this->extracted($table);
            $table->foreign('schedule_id')->references('id')->on('schedules');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('scheduling_control_residential');
        Schema::dropIfExists('scheduling_control_commercial');
        Schema::enableForeignKeyConstraints();


    }

    /**
     * @param Blueprint $table
     * @return void
     */
    public function extracted(Blueprint $table): void
    {
        $table->string('checkin_local');
        $table->string('checkin_lat');
        $table->string('checkin_long');
        $table->dateTime('checkin_datetime');
        $table->string('checkout_local');
        $table->float('checkout_lat');
        $table->float('checkout_long');
        $table->dateTime('checkout_datetime');
        $table->softDeletes();
        $table->timestamps();
    }
};
