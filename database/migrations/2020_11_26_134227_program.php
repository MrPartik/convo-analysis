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
            $oTable->string('code')->nullable();
            $oTable->text('program')->nullable();
            $oTable->unsignedBigInteger('program_category_id')->nullable();
            $oTable->text('major')->nullable();
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

            $oTable->unique([
                'code',
                'program',
                'major',
                'accredited_level',
                'gr',
                'level_i',
                'level_ii',
                'level_iii'
            ],'unique_cols');
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
