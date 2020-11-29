<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class convo extends Model
{
    use HasFactory;

    protected $table = 't_convo';

    protected $fillable = ['user_id', 'message', 'url', 'reply_user_id'];
}
