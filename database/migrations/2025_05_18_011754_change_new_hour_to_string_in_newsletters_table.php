<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNewHourToStringInNewslettersTable extends Migration
{
    public function up()
    {
        // Atenção: para usar ->change(), você precisa do pacote doctrine/dbal
        // composer require doctrine/dbal

        Schema::table('newsletters', function (Blueprint $table) {
            // altera new_hour de time para string
            $table->string('new_hour')->change();
        });
    }

    public function down()
    {
        Schema::table('newsletters', function (Blueprint $table) {
            // reverte para time
            $table->time('new_hour')->change();
        });
    }
}
