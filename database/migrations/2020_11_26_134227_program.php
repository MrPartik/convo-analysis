<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Program extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_program', function (Blueprint $oTable) {
            $oTable->bigIncrements('id');
            $oTable->string('region', 10);
            $oTable->string('code', 10);
            $oTable->string('hei_name', 200);
            $oTable->string('type', 10);
            $oTable->string('city', 50);
            $oTable->string('discipline', 100);
            $oTable->string('major', 50);
            $oTable->string('level_i', 50);
            $oTable->string('level_ii', 50);
            $oTable->string('level_iii', 50);
            $oTable->string('gr', 50);
            $oTable->string('accredited_level', 50);
            $oTable->string('accreditor', 50);
            $oTable->string('validity', 50);
            $oTable->string('coe_cod', 50);
            $oTable->string('anonymous_deregulated', 50);
            $oTable->string('gpr', 50);
            $oTable->string('gpr_gr_no', 50);
            $oTable->string('created_at', 50);
            $oTable->string('issued_by', 50);
            $oTable->string('remarks', 100);
            $oTable->string('status', 50);
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
