<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionLogsTable extends Migration
{
    public function up()
    {
        Schema::create('action_logs', function (Blueprint $table) {
            // PK personalizada
            $table->bigIncrements('acl_id');

            // Detalhes da ação
            $table->string('acl_model');
            $table->string('acl_action');
            $table->text('acl_description')->nullable();
            $table->string('acl_object');

            // Data e hora separadas
            $table->date('acl_date');
            $table->time('acl_time');

            // Referência ao registro afetado
            $table->unsignedBigInteger('acl_model_id');

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
        Schema::dropIfExists('action_logs');
    }
}
