<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSagCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sag_categories', function (Blueprint $table) {
            $table->id();
             
            // $table->bigInteger('project_id')->unsigned();
            // $table->foreign('project_id')->references('id')->on('projects');

            $table->bigInteger('sag_id')->unsigned();
            $table->foreign('sag_id')->references('id')->on('sag');

            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');

            $table->integer('qty')->default(0);
            $table->integer('actual')->default(0);
            $table->integer('gap')->default(0);

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
        Schema::dropIfExists('sag_categories');
    }
}
