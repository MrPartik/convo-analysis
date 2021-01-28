<?php

namespace App\Imports;

use App\Models\StudentDataModel;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportStudentData implements WithHeadingRow, ToModel, SkipsOnError, SkipsOnFailure, WithBatchInserts
{
    use SkipsErrors, SkipsFailures;

    private $sType;

    public function __construct($sType)
    {
        $this->sType = $sType;
    }

    public function model(array $aRow)
    {
        try {
            $aRow = \array_change_key_case($aRow, CASE_UPPER);
            return new StudentDataModel([
                'year'   => $aRow['YEAR'] ?? null,
                'hei'    => $aRow['HEI_NAME'] ?? null,
                'region' => $aRow['REGION'] ?? null,
                'type'   => $this->sType
            ]);
        } catch (\ErrorException $oError) {
            return [];
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
