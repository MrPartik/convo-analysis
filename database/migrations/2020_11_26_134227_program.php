<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $oTable->string('code', 50)->nullable();
            $oTable->text('program')->nullable();
            $oTable->unsignedBigInteger('program_category_id')->nullable();
            $oTable->text('major')->nullable();
            $oTable->string('level_i')->nullable();
            $oTable->string('level_ii')->nullable();
            $oTable->string('level_iii')->nullable();
            $oTable->string('level_iv')->nullable();
            $oTable->string('gr')->nullable();
            $oTable->string('accredited_level', 50)->nullable();
            $oTable->string('accreditor')->nullable();
            $oTable->string('validity')->nullable();
            $oTable->string('coe_cod')->nullable();
            $oTable->string('autonomous_deregulated')->nullable();
            $oTable->string('gpr')->nullable();
            $oTable->string('gp_gr_no')->nullable();
            $oTable->string('created_at')->nullable();
            $oTable->string('issued_by')->nullable();
            $oTable->string('remarks', 300)->nullable();
            $oTable->string('status')->nullable();
            $oTable->index(['code', 'program_category_id']);
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
