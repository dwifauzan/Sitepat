<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration
{
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles'); // Define foreign key 'role_id' referencing 'id' column in 'roles' table
            $table->foreignId('user_id')->constrained('users'); // Define foreign key 'user_id' referencing 'id' column in 'users' table
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
