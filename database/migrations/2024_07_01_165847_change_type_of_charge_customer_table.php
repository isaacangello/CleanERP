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
        Schema::table('customers',function (Blueprint $table){
            $table->dropColumn(['price_weekly','price_biweekly','price_monthly']);
            $table->string('price_of_charge');
        });//
        Schema::create('charges_customers_services',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('service_id');
            $table->string('label');
            $table->string('hint');
            $table->decimal('value',8,2);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('customer_id')->references('id')->on('customers');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {   Schema::table('customers',function (Blueprint $table){
        $table->dropColumn('price_of_charge');
        $table->string('price_weekly')->nullable();
        $table->string('price_biweekly')->nullable();
        $table->string('price_monthly')->nullable();
    });
    Schema::table('customers',function (Blueprint $table){
        $table
    });
    }
};
