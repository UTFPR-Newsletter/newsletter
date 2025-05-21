<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministratorsTable extends Migration
{
    public function up()
    {
        Schema::create('administrators', function (Blueprint $table) {
            // PK personalizada
            $table->bigIncrements('adm_id');

            // Nome e e-mail
            $table->string('adm_name');
            $table->string('adm_email')->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('administrators');
    }
}
