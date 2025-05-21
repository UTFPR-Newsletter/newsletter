<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsletterEditionNodesTable extends Migration
{
    public function up()
    {
        Schema::create('newsletter_edition_nodes', function (Blueprint $table) {
            // PK personalizada
            $table->bigIncrements('nen_id');

            // Campos de conteúdo
            $table->string('nen_head');
            $table->string('nen_title');
            $table->string('nen_image')->nullable();
            $table->text('nen_content');

            // FK para NewsletterEdition
            $table->unsignedBigInteger('newsletter_edition_nee_id');
            $table->foreign('newsletter_edition_nee_id')
                ->references('nee_id')
                ->on('newsletter_editions')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('newsletter_edition_nodes');
    }
}
