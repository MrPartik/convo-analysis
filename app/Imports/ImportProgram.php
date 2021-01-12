<?php namespace App\Imports;

use App\Models\ProgramModel;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Validators\Failure;

class ImportProgram implements WithHeadingRow, ToModel, SkipsOnError, SkipsOnFailure, WithBatchInserts
{
    use SkipsErrors, SkipsFailures;

    public function batchSize(): int
    {
        return 1000;
    }

    public function model(array $aRow)
    {
        try {
            $aRow = \array_change_key_case($aRow, CASE_UPPER);
            return new ProgramModel([
                'code'                   => (isset($aRow['CODE']) === true) ? $aRow['CODE'] : $aRow['INST_CODE'],
                'program'                => (isset($aRow['PROGRAM']) === true) ? $aRow['PROGRAM'] : $aRow['DISCIPLINE'],
                'major'                  => $aRow['MAJOR'],
                'level_i'                => $aRow['LEVEL_I']  ?? null,
                'level_ii'               => $aRow['LEVEL_II']  ?? null,
                'level_iii'              => $aRow['LEVEL_III']  ?? null,
                'level_iv'               => $aRow['LEVEL_IV'] ?? null,
                'gr'                     => $aRow['GR'],
                'accredited_level'       => $aRow['ACCREDITED_LEVEL'],
                'accreditor'             => $aRow['ACCREDITOR'],
                'validity'               => $aRow['VALIDITY'],
                'coe_cod'                => $aRow['COE_COD'],
                'autonomous_deregulated' => $aRow['AUTONOMOUS_DEREGULATED'],
                'gpr'                    => $aRow['GPR'],
                'gp_gr_no'               => $aRow['GP_GR_NO'],
                'created_at'             => $aRow['DATE'],
                'issued_by'              => $aRow['ISSUED_BY'],
                'remarks'                => $aRow['REMARKS'],
                'status'                 => $aRow['STATUS'],
            ]);
        } catch (\ErrorException $oError) {
            return [];
        }
    }
}
