<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Order extends Model
{
    use Translatable;
    protected $translatable = ['address','description','name' ];
    protected $fillable = ['date','time','name','description','image','address','money','expire','user_id','service_id' ];
}
