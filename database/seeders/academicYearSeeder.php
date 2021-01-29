<?php

namespace Database\Seeders;

use App\Models\AcademicYearModel;
use Illuminate\Database\Seeder;

class academicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new AcademicYearModel([
            'year' => '2017'
        ]))->save();
        (new AcademicYearModel([
            'year' => '2018'
        ]))->save();
        (new AcademicYearModel([
            'year' => '2019'
        ]))->save();
        (new AcademicYearModel([
            'year' => '2020'
        ]))->save();
    }
}
