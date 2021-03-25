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
            $oTable->string('hei_code', 20)->nullable();
            $oTable->unsignedBigInteger('program_id')->nullable();
            $oTable->string('type', 20);

            $oTable->unique([
               'program_id',
               'hei_code',
               'type'
            ]);

            $oTable->foreign('program_id')->on('r_program')->references('id');
            $oTable->index(['hei_code', 'program_id']);
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
