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
            $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnDelete();
            $table->foreign('schedule_id')->references('id')->on('schedules')->cascadeOnDelete();
        });
        Schema::create('schedule_cycles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('customer_name');
            $table->string('ids',5000);
            $table->string('dates',5000);
            $table->string('frequency');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('customers_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('service_id');
            $table->DateTime('date');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnDelete();
            $table->foreign('service_id')->references('id')->on('services')->cascadeOnDelete();
        });
        Schema::create('services_cycles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('customer_name');
            $table->string('ids',5000);
            $table->string('dates',5000);
            $table->string('frequency');
            $table->softDeletes();
            $table->timestamps();
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
        Schema::dropIfExists('services_cycles');
        Schema::dropIfExists('schedule_cycles');
        Schema::dropIfExists('customers_services');
        Schema::dropIfExists('customers_schedules');
    }
};
