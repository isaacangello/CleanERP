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
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('nun_reg_pages')->default(15);
            $table->string('theme')->default('light');
            $table->integer('spots')->default(11);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });

        Schema::create('business_data', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->string('business_phone');
            $table->string('business_other_phone');
            $table->string('business_address');
            $table->string('business_city');
            $table->string('business_zipcode');
            $table->string('business_email');
            $table->string('business_site');
            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('configs');
        Schema::dropIfExists('business_data');
        Schema::enableForeignKeyConstraints();
    }
};
