<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeiDataCountModel extends Model
{
    use HasFactory;

    protected $table = 'r_hei_data_count';
    public $timestamps = false;
    protected $fillable = [
        'hei_data_id',
        'semester',
        'year',
        'm',
        'f',
    ];
}
