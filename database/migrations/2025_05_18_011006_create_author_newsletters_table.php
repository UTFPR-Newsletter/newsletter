<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorNewslettersTable extends Migration
{
    public function up()
    {
        Schema::create('author_newsletters', function (Blueprint $table) {
            $table->increments('aun_id');
            $table->unsignedInteger('author_aut_id');
            $table->unsignedInteger('newsletter_new_id');
            $table->timestamps();

            $table->foreign('author_aut_id')
                ->references('aut_id')
                ->on('authors')
                ->onDelete('cascade');

            $table->foreign('newsletter_new_id')
                ->references('new_id')
                ->on('newsletters')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('author_newsletters');
    }
}
