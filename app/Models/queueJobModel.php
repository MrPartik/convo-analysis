<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class queueJobModel extends Model
{
    use HasFactory;
    protected $table = 'r_queue_jobs';
    protected $fillable = [
        'file',
        'type',
        'is_imported'
    ];
}
