<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsletterEditionsTable extends Migration
{
    public function up()
    {
        Schema::create('newsletter_editions', function (Blueprint $table) {
            // PK customizado
            $table->bigIncrements('nee_id');

            // Datas
            $table->date('nee_estimate_date');
            $table->date('nee_sent_date')->nullable();

            // Status e review
            $table->string('nee_status', 50);
            $table->text('newsletter_review')->nullable();

            // Imagem de cabeçalho e contagem de views
            $table->string('nee_header_image')->nullable();
            $table->unsignedInteger('nee_views')->default(0);

            // FK para a tabela de “newsletter_new”
            $table->unsignedInteger('newsletter_new_id');
            $table->foreign('newsletter_new_id')
                ->references('new_id')
                ->on('newsletters')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('newsletter_editions');
    }
}
