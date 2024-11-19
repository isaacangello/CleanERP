<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * Run the migrations.
     * `nome``phone``email``adress``nomerefone``phonerefone``nomereftwo``phonereftwo``notes``tipo``status``turnos``horario``cor`
     * RESIDENTIAL INACTIVE
     */

    public function up(): void
    {

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name',120);
            $table->string('phone',20);
            $table->string('email',60)->nullable();
            $table->date('birth')->nullable();
            $table->string('address',120)->nullable();
            $table->string('name_ref_one',60)->nullable();
            $table->string('name_ref_two',60)->nullable();
            $table->string('phone_ref_one',20)->nullable();
            $table->string('phone_ref_two',20)->nullable();
            $table->string('restriction')->nullable();
            $table->string('document')->nullable();
            $table->string('description',320)->nullable();
            $table->string('type',30)->default('RESIDENTIAL');
            $table->string('status',30)->default('ACTIVE');
            $table->string('shift',30)->nullable();
            $table->string('username',120)->unique();
            $table->string('password')->default(bcrypt('1234'))->nullable(); /* senha  1234 */
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->boolean('new_user')->default(true)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
