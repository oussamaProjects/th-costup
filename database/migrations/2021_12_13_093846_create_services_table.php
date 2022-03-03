<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('unit_measure')->default(0);
            // $table->enum('unit_measure', ['hour-m', 'unity', '--'])->nullable()->default(['unity']);
            $table->integer('qty')->default(0);
            $table->float('occup_hour')->default(0);
            $table->float('price')->default(0);
            $table->float('profit_margin_p_c')->default(0);
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
        Schema::dropIfExists('services');
    }
}
