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
            $table->string('phone',20);
            $table->string('email',40);
            $table->string('type',11)->default('RESIDENTIAL');
            $table->string('status',8)->default('ACTIVE');
            $table->string('frequency',3)->default('ONE');
            $table->string('regday',15)->nullable();
            $table->string('description',320)->nullable();
            $table->string('info',320)->nullable();
            $table->boolean('rentalhouse')->default(false);
            $table->boolean('drive')->default(false);
            $table->boolean('key')->default(false);
            $table->boolean('passkey')->default(false);
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
