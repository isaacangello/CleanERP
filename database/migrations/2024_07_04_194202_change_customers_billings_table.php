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
        if (Schema::hasColumn('customers', 'price_weekly')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->dropColumn(['price_weekly', 'price_biweekly', 'price_monthly']);

            });//
        }
        Schema::table('customers',function (Blueprint $table){

            $table->string('others_emails',3000)->nullable();
        });//

        Schema::create('billings_customers',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('billing_id');
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


            $table->string('price_weekly')->nullable();
            $table->string('price_biweekly')->nullable();
            $table->string('price_monthly')->nullable();
        });
        if (Schema::hasColumn('customers', 'price_of_charge')) {
            // The "users" table exists and has an "email" column...
            Schema::table('customers', function (Blueprint $table) {
                $table->dropColumn('price_of_charge');
            });
        }

        Schema::dropIfExists('billings_customers');
    }
};
