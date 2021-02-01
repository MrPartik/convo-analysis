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
            $oTable->unsignedBigInteger('program_id')->nullable();
            $oTable->string('type', 20);

            $oTable->unique([
               'program_id',
               'type'
            ]);

            $oTable->foreign('program_id')->on('r_program')->references('id');
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
