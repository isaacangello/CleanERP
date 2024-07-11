<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public $std_billings = [
       ['label' => 'Standard Price','value' => 200,'hint'=> 'This price is billings in eventual Service.'],
       ['label' => 'Weekly Price','value' => 180,'hint'=> 'This price is billings in Weekly Service.'],
       ['label' => 'Biweekly Price','value' => 179,'hint'=> 'This price is billings in Biweekly Service.'],
       ['label' => 'Rental House Price','value' => 160,'hint'=> 'This price is billings in Service for Rental House.'],
   ];
    public function up(): void
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->string('label', 30);
            $table->decimal('value', 8,2);
            $table->string('hint', 100);
            $table->softDeletes();
            $table->timestamps();
        });
        DB::table('billings')->insert($this->std_billings);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('billings');
        Schema::enableForeignKeyConstraints();
    }
};
