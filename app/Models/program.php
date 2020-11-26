<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class program extends Model
{
    use HasFactory;

    protected $table = 'r_program';
    public $timestamps = false;
    protected $fillable = [
        'region',
        'code',
        'hei_name',
        'type',
        'city',
        'discipline',
        'major',
        'level_i',
        'level_ii',
        'level_iii',
        'gr',
        'accredited_level',
        'accreditor',
        'validity',
        'coe_cod',
        'anonymous_deregulated',
        'gpr',
        'gpr_gr_no',
        'created_at',
        'issued_by',
        'remarks',
        'status'
    ];
}
