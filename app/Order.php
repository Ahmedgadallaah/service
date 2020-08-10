<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Order extends Model
{
    use Translatable;
    protected $translatable = ['address','description','name' ];
    protected $fillable = ['date','time','name','description','image','address','money','expire','user_id','service_id' ];

    public function service(){
        return $this->belongsTo(Service::class ,'service_id');

    }    public function user(){
        return $this->belongsTo(User::class ,'user_id');
    }
}
