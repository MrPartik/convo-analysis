<?php

namespace Database\Seeders;

use App\Models\UserModel;
use Illuminate\Database\Seeder;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oUser = new UserModel();
        $oUser->id = 1;
        $oUser->name = 'Administrator';
        $oUser->email = 'administrator@gmail.com';
        $oUser->role = 'admin';
        $oUser->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $oUser->save();

        $oUser = new UserModel();
        $oUser->id = 2;
        $oUser->name = 'Top Management';
        $oUser->email = 'top.management@gmail.com';
        $oUser->role = 'user';
        $oUser->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $oUser->save();
    }
}
