<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // PK personalizada
            $table->bigIncrements('usr_id');

            // Credenciais e nível
            $table->string('usr_email')->unique();
            $table->string('usr_senha');
            $table->unsignedTinyInteger('usr_level')->default(1);

            // Status de ativo/inativo
            $table->boolean('usr_active')->default(true);

            $table->integer('represented_agent_id')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
