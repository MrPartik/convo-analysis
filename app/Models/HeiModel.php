<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeiModel extends Model
{
    use HasFactory;

    protected $table = 'r_hei';
    public $timestamps = false;
    protected $fillable = [
        'region',
        'code',
        'hei_name',
        'address',
        'city',
        'type',
        'tel_no',
        'email',
        'fax_no',
        'head_tel_no',
        'head',
        'head_title',
        'head_hea',
        'official',
        'official_title',
        'official_hea',
        'registrar',
        'lo',
        'name1',
        'name2',
        'name3',
        'name4',
        'name5',
        'hei_type',
        'remarks',
        'website',
        'yr_established',
        'upload_by',
        'upload_at',
        'status'
    ];
}
