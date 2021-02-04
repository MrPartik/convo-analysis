<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $oTable->id();
            $oTable->string('region', 10)->nullable();
            $oTable->string('code', 20)->nullable();
            $oTable->text('hei_name')->nullable();
            $oTable->text('address')->nullable();
            $oTable->string('city')->nullable();
            $oTable->string('type')->nullable();
            $oTable->string('tel_no')->nullable();
            $oTable->string('fax_no')->nullable();
            $oTable->string('email')->nullable();
            $oTable->string('head_tel_no')->nullable();
            $oTable->string('head')->nullable();
            $oTable->string('head_title')->nullable();
            $oTable->string('head_hea')->nullable();
            $oTable->string('official')->nullable();
            $oTable->string('official_title')->nullable();
            $oTable->string('official_hea')->nullable();
            $oTable->string('registrar')->nullable();
            $oTable->string('lo')->nullable();
            $oTable->string('name1')->nullable();
            $oTable->string('name2')->nullable();
            $oTable->string('name3')->nullable();
            $oTable->string('name4')->nullable();
            $oTable->string('name5')->nullable();
            $oTable->string('website')->nullable();
            $oTable->string('hei_type')->nullable();
            $oTable->string('remarks')->nullable();
            $oTable->string('yr_established')->nullable();
            $oTable->string('updated_by')->nullable();
            $oTable->string('updated_at')->nullable();
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
