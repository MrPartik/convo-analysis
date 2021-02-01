<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramModel extends Model
{
    use HasFactory;

    protected $table = 'r_program';
    public $timestamps = false;
    protected $fillable = [
        'code',
        'name',
        'major',
        'program',
        'program_category_id',
        'level_i',
        'level_ii',
        'level_iii',
        'gr',
        'accredited_level',
        'accreditor',
        'validity',
        'coe_cod',
        'autonomous_deregulated',
        'gpr',
        'gp_gr_no',
        'created_at',
        'issued_by',
        'remarks',
        'status'
    ];
}
