<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftDayResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_day_resource', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('shift_id')->unsigned();
            $table->foreign('shift_id')->references('id')->on('shifts');
            
            $table->bigInteger('day_id')->unsigned();
            $table->foreign('day_id')->references('id')->on('days');
            
            $table->bigInteger('personnel_id')->unsigned();
            $table->foreign('personnel_id')->references('id')->on('personnels');

            $table->bigInteger('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');

            $table->integer('nbr_personnels');

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
        //
    }
}
