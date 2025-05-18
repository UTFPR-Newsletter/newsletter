<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorTopicsTable extends Migration
{
    public function up()
    {
        Schema::create('author_topics', function (Blueprint $table) {
            $table->increments('att_id');
            $table->string('att_name');
            $table->string('att_color')->nullable();
            $table->unsignedInteger('author_aut_id');
            $table->timestamps();

            // chave estrangeira
            $table->foreign('author_aut_id')
                ->references('aut_id')
                ->on('authors')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('author_topics');
    }
}
