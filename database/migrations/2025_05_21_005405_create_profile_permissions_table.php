<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilePermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('profile_permissions', function (Blueprint $table) {
            // PK personalizada
            $table->bigIncrements('prf_id');

            // Área e ação da permissão
            $table->string('prf_area');
            $table->string('prf_action');

            // Nível da permissão
            $table->unsignedInteger('prf_level');
        });
    }

    public function down()
    {
        Schema::dropIfExists('profile_permissions');
    }
}
