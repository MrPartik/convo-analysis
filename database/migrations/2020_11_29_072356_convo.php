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
            $oTable->id();
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
            $oTable->dateTime('deleted')->nullable();
            $oTable->timestamps();

            $oTable->index(['user_id', 'reply_user_id']);
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
