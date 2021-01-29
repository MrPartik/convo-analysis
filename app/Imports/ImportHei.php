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
                'type'           => ($this->sType === 'N/A') ? $aRow['TYPE'] : $this->sType,
                'tel_no'         => $aRow['TEL_NUM'] ?? 'N/A',
                'city'           => $aRow['CITY'],
                'email'          => $aRow['EMAIL_ADDRESS'] ?? 'N/A',
                'fax_no'         => $aRow['FAX_NUM'] ?? 'N/A',
                'head_tel_no'    => $aRow['HEAD_TEL'] ?? 'N/A',
                'head'           => $aRow['HEAD'] ?? 'N/A',
                'head_title'     => $aRow['HEAD_TITLE'] ?? 'N/A',
                'head_hea'       => $aRow['HEAD_HEA'] ?? 'N/A',
                'official'       => $aRow['OFFICIAL'] ?? 'N/A',
                'official_title' => $aRow['OFFICIAL_TITLE'] ?? 'N/A',
                'official_hea'   => $aRow['OFFICIAL_HEA'] ?? 'N/A',
                'registrar'      => $aRow['REGISTRAR'] ?? 'N/A',
                'lo'             => $aRow['LO'] ?? 'N/A',
                'name1'          => $aRow['NAME1'] ?? 'N/A',
                'name2'          => $aRow['NAME2'] ?? 'N/A',
                'name3'          => $aRow['NAME3'] ?? 'N/A',
                'name4'          => $aRow['NAME4'] ?? 'N/A',
                'name5'          => $aRow['NAME5'] ?? 'N/A',
                'hei_type'       => $aRow['HEI_TYPE'] ?? 'N/A',
                'remarks'        => $aRow['REMARKS'] ?? 'N/A',
                'website'        => $aRow['WEBSITE'] ?? 'N/A',
                'yr_established' => (isset($aRow['YR_ESTABLISMENT']) === true) ? $aRow['YR_ESTABLISMENT'] : @$aRow['YR_ESTABLISHMENT'],
                'updated_by'     => $aRow['UPDATED_BY'] ?? 'N/A',
                'updated_at'     => $aRow['DATE_UPDATED'] ?? 'N/A',
                'status'         => $aRow['STATUS'] ?? 'N/A',
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
