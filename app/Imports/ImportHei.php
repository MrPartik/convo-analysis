<?php namespace App\Imports;

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

    public function __construct($oModel, $sType)
    {
        $this->oModel = $oModel;
        $this->sType = $sType;
    }

    public function model(array $aRow)
    {
        try {
            $aRow = \array_change_key_case($aRow, CASE_UPPER);
            return new $this->oModel([
                'region'         => $aRow['REGION'],
                'code'           => (isset($aRow['CODE']) === true) ? $aRow['CODE'] : @$aRow['INST_CODE'],
                'hei_name'       => $aRow['HEI_NAME'],
                'address'        => $aRow['ADDRESS'],
                'type'           => ($this->sType === null) ? $aRow['TYPE'] : $this->sType,
                'tel_no'         => $aRow['TEL_NUM'] ?? null,
                'city'           => $aRow['CITY'],
                'email'          => $aRow['EMAIL_ADDRESS'] ?? null,
                'fax_no'         => $aRow['FAX_NUM'] ?? null,
                'head_tel_no'    => $aRow['HEAD_TEL'] ?? null,
                'head'           => $aRow['HEAD'] ?? null,
                'head_title'     => $aRow['HEAD_TITLE'] ?? null,
                'head_hea'       => $aRow['HEAD_HEA'] ?? null,
                'official'       => $aRow['OFFICIAL'] ?? null,
                'official_title' => $aRow['OFFICIAL_TITLE'] ?? null,
                'official_hea'   => $aRow['OFFICIAL_HEA'] ?? null,
                'registrar'      => $aRow['REGISTRAR'] ?? null,
                'lo'             => $aRow['LO'] ?? null,
                'name1'          => $aRow['NAME1'] ?? null,
                'name2'          => $aRow['NAME2'] ?? null,
                'name3'          => $aRow['NAME3'] ?? null,
                'name4'          => $aRow['NAME4'] ?? null,
                'name5'          => $aRow['NAME5'] ?? null,
                'hei_type'       => $aRow['HEI_TYPE'] ?? null,
                'remarks'        => $aRow['REMARKS'] ?? null,
                'website'        => $aRow['WEBSITE'] ?? null,
                'yr_established' => (isset($aRow['YR_ESTABLISMENT']) === true) ? $aRow['YR_ESTABLISMENT'] : @$aRow['YR_ESTABLISHMENT'],
                'updated_by'     => $aRow['UPDATED_BY'] ?? null,
                'updated_at'     => $aRow['DATE_UPDATED'] ?? null,
                'status'         => $aRow['STATUS'] ?? null,
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
