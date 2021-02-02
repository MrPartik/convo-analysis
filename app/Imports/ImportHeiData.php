<?php

namespace App\Imports;

use App\Library\utils;
use App\Models\AcademicYearModel;
use App\Models\HeiDataCountModel;
use App\Models\HeiDataModel;
use App\Models\ProgramModel;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
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
        $aRow = \array_change_key_case($aRow, CASE_UPPER);
        $mProgramData = ProgramModel::where('program', utils::getNAForNull($aRow['PROGRAM']))
            ->where('major', utils::getNAForNull($aRow['MAJOR']))
            ->where('code', utils::getNAForNull($aRow['HEI_CODE']))
            ->first();
        if ($mProgramData === null) throw new \ErrorException('Please import the program data first, it seems that you are trying to import ' . \ucfirst($this->sType) . ' data that is not existing to program data!');
        $mHeiDataPrev = HeiDataModel::where('program_id', $mProgramData->id)
            ->where('type', $this->sType)
            ->first();
        if ($mHeiDataPrev !== null) {
            $iHeiDataId = $mHeiDataPrev->id;
        } else {
            $oHeiData = HeiDataModel::updateOrCreate([
                'program_id' => $mProgramData->id ?? null,
                'hei_code'   => @$aRow['HEI_CODE'] ?? null,
                'type'       => $this->sType
            ]);
            $iHeiDataId = $oHeiData->id;
        }
        foreach (AcademicYearModel::all() ?? [] as $aValue) {
            (isset($aRow[$aValue['year'] . '_' . 'M']) === true && isset($aRow[$aValue['year'] . '_' . 'F']) === true) && (HeiDataCountModel::updateOrCreate([
                'hei_data_id' => $iHeiDataId,
                'year'        => $aValue['year'],
                'm'           => $aRow[$aValue['year'] . '_' . 'M'],
                'f'           => $aRow[$aValue['year'] . '_' . 'F']
            ]));
        }
        return [];
    }
}
