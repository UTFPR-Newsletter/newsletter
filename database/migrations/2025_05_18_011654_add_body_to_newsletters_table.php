<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBodyToNewslettersTable extends Migration
{
    public function up()
    {
        Schema::table('newsletters', function (Blueprint $table) {
            // adiciona o campo new_body como texto, opcional, logo após new_status
            $table->text('new_body')
                ->nullable()
                ->after('new_status');
        });
    }

    public function down()
    {
        Schema::table('newsletters', function (Blueprint $table) {
            $table->dropColumn('new_body');
        });
    }
}
