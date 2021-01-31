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
            "Accountancy and Finance"                            => [
                "BSA"      => "Bachelor of Science in Accountancy",
                "BSMA"     => "Bachelor of Science in Management Accounting",
                "BSBAFM"   => "Bachelor of Science in Business Administration Major in Financial Management",
                "BSAMA"    => "Bachelor of Science in Airline Management Accountancy",
                "MSA"      => "Master of Science in Accountancy",
                "BSAE-BSA" => "Bachelor of Science in Applied Economics and Bachelor of Science in Accountancy",
                "BSACBAS"  => "Bachelor of Science in Accountancy and Computer-based Accounting System",
                "BSBAA"    => "Bachelor of Science in Business Administration and Accountancy",
                "MA"       => "Master in Accountancy",
                "BSF"      => "Bachelor of Science in Finance ",
                "MSCF"     => "Master of Science in Computational Finance",
                "BBF"      => "Bachelor in Banking and Finance",
                "BSFMA"    => "Bachelor of Science in Finance and Management Accounting"
            ],
            "Design and the Built Environment"                   => [
                "BS-ARCHI" => "Bachelor of Science in Architecture",
                "BSID"     => "Bachelor of Science in Interior Design",
                "BSLUDM"   => "Bachelor of Science in Land Use Design Management",
                "BSLDM"    => "Bachelor of Science in Landscape, Design and Management",
                "BID"      => "Bachelor of Industrial Design",
                "BSID"     => "Bachelor of Science in Industrial Design",
                "BFAD"     => "Bachelor of Fine Arts and Design",
                "MID"      => "Master of Interior Design"
            ],
            "Arts and Letters"                                   => [
                "ABELS"    => "Bachelor of Arts in English Language Studies",
                "ABF"      => "Bachelor of Arts in Filipinology",
                "ABLCS"    => "Bachelor of Arts in Literary and Cultural Studies",
                "AB-PHILO" => "Bachelor of Arts in Philosophy",
                "BPEA"     => "Bachelor of Performing Arts major in Theater Arts"
            ],
            "Business Administration"                            => [
                "DBA"      => "Doctor in Business Administration",
                "MBA"      => "Master in Business Administration",
                "BSBAHRM"  => "Bachelor of Science in Business Administration major in Human Resource Management",
                "BSBA-MM"  => "Bachelor of Science in Business Administration major in Marketing Management",
                "BSENTREP" => "Bachelor of Science in Entrepreneurship",
                "BSOA"     => "Bachelor of Science in Office Administration"
            ],
            "Communication"                                      => [
                "BADPR"           => "Bachelor in Advertising and Public Relations",
                "BA-Broadcasting" => "Bachelor of Arts in Broadcasting",
                "BACR"            => "Bachelor of Arts in Communication Research",
                "BAJ"             => "Bachelor of Arts in Journalism"
            ],
            "Computer and Information Sciences"                  => [
                "BSCS"   => "Bachelor of Science in Computer Science",
                "BSIT"   => "Bachelor of Science in Information Techno,logy",
                "MGD"    => "Master in Game Design",
                "BAPD"   => "Bachelor of Arts in Production Design",
                "BAFDT"  => "Bachelor of Arts in Fashion Design and Technology",
                "BAMAD"  => "Bachelor of Arts in Multimedia Arts and Design",
                "BAMPSD" => "Bachelor of Arts in Music Production and Sound Design",
                "BAPDD"  => "Bachelor of Arts in Production Design and Development",
                "BAFDM"  => "Bachelor of Arts in Fashion Design and Marketing",
                "BSGD"   => "Bachelor of Science in Graphic Design"
            ],
            "Education"                                          => [
                "DEM"       => "Doctor in Educational Management",
                "MBE"       => "Master in Business Education",
                "MEM"       => "Master in Educational Management",
                "MLIS"      => "Master in Library and Information Science",
                "MPES"      => "Master in Physical Education and Sports",
                "MAELT"     => "Master of Arts in English Language Teaching",
                "MSME"      => "Master of Science in Mathematics Education",
                "PB-DALS"   => "Post Baccalaureate Diploma in Alternative Learning System",
                "PB-TE"     => "Post Baccalaureate in Teacher Education",
                "BEED"      => "Bachelor in Elementary Education",
                "BLIS"      => "Bachelor in Library and Information Science",
                "BBTLEDHE"  => "Bachelor of Business Technology and Livelihood Education major in Home Economics",
                "BBTLEDIA"  => "Bachelor of Business Technology and Livelihood Education major in Industrial Arts",
                "BBTLEDICT" => "Bachelor of Business Technology and Livelihood Education major in Information and Communication Technology",
                "BECED"     => "Bachelor of Early Childhood Education",
                "BSEDEN"    => "Bachelor of Secondary Education major in English",
                "BSEDFL"    => "Bachelor of Secondary Education major in Filipino",
                "BSEDMT"    => "Bachelor of Secondary Education major in Mathematics",
                "BSEDSC"    => "Bachelor of Secondary Education major in Science",
                "BSEDSS"    => "Bachelor of Secondary Education major in Social Studies",
                "BTVEDFSM"  => "Bachelor of Technical Vocational Education major in Food Service Management"
            ],
            "Engineering"                                        => [
                "BSCE"  => "Bachelor of Science in Civil Engineering",
                "BSCOE" => "Bachelor of Science in Computer Engineering",
                "BSEE"  => "Bachelor of Science in Electrical Engineering",
                "BSECE" => "Bachelor of Science in Electronics Engineering",
                "BSIE"  => "Bachelor of Science in Industrial Engineering",
                "BSME"  => "Bachelor of Science in Mechanical Engineering",
                "BSRE"  => "Bachelor of Science in Railway Engineering"
            ],
            "Human Kinetics"                                     => [
                "BPE"   => "Bachelor of Physical Education",
                "BSESS" => "Bachelor of Science in Exercises and Sports"
            ],
            "Law"                                                => [
                "JD"    => "Juris Doctor",
                "BSLEA" => "Bachelor of Science in Law Enforcement Administration",
                "IML"   => "International Master of Laws",
                "ML"    => "Master of Laws",
                "DCL"   => "Doctor of Civil Law",
                "MACL"  => "Master of Arts in Cannon Law"
            ],
            "Political Science and Public Administration"        => [
                "BPA"  => "Bachelor of Public Administration",
                "BAIS" => "Bachelor of Arts in International Studies",
                "BAPE" => "Bachelor of Arts in Political Economy",
                "BAPS" => "Bachelor of Arts in Political Science"
            ],
            "Social Sciences and Development"                    => [
                "BAH"   => "Bachelor of Arts in History",
                "BAS"   => "Bachelor of Arts in Sociology",
                "BSC"   => "Bachelor of Science in Cooperatives",
                "BSE"   => "Bachelor of Science in Economics",
                "BSPSY" => "Bachelor of Science in Psychology"
            ],
            "Science"                                            => [
                "BSFT"     => "Bachelor of Science Food Technology",
                "BSAPMATH" => "Bachelor of Science in Applied Mathematics",
                "BSBIO"    => "Bachelor of Science in Biology",
                "BSCHEM"   => "Bachelor of Science in Chemistry",
                "BSMATH"   => "Bachelor of Science in Mathematics",
                "BSND"     => "Bachelor of Science in Nutrition and Dietetics",
                "BSPHY"    => "Bachelor of Science in Physics",
                "BSSTAT"   => "Bachelor of Science in Statistics"
            ],
            "Tourism, Hospitality and Transportation Management" => [
                "BSHM"  => "Bachelor of Science in Hospitality Management",
                "BSTM"  => "Bachelor of Science in Tourism Management",
                "BSTRM" => "Bachelor of Science in Transportation Management"
            ]
        ];

        foreach ($aProgramList as $sParent => $aPrograms) {
            $oParent = new ProgramCategoryModel();
            $oParent->title = $sParent;
            $oParent->save();
            foreach ($aPrograms as $mKey => $mVal) {
                ProgramCategoryModel::updateOrCreate([
                    'title'             => $mVal,
                    'code'              => $mKey,
                    'parent_program_id' => $oParent->id
                ]);
            }
        }
    }
}
