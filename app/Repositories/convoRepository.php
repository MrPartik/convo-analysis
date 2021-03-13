<?php namespace App\Repositories;

use App\Models\ConvoModel;
use App\WitApp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Bool_;

class convoRepository
{
    /**
     * Getting convo per login
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getConvoPerLogin()
    {
        return ConvoModel::with(['repliedUser', 'messageUser'])->where('user_id', Auth::id())
            ->orWhere('reply_user_id', '=', Auth::id())
            ->orWhere('reply_user_id', '=' , 0)
            ->get();
    }


    public function getDataByInstitution(string $sType, $mBy, bool $bIsEnrollmentData = true) {
        return DB::select(
            'select hdc.year year, hei.region region, hei.hei_name hei, progc.title category, prog.program program, count(hdc.year) total
                    from r_hei_data_count hdc
                    join r_hei_data hd on hdc.hei_data_id = hd.id
                    join r_program prog on hd.program_id = prog.id
                    join r_hei hei on prog.code = hei.code
                    join r_program_categories progc on progc.id = prog.program_category_id
                    where  hd.type = ? and (?) group by hdc.year, hei.region, prog.program',
            [(($bIsEnrollmentData === true) ? 'ENROLLMENT' : 'GRADUATE'), $sType]);
    }


}
