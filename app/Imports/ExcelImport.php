<?php

namespace App\Imports;

use App\Models\HeiModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExcelImport implements WithHeadingRow, ToModel
{
    public function model(array $row)
    {
        return new HeiModel([
            'region'     => $row['sample'],
            'code'    => $row['sample'],
            'hei_name' => $row['sample'],
            'address' => $row['sample'],
            'type' => $row['sample'],
            'tel_no' => $row['sample'],
            'email' => $row['sample'],
            'fax_no' => $row['sample'],
            'head_tel_no' => $row['sample'],
            'head' => $row['sample'],
            'head_title' => $row['sample'],
            'head_hea' => $row['sample'],
            'official' => $row['sample'],
            'official_title' => $row['sample'],
            'official_hea' => $row['sample'],
            'registrar' => $row['sample'],
            'name1' => $row['sample'],
            'name2' => $row['sample'],
            'name3' => $row['sample'],
            'name4' => $row['sample'],
            'name5' => $row['sample'],
            'hei_type' => $row['sample'],
            'remarks' => $row['sample'],
            'website' => $row['sample'],
            'yr_established' => $row['sample'],
            'upload_by' => $row['sample'],
            'upload_at' => $row['sample'],
            'status' => $row['sample'],
        ]);
    }
}
