<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartToVendor extends Model
{
    public $timestamps = true;
    protected $table = 'parts_to_vendor';
    /* The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'part_id','vendor_id','vendor_last_price','vendor_last_price_date','created_at','updated_at'
    ];
}
