<?php

namespace App\Imports;

use App\Models\AcademicYearModel;
use App\Models\HeiDataCountModel;
use App\Models\HeiDataModel;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportHeiData implements WithHeadingRow, ToModel, SkipsOnError, SkipsOnFailure
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
            $mHeiDataPrev = HeiDataModel::where('region', $aRow['REGION'])
                ->where('hei', $aRow['HEI_NAME'])
                ->where('type', $this->sType)
                ->first();
            if ($mHeiDataPrev !== 'N/A') {
                $iHeiDataId = $mHeiDataPrev->id;
            } else {
                $oHeiData = HeiDataModel::updateOrCreate([
                    'hei'    => $aRow['HEI_NAME'] ?? 'N/A',
                    'region' => $aRow['REGION'] ?? 'N/A',
                    'type'   => $this->sType
                ]);
                $iHeiDataId = $oHeiData->id;
            }
            foreach (AcademicYearModel::all() ?? [] as $aValue) {
                (isset($aRow[$aValue['year']]) === true) && (HeiDataCountModel::updateOrCreate([
                    'hei_data_id' => $iHeiDataId,
                    'year'=> $aValue['year'],
                    'count' => $aRow[$aValue['year']]
                ]));
            }
            return [];
        } catch (\Exception $oError) {
            return [];
        }
    }
}
