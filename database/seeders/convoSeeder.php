<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\ConvoModel;

class convoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oConvo = new ConvoModel();
        $oConvo->user_id = 1;
        $oConvo->message = 'Hello there!';
        $oConvo->save();

        $oConvo = new ConvoModel();
        $oConvo->user_id = 1;
        $oConvo->message = 'How may I help you?';
        $oConvo->save();

    }
}
