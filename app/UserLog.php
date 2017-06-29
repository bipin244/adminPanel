<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'user_id', 'action','created_at','updated_at'
    ];
}
