<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RHeiData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_hei_data', function (Blueprint $oTable) {
            $oTable->id();
            $oTable->string('hei');
            $oTable->string('region', 20);
            $oTable->string('type', 20);

            $oTable->unique([
               'hei',
               'region',
               'type'
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
