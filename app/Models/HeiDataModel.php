<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeiDataModel extends Model
{
    use HasFactory;

    protected $table = 'r_hei_data';
    public $timestamps = false;
    protected $fillable = [
        'hei',
        'region',
        'type'
    ];
}
