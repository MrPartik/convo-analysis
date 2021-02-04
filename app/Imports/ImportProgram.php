<?php namespace App\Imports;

use App\Library\utils;
use App\Models\ProgramModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportProgram implements WithHeadingRow, ToModel, SkipsOnFailure, WithBatchInserts, ShouldQueue, WithChunkReading
{
    use SkipsErrors, SkipsFailures;

    public function model(array $aRow)
    {
        try {
            $aRow = \array_change_key_case($aRow, CASE_UPPER);
            if(ProgramModel::where([
                ['code', utils::getNAForNull(((isset($aRow['CODE']) === true) ? $aRow['CODE'] : @$aRow['INST_CODE']))],
                ['program', utils::getNAForNull(((isset($aRow['PROGRAM']) === true) ? $aRow['PROGRAM'] : @$aRow['DISCIPLINE']))],
                ['major', utils::getNAForNull(@$aRow['MAJOR'])],
                ['level_i', utils::getNAForNull(@$aRow['LEVEL_I'])],
                ['level_ii', utils::getNAForNull(@$aRow['LEVEL_II'])],
                ['level_iii', utils::getNAForNull(@$aRow['LEVEL_III'])],
                ['gr', utils::getNAForNull(@$aRow['GR'])],
                ['accredited_level', utils::getNAForNull(@$aRow['ACCREDITED_LEVEL'])],
            ])->first() !== null) return [];
            return new ProgramModel([
                'code'                   => utils::getNAForNull(((isset($aRow['CODE']) === true) ? $aRow['CODE'] : @$aRow['INST_CODE'])),
                'program'                => utils::getNAForNull(((isset($aRow['PROGRAM']) === true) ? $aRow['PROGRAM'] : @$aRow['DISCIPLINE'])),
                'program_category_id'    => $this->getCategoryId(utils::getNAForNull(((isset($aRow['PROGRAM']) === true) ? $aRow['PROGRAM'] : @$aRow['DISCIPLINE']))),
                'major'                  => utils::getNAForNull(@$aRow['MAJOR']),
                'level_i'                => utils::getNAForNull(@$aRow['LEVEL_I']),
                'level_ii'               => utils::getNAForNull(@$aRow['LEVEL_II']),
                'level_iii'              => utils::getNAForNull(@$aRow['LEVEL_III']),
                'level_iv'               => utils::getNAForNull(@$aRow['LEVEL_IV']),
                'gr'                     => utils::getNAForNull(@$aRow['GR']),
                'accredited_level'       => utils::getNAForNull(@$aRow['ACCREDITED_LEVEL']),
                'accreditor'             => utils::getNAForNull(@$aRow['ACCREDITOR']),
                'validity'               => utils::getNAForNull(@$aRow['VALIDITY']),
                'coe_cod'                => utils::getNAForNull(@$aRow['COE_COD']),
                'autonomous_deregulated' => utils::getNAForNull(@$aRow['AUTONOMOUS_DEREGULATED']),
                'gpr'                    => utils::getNAForNull(@$aRow['GPR']),
                'gp_gr_no'               => utils::getNAForNull(@$aRow['GP_GR_NO']),
                'created_at'             => utils::getNAForNull(@$aRow['DATE']),
                'issued_by'              => utils::getNAForNull(@$aRow['ISSUED_BY']),
                'remarks'                => utils::getNAForNull(@$aRow['REMARKS']),
                'status'                 => utils::getNAForNull(@$aRow['STATUS']),
            ]);
        } catch (\Exception $oError) {
            return [];
        }
    }

    private function getCategoryId($mProgram)
    {
        if ($mProgram === null || $mProgram === 'N/A')
            return null;
        $oProgCat = \collect(DB::select('select id from r_program_categories where match(title) against(?) > 1 limit 1', [$mProgram]))->first();
        return $oProgCat->id ?? null;
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
