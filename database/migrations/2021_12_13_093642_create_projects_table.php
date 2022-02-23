<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->float('epo')->default(0); 
            $table->float('epp')->default(0); 
            $table->float('epps')->default(0); 
            $table->float('em')->default(0); 
            $table->float('smph')->default(0); 
            $table->float('lmph')->default(0); 
            $table->float('smph_custommer_demand')->default(0); 
            $table->float('smph_production_available_time')->default(0); 
            $table->float('lmph_custommer_demand')->default(0); 
            $table->float('lmph_production_available_time')->default(0); 
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
        Schema::dropIfExists('projects');
    }
}
