<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('user_permissions', function (Blueprint $table) {
            // PK personalizada
            $table->bigIncrements('usp_id');

            // Área e ação da permissão
            $table->string('usp_area');
            $table->string('usp_action');

            // FK para User
            $table->unsignedBigInteger('users_usr_id');
            $table->foreign('users_usr_id')
                ->references('usr_id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_permissions');
    }
}
