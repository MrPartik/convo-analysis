<?php namespace App\Imports;

use App\Library\utils;
use GPBMetadata\Google\Api\Auth;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportHei implements WithHeadingRow, ToModel, SkipsOnError, SkipsOnFailure, WithBatchInserts
{
    use SkipsErrors, SkipsFailures;

    private $oModel;
    private $sType;
    private $sRegion;
    private $bFollowExcelRegion;

    public function __construct($oModel, $sType, $bFollowExcelRegion)
    {
        $this->oModel = $oModel;
        $this->sType = $sType;
        $this->bFollowExcelRegion = $bFollowExcelRegion;
        $this->sRegion = Auth::user()->region;
    }

    public function model(array $aRow)
    {
        try {
            $aRow = \array_change_key_case($aRow, CASE_UPPER);
            if($this->oModel::where([
                ['region', ($this->bFollowExcelRegion === true) ? $this->sRegion : utils::getNAForNull(@$aRow['REGION'])],
                ['code', utils::getNAForNull(((isset($aRow['CODE']) === true) ? $aRow['CODE'] : @$aRow['INST_CODE']))],
                ['hei_name', utils::getNAForNull(@$aRow['HEI_NAME'])],
                ['address', utils::getNAForNull(@$aRow['ADDRESS'])]
            ])->first() !== null) return [];
            return new $this->oModel([
                'region'         => $this->sRegion ?? utils::getNAForNull(@$aRow['REGION']),
                'code'           => utils::getNAForNull(((isset($aRow['CODE']) === true) ? $aRow['CODE'] : @$aRow['INST_CODE'])),
                'hei_name'       => utils::getNAForNull(@$aRow['HEI_NAME']),
                'address'        => utils::getNAForNull(@$aRow['ADDRESS']),
                'type'           => ($this->sType === 'HEI') ? $aRow['TYPE'] : $this->sType,
                'tel_no'         => utils::getNAForNull(@$aRow['TEL_NUM']),
                'city'           => utils::getNAForNull(@$aRow['CITY']),
                'email'          => utils::getNAForNull(@$aRow['EMAIL_ADDRESS']),
                'fax_no'         => utils::getNAForNull(@$aRow['FAX_NUM']),
                'head_tel_no'    => utils::getNAForNull(@$aRow['HEAD_TEL']),
                'head'           => utils::getNAForNull(@$aRow['HEAD']),
                'head_title'     => utils::getNAForNull(@$aRow['HEAD_TITLE']),
                'head_hea'       => utils::getNAForNull(@$aRow['HEAD_HEA']),
                'official'       => utils::getNAForNull(@$aRow['OFFICIAL']),
                'official_title' => utils::getNAForNull(@$aRow['OFFICIAL_TITLE']),
                'official_hea'   => utils::getNAForNull(@$aRow['OFFICIAL_HEA']),
                'registrar'      => utils::getNAForNull(@$aRow['REGISTRAR']),
                'lo'             => utils::getNAForNull(@$aRow['LO']),
                'name1'          => utils::getNAForNull(@$aRow['NAME1']),
                'name2'          => utils::getNAForNull(@$aRow['NAME2']),
                'name3'          => utils::getNAForNull(@$aRow['NAME3']),
                'name4'          => utils::getNAForNull(@$aRow['NAME4']),
                'name5'          => utils::getNAForNull(@$aRow['NAME5']),
                'hei_type'       => utils::getNAForNull(@$aRow['HEI_TYPE']),
                'remarks'        => utils::getNAForNull(@$aRow['REMARKS']),
                'website'        => utils::getNAForNull(@$aRow['WEBSITE']),
                'yr_established' => utils::getNAForNull((isset($aRow['YR_ESTABLISMENT']) === true) ? $aRow['YR_ESTABLISMENT'] : @$aRow['YR_ESTABLISHMENT']),
                'updated_by'     => utils::getNAForNull(@$aRow['UPDATED_BY']),
                'updated_at'     => utils::getNAForNull(@$aRow['DATE_UPDATED']),
                'status'         => utils::getNAForNull(@$aRow['STATUS']),
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
