<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Convo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_convo', function (Blueprint $oTable) {
            $oTable->bigIncrements('id');
            $oTable->unsignedBigInteger('user_id');
            $oTable->foreign('user_id')->on('users')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $oTable->unsignedBigInteger('reply_user_id');
            $oTable->foreign('reply_user_id')->on('users')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $oTable->text('message');
            $oTable->string('url')->nullable();
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
