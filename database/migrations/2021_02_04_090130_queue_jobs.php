<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QueueJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_queue_jobs', function (Blueprint $oTable) {
            $oTable->id();
            $oTable->string('file');
            $oTable->string('url');
            $oTable->string('type');
            $oTable->string('error')->nullable();
            $oTable->boolean('is_imported')->default(0);
            $oTable->timestamps();
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
