<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdHistoryStatueToHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->bigInteger('history_statues_id')->unsigned();
            // $table->foreign('history_statues_id')->references('id')->on('history_statues');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->dropForeign(['history_statue_id']);
            $table->dropColumn('history_statue_id');
        });
    }
}
