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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('employee1_id');
            $table->unsignedBigInteger('employee2_id')->nullable();
            $table->dateTime('service_date');
            $table->string('period')->nullable();
            $table->string('frequency')->default('ONE');
            $table->string('notes', 3000)->nullable();
            $table->string('instructions', 3000)->nullable();
            $table->boolean('paid_out')->default(false);
            $table->boolean('fee')->default(false);
            $table->string('finance_notes',500)->nullable();
            $table->string('frequency_payment')->nullable();
            $table->string('payment')->nullable();
            $table->string('who_saved')->nullable();
            $table->float('price')->nullable();
            $table->string('justify_plus',500)->nullable();
            $table->float('plus')->nullable();
            $table->string('justify_minus',500)->nullable();
            $table->float('minus')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnDelete();
            $table->foreign('employee1_id')->references('id')->on('employees')->cascadeOnDelete();
            $table->foreign('employee2_id')->references('id')->on('employees')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign('services_customer_id_foreign');
            $table->dropForeign('services_employee1_id_foreign');
            $table->dropForeign('services_employee2_id_foreign');
        });

        Schema::dropIfExists('services');
    }
};
