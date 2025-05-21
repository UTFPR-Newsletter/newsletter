<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriberCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('subscriber_categories', function (Blueprint $table) {
            // PK personalizada
            $table->bigIncrements('suc_id');

            // FKs
            $table->unsignedBigInteger('subscriber_sub_id');
            $table->unsignedInteger('category_cat_id');

            // Constraints
            $table->foreign('subscriber_sub_id')
                ->references('sub_id')
                ->on('subscribers')
                ->onDelete('cascade');

            $table->foreign('category_cat_id')
                ->references('cat_id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscriber_categories');
    }
}
