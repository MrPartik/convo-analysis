<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oUser = new User();
        $oUser->name = 'John Patrick Loyola';
        $oUser->email = 'loyolapat04@gmail.com';
        $oUser->role = 'user';
        $oUser->password = password_hash('password', 'md5');
        $oUser->save();

        $oUser = new User();
        $oUser->name = 'Ma. Michaela Alejandria';
        $oUser->email = 'mikaalej@gmail.com';
        $oUser->role = 'admin';
        $oUser->password = password_hash('password', 'md5');
        $oUser->save();
    }
}
