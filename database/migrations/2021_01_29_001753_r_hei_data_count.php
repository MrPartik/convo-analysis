<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RHeiDataCount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_hei_data_count', function (Blueprint $oTable) {
            $oTable->id();
            $oTable->unsignedBigInteger('hei_data_id');
            $oTable->string('year', 20);
            $oTable->string('count', 20);

            $oTable->foreign('hei_data_id')
                ->on('r_hei_data')
                ->references('id');

            $oTable->unique([
                'year',
                'hei_data_id',
                'count'
            ]);
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
