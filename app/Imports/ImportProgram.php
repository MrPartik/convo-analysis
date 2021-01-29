<?php namespace App\Imports;

use App\Models\ProgramModel;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportProgram implements WithHeadingRow, ToModel, SkipsOnError, SkipsOnFailure, WithBatchInserts
{
    use SkipsErrors, SkipsFailures;

    public function model(array $aRow)
    {
        try {
            $aRow = \array_change_key_case($aRow, CASE_UPPER);
            return new ProgramModel([
                'code'                   => (isset($aRow['CODE']) === true) ? $aRow['CODE'] : @$aRow['INST_CODE'],
                'program'                => (isset($aRow['PROGRAM']) === true) ? $aRow['PROGRAM'] : @$aRow['DISCIPLINE'],
                'major'                  => $aRow['MAJOR'],
                'level_i'                => $aRow['LEVEL_I'] ?? 'N/A',
                'level_ii'               => $aRow['LEVEL_II'] ?? 'N/A',
                'level_iii'              => $aRow['LEVEL_III'] ?? 'N/A',
                'level_iv'               => $aRow['LEVEL_IV'] ?? 'N/A',
                'gr'                     => $aRow['GR'] ?? 'N/A',
                'accredited_level'       => $aRow['ACCREDITED_LEVEL'] ?? 'N/A',
                'accreditor'             => $aRow['ACCREDITOR'] ?? 'N/A',
                'validity'               => $aRow['VALIDITY'] ?? 'N/A',
                'coe_cod'                => $aRow['COE_COD'] ?? 'N/A',
                'autonomous_deregulated' => $aRow['AUTONOMOUS_DEREGULATED'] ?? 'N/A',
                'gpr'                    => $aRow['GPR'] ?? 'N/A',
                'gp_gr_no'               => $aRow['GP_GR_NO'] ?? 'N/A',
                'created_at'             => $aRow['DATE'] ?? 'N/A',
                'issued_by'              => $aRow['ISSUED_BY'] ?? 'N/A',
                'remarks'                => $aRow['REMARKS'] ?? 'N/A',
                'status'                 => $aRow['STATUS'] ?? 'N/A',
            ]);
        } catch (\Exception $oError) {
            return [];
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
