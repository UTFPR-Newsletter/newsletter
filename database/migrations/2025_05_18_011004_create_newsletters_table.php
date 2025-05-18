<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewslettersTable extends Migration
{
    public function up()
    {
        Schema::create('newsletters', function (Blueprint $table) {
            $table->increments('new_id');
            $table->string('new_title');
            $table->string('new_frequency');
            $table->time('new_hour');
            $table->date('new_estimate_date')->nullable();
            $table->string('new_status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('newsletters');
    }
}
