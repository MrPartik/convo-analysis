<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\convoModel;

class convoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oConvo = new convoModel();
        $oConvo->user_id = 1;
        $oConvo->message = 'Hello there!';
        $oConvo->reply_user_id = 2;
        $oConvo->save();

        $oConvo = new convoModel();
        $oConvo->user_id = 1;
        $oConvo->message = 'How may I help you?';
        $oConvo->reply_user_id = 2;
        $oConvo->save();

        $oConvo = new convoModel();
        $oConvo->user_id = 2;
        $oConvo->message = 'Give me the sum of enrolled students, please!';
        $oConvo->reply_user_id = 1;
        $oConvo->save();

        $oConvo = new convoModel();
        $oConvo->user_id = 1;
        $oConvo->message = 'Here is the list of enrolled students';
        $oConvo->url = '//gallery.shinyapps.io/084-single-file';
        $oConvo->reply_user_id = 2;
        $oConvo->save();

    }
}
