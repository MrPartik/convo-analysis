<?php

namespace Database\Seeders;

use App\Models\ProgramCategoryModel;
use Illuminate\Database\Seeder;

class programCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aProgramList = [
            "Architecture",
            "Biology",
            "Commerce",
            "Agricultural Technology / Environmental Science, Horticulture",
            "Nursing and Midwifery",
            "Accountancy / Accounting",
            "Finance",
            "Design and the Built Environment",
            "Arts, History and Letters",
            "Business Administration and Entrepreneurship",
            "Communication and Journalism",
            "Computer Science and Information Technology",
            "Education",
            "Music",
            "Theology",
            "Missiology",
            "Criminology",
            "Engineering",
            "Human Kinetics",
            "Law",
            "Psychology",
            "Chemistry",
            "Geology",
            "Political Science and Public Administration",
            "Social Sciences and Development",
            "Tourism, Hospitality and Transportation Management",
        ];

        foreach ($aProgramList as $sPrograms) {
            $oParent = new ProgramCategoryModel();
            $oParent->title = $sPrograms;
            $oParent->save();
        }
    }
}
