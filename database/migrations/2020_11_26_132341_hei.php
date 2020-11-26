<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Hei extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_hei', function (Blueprint $oTable) {
            $oTable->bigIncrements('id');
            $oTable->string('region', 10);
            $oTable->string('code', 10);
            $oTable->string('hei_name', 200);
            $oTable->string('address', 200);
            $oTable->string('type', 50);
            $oTable->string('tel_no', 50);
            $oTable->string('email', 100);
            $oTable->string('fax_no', 50);
            $oTable->string('head_tel_no', 50);
            $oTable->string('head', 100);
            $oTable->string('head_title', 100);
            $oTable->string('head_hea', 20);
            $oTable->string('official', 20);
            $oTable->string('official_title', 100);
            $oTable->string('official_hea', 20);
            $oTable->string('registrar', 100);
            $oTable->string('name1', 100);
            $oTable->string('name2', 100);
            $oTable->string('name3', 100);
            $oTable->string('name4', 100);
            $oTable->string('name5', 100);
            $oTable->string('hei_type', 20);
            $oTable->string('remarks', 100);
            $oTable->string('website', 100);
            $oTable->string('yr_established', 10);
            $oTable->string('upload_by', 100);
            $oTable->string('upload_at', 50);
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
