<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribersTable extends Migration
{
    public function up()
    {
        Schema::create('subscribers', function (Blueprint $table) {
            // chave primária customizada
            $table->bigIncrements('sub_id');

            // seus campos
            $table->string('sub_name')->nullable();
            $table->string('sub_email')->unique();

            // timestamps (created_at, updated_at)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscribers');
    }
}
