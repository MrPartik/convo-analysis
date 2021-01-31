<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramCategoryModel extends Model
{
    use HasFactory;

    protected $table = 'r_program_categories';
    public $timestamps = false;
    protected $fillable = [
        'code',
        'title',
        'parent_program_id'
    ];
}
