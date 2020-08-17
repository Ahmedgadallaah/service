<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//use TCG\Voyager\Traits\Translatable;
class Offer extends Model
{
    //use Translatable;
    protected $fillable = ['price','type','order_id','user_id' ];
    //protected $translatable = ['address','description','name' ];

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}
