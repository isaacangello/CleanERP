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
        //
        Schema::table('services', function (Blueprint $table){
            $table->boolean('is_closed')->default(false);
            $table->unsignedBigInteger('payment')->nullable()->change();
            $table->foreign('payment')->references('id')->on('payments')->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('services', function (Blueprint $table){
            $table->dropForeign('services_payment_foreign');
            $table->string('payment')->nullable()->change();
        });

    }
};
