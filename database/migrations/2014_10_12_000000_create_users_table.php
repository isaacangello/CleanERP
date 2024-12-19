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
            array('id' => '2','name' => 'Mirella','username' => 'Mirella','permissions' => 'all','email' => 'mirellafsouza@hotmail.com','email_verified_at' => NULL,'password' => '$2y$10$RE80FG3JQxh2PkLgc27iVOHMUgu/fZOOXgLsW8NkEwHt9GqzTtVOS','remember_token' => 'fPh4wW7jmSMzQ8dMA6I7XwS8q93yk3plOysgIy7m8IwKp1YNaDfaUUAswJoE','created_at' => '2024-03-26 20:50:18','updated_at' => '2024-03-26 20:50:18'),
            array('id' => '3','name' => 'Lia McCollum','username' => 'Lia McCollum','permissions' => 'all','email' => 'autelia@hotmail.com','email_verified_at' => NULL,'password' => '$2y$10$R9UeyJzH/JRvKl3xZLnsEe8.rdFKtsGPfriH4f2QevpJQxmefBigW','remember_token' => NULL,'created_at' => '2024-03-26 20:51:21','updated_at' => '2024-03-26 20:51:21'),
            array('id' => '4','name' => 'Felipe Melo','username' => 'Felipe Melo','permissions' => 'all','email' => 'luiizfelipe.melo.braga@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$jbQAd89XqcuMbt2LUkoKs.dW9RmgO16J/L8b/plDZu6E5LRD03J5e','remember_token' => NULL,'created_at' => '2024-03-26 20:51:38','updated_at' => '2024-03-26 20:51:38'),
            array('id' => '5','name' => 'Michelle','username' => 'Michelle','permissions' => 'all','email' => 'michelleviana17@hotmail.com','email_verified_at' => NULL,'password' => '$2y$10$wUfU9hX7Ko7e0He00yu2E.UB/iRDsr1tBepY3kKI5Ulq28Uwwiwna','remember_token' => NULL,'created_at' => '2024-03-26 20:51:41','updated_at' => '2024-03-26 20:51:41'),
            array('id' => '6','name' => 'Leo Costa','username' => 'Leo Costa','permissions' => 'all','email' => 'leostscosta@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$E41KDUg2ZoM8t/bP1LGtNObKubvxsSj1k7XCbGIkoaXQupPNASXEW','remember_token' => NULL,'created_at' => '2024-03-26 20:54:02','updated_at' => '2024-03-26 20:54:02'),
            array('id' => '7','name' => 'Mariana','username' => 'Mariana','permissions' => 'all','email' => 'tradutoramarianarodrigues@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$/iFB6M0f/dqV1OQvSjSjWu5eFEiVlYaJubwxGY2ZReGB7HJg6iHlq','remember_token' => NULL,'created_at' => '2024-03-27 17:12:22','updated_at' => '2024-03-27 17:12:22'),
            array('id' => '8','name' => 'Yasmin Dossantos','username' => 'Yasmin Dossantos','permissions' => 'all','email' => 'yasmind9924@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$ht2zx0.v2JoAcayLhRnJ4eAaWzu7ls/ynn2nWqxRnWVAEBNWUWYtG','remember_token' => NULL,'created_at' => '2024-04-02 18:32:57','updated_at' => '2024-04-02 18:32:57'),
            array('id' => '9','name' => 'Carla Guimarães','username' => 'Carla Guimarães','permissions' => 'all','email' => 'carla.guimaraesp48@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$vm19BEiUTflg/Hyuk6n9h.Mxjlc.mdMYG8scSYKf4LYkd1PiA0LKa','remember_token' => NULL,'created_at' => '2024-04-04 17:26:32','updated_at' => '2024-04-04 17:26:32'),
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
