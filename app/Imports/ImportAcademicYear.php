<?php

namespace App\Imports;

use App\Library\utils;
use App\Models\AcademicYearModel;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportAcademicYear implements WithHeadingRow, ToModel, SkipsOnError, SkipsOnFailure, WithBatchInserts
{
    use SkipsErrors, SkipsFailures;

    public function model(array $aRow)
    {
        try {
            $aRow = \array_change_key_case($aRow, CASE_UPPER);
            return new AcademicYearModel([
                'year' => utils::getNAForNull($aRow['YEAR'])
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
