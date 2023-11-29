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
            $table->string('period');
            $table->string('frequency')->default('ONE');
            $table->string('notes', 3000)->nullable();
            $table->string('instructions', 3000)->nullable();
            $table->boolean('paid_out')->default(false);
            $table->boolean('fee')->default(false);
            $table->string('feenotes',500)->nullable();
            $table->string('pgmt')->nullable();
            $table->string('who_saved')->nullable();
            $table->float('price')->nullable();
            $table->float('plus')->nullable();
            $table->float('minus')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('services', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('employee1_id')->references('id')->on('employees');
            $table->foreign('employee2_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign('customer_id');
            $table->dropForeign('employee1_id');
            $table->dropForeign('employee2_id');
        });

        Schema::dropIfExists('services');
    }
};
