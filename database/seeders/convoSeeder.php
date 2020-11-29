<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\convo;

class convoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oConvo = new convo();
        $oConvo->user_id = 1;
        $oConvo->message = 'Hello there!';
        $oConvo->save();

        $oConvo = new convo();
        $oConvo->user_id = 1;
        $oConvo->message = 'How may I help you?';
        $oConvo->save();

        $oConvo = new convo();
        $oConvo->user_id = 2;
        $oConvo->message = 'Give me the sum of enrolled students, please!';
        $oConvo->save();

        $oConvo = new convo();
        $oConvo->user_id = 1;
        $oConvo->message = 'Here is the list of enrolled students, {//shiny.rstudio.com}';
        $oConvo->url = '//shiny.rstudio.com';
        $oConvo->save();

    }
}
