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
            $oTable->id();
            $oTable->string('code')->nullable();
            $oTable->string('program')->nullable();
            $oTable->string('major')->nullable();
            $oTable->string('level_i')->nullable();
            $oTable->string('level_ii')->nullable();
            $oTable->string('level_iii')->nullable();
            $oTable->string('level_iv')->nullable();
            $oTable->string('gr')->nullable();
            $oTable->string('accredited_level')->nullable();
            $oTable->string('accreditor')->nullable();
            $oTable->string('validity')->nullable();
            $oTable->string('coe_cod')->nullable();
            $oTable->string('autonomous_deregulated')->nullable();
            $oTable->string('gpr')->nullable();
            $oTable->string('gp_gr_no')->nullable();
            $oTable->string('created_at')->nullable();
            $oTable->string('issued_by')->nullable();
            $oTable->string('remarks')->nullable();
            $oTable->string('status')->nullable();
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
