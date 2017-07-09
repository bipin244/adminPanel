<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parts extends Model
{
    use SoftDeletes; 
    use Notifiable;
    public $timestamps = true;
    protected $dates = ['deleted_at'];/**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name','avg_price','description','created_id','modified_id','created_at','updated_at'
    ];
}
