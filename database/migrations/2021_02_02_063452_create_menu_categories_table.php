<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_categories', function (Blueprint $table) {
           $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->bigInteger('position')->nullable();
            $table->enum('show_on',['header','footer','both','none']);
            $table->enum('status',['yes','no']);
            $table->string('feature_img')->nullable();
            $table->string('parallex_img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_categories');
    }
}
