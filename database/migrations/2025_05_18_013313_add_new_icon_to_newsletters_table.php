<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewIconToNewslettersTable extends Migration
{
    public function up()
    {
        Schema::table('newsletters', function (Blueprint $table) {
            // adiciona o campo new_icon como string, opcional, após new_body
            $table->string('new_icon')
                ->nullable()
                ->after('new_body');
        });
    }

    public function down()
    {
        Schema::table('newsletters', function (Blueprint $table) {
            $table->dropColumn('new_icon');
        });
    }
}
