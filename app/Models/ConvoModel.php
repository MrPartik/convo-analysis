<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ConvoModel extends Model
{
    use HasFactory;

    protected $table = 't_convo';

    protected $fillable = ['user_id', 'message', 'url', 'reply_user_id'];

    public function repliedUser()
    {
        return $this->hasOne(UserModel::class, 'id', 'reply_user_id');
    }

    public function messageUser()
    {
        return $this->hasOne(UserModel::class, 'id', 'user_id');
    }
}
