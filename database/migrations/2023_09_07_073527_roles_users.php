<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->foreignId('user_id')->on('users')->onDelete('cascade')->index();
            $table->foreignId('role_id')->on('roles')->onDelete('cascade')->index();
            $table->primary(['user_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('roles_users', function (Blueprint $table) {
        //     //
        // });

        Schema::dropIfExists('role_user');
    }
};
