<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsletterCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('newsletter_categories', function (Blueprint $table) {
            $table->increments('nec_id');
            $table->unsignedInteger('newsletter_new_id');
            $table->unsignedInteger('category_cat_id');
            $table->timestamps();

            $table->foreign('newsletter_new_id')
                ->references('new_id')
                ->on('newsletters')
                ->onDelete('cascade');

            $table->foreign('category_cat_id')
                ->references('cat_id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('newsletter_categories');
    }
}
