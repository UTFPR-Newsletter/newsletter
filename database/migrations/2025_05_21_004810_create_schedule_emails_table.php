<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleEmailsTable extends Migration
{
    public function up()
    {
        Schema::create('schedule_emails', function (Blueprint $table) {
            // PK personalizada
            $table->bigIncrements('sce_id');

            // Data/hora de envio
            $table->dateTime('sce_send_date');

            // Status do envio
            $table->string('sce_status', 50);

            // FK para a edição da newsletter
            $table->unsignedBigInteger('newsletter_edition_nee_id');
            $table->foreign('newsletter_edition_nee_id')
                ->references('nee_id')
                ->on('newsletter_editions')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedule_emails');
    }
}
