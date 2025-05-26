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
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('permissions');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
        $users = array(
            array('id' => '1','name' => 'Isaac','username' => 'Isaac','permissions' => 'all','email' => 'isaacangello@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$KxGB5eEYcdLSHRZJKGEFxOQiUK2TLewQH2oNdSNRGl8VIvJIdawLu','remember_token' => 'AnGRkwLIoWxkGCz08hpxfepBkiEeoGQ9hCyC15oT1z4rZnT6IZIOHsaYdGpg','created_at' => '2024-03-26 20:28:25','updated_at' => '2024-03-26 20:28:25'),
            array('id' => '10','name' => 'Isaac Castro','username' => 'Isaac Castro','permissions' => 'all','email' => 'isaacangello@inf.ufpel.edu.br','email_verified_at' => NULL,'password' => '$2y$10$m0pIhsLsGhFqaMP6NtNABelmSKb6UTliak7GF6gdYTH5r6G0hXzfy','remember_token' => NULL,'created_at' => '2024-06-13 16:12:15','updated_at' => '2024-06-13 16:12:15')
        );

        DB::table('users')->insert($users);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('users');
        Schema::enableForeignKeyConstraints();
    }
};
