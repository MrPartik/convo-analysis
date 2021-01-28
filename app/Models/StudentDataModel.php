<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDataModel extends Model
{
    use HasFactory;

    protected $table = 'r_student_data';
    public $timestamps = false;
    protected $fillable = [
        'year',
        'hei',
        'region',
        'type'
    ];
}
