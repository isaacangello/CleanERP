<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * fields
     *  `nome``address``phone``email``type``status``frequency``regday``description``paypay``local``rentalhouse``info``chavec``key``passkey`
     * description for services frenquency
     * WEK =>Weekly
     * BIW=>Biweekly
     * THR=>Threeweekly
     * MON=>Monthly
     * ONE=>Eventual

     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name',120);
            $table->string('address',120);
            $table->string('complement',120);
            $table->string('phone',20);
            $table->string('email',40);
            $table->string('type',11)->default('RESIDENTIAL');
            $table->string('status',8)->default('ACTIVE');
            $table->string('frequency',3)->default('ONE');
            $table->string('price_weekly')->nullable();
            $table->string('price_biweekly')->nullable();
            $table->string('price_monthly')->nullable();
            $table->string('other_services')->nullable();
            $table->string('regday',15)->nullable();
            $table->string('info',320)->nullable();
            $table->boolean('drivelicence')->default(false);
            $table->boolean('key')->default(false);
            $table->boolean('moregril')->default(false);
            $table->boolean('gate_code')->default(false);
            $table->string('house_description',3000)->nullable();
            $table->string('note',3000)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
