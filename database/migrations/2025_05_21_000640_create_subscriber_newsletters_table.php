<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriberNewslettersTable extends Migration
{
    public function up()
    {
        Schema::create('subscriber_newsletters', function (Blueprint $table) {
            // PK personalizada
            $table->bigIncrements('sun_id');
            
            // Se está ativo
            $table->boolean('sun_active')->default(true);
            
            // FK para Subscriber
            $table->unsignedBigInteger('subscriber_sub_id');
            $table->foreign('subscriber_sub_id')
                ->references('sub_id')
                ->on('subscribers')
                ->onDelete('cascade');
            
            // FK para NewsletterNew
            $table->unsignedInteger('newsletter_new_id');
            $table->foreign('newsletter_new_id')
                ->references('new_id')
                ->on('newsletters')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscriber_newsletters');
    }
}
