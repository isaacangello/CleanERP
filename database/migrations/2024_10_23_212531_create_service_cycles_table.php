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
        Schema::create('customers_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('schedule_id');
            $table->DateTime('date');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('schedule_id')->references('id')->on('schedules');
        });
        Schema::create('customers_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('service_id');
            $table->DateTime('date');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void

    {
        Schema::table('customers_schedules', function (Blueprint $table) {
            $table->dropForeign('customers_schedules_customer_id_foreign');
            $table->dropForeign('customers_schedules_schedule_id_foreign');
        });
        Schema::table('customers_services', function (Blueprint $table) {
            $table->dropForeign('customers_services_customer_id_foreign');
            $table->dropForeign('customers_services_service_id_foreign');
        });
        Schema::dropIfExists('customers_services');
        Schema::dropIfExists('customers_schedules');
    }
};
