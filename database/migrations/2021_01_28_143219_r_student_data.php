<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RStudentData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_student_data', function (Blueprint $oTable) {
            $oTable->id();
            $oTable->string('year', 20);
            $oTable->string('hei');
            $oTable->string('region', 20);
            $oTable->string('count', 20)->nullable();
            $oTable->string('type', 20);

            $oTable->unique([
               'year',
               'hei',
               'region',
               'count',
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
