<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RProgramCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_program_categories', function (Blueprint $oTable) {
            $oTable->id();
            $oTable->string('code', 20)->nullable();
            $oTable->string('title');
        });

        DB::statement('ALTER TABLE r_program_categories ADD FULLTEXT program_category(title)');
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
