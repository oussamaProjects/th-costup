<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_services', function (Blueprint $table) {
            $table->bigInteger('project_id')->unsigned();
            $table->bigInteger('service_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->integer('qty')->default(0);
            $table->integer('percent_imputed')->default(0);
            $table->float('occup_hour')->default(0);
            $table->float('price')->default(0);
            $table->float('total')->default(0);
            $table->float('profit_margin_p_c')->default(0);
            $table->float('total_plus_margin')->default(0);
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
        Schema::dropIfExists('projects_services');
    }
}
