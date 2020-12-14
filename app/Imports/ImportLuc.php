<?php namespace App\Imports;

use App\Models\HeiModel;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportLuc implements WithHeadingRow, ToModel, SkipsOnError, SkipsOnFailure
{
    use SkipsErrors, SkipsFailures;

    public function model(array $aRow)
    {
        try {
            $aRow = \array_change_key_case($aRow, CASE_UPPER);
            return new HeiModel([
                'region'         => $aRow['REGION'],
                'code'           => (isset($aRow['CODE']) === true) ? $aRow['CODE'] : $aRow['INST_CODE'],
                'hei_name'       => $aRow['HEI_NAME'],
                'address'        => $aRow['ADDRESS'],
                'type'           => 'LUC',
                'tel_no'         => $aRow['TEL_NUM'],
                'city'           => $aRow['CITY'],
                'email'          => $aRow['EMAIL_ADDRESS'],
                'fax_no'         => $aRow['FAX_NUM'],
                'head_tel_no'    => $aRow['HEAD_TEL'],
                'head'           => $aRow['HEAD'],
                'head_title'     => $aRow['HEAD_TITLE'],
                'head_hea'       => $aRow['HEAD_HEA'],
                'official'       => $aRow['OFFICIAL'],
                'official_title' => $aRow['OFFICIAL_TITLE'],
                'official_hea'   => $aRow['OFFICIAL_HEA'],
                'registrar'      => $aRow['REGISTRAR'],
                'lo'             => $aRow['LO'],
                'name1'          => $aRow['NAME1'],
                'name2'          => $aRow['NAME2'],
                'name3'          => $aRow['NAME3'],
                'name4'          => $aRow['NAME4'],
                'name5'          => $aRow['NAME5'],
                'hei_type'       => $aRow['HEI_TYPE'],
                'remarks'        => $aRow['REMARKS'],
                'website'        => $aRow['WEBSITE'],
                'yr_established' => (isset($aRow['YR_ESTABLISMENT']) === true) ? $aRow['YR_ESTABLISMENT'] : $aRow['YR_ESTABLISHMENT'],
                'updated_by'     => $aRow['UPDATED_BY'],
                'updated_at'     => $aRow['DATE_UPDATED'],
                'status'         => $aRow['STATUS'],
            ]);
        } catch (\ErrorException $oError) {
            return [];
        }
    }
}
