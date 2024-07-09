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
            $table->string('others_emails',3000);

            $table->string('standard_Billings');
        });//
        Schema::create('billings_customers',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('billing_id');
            $table->decimal('value',8,2);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('billing_id')->references('id')->on('billings');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('price_of_charge');
            $table->string('price_weekly')->nullable();
            $table->string('price_biweekly')->nullable();
            $table->string('price_monthly')->nullable();
        });
        Schema::dropIfExists('charges_customers');
    }
};
