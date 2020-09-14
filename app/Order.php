<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use Nagy\LaravelRating\Traits\Rate\Rateable;


class Order extends Model
{
    use Translatable ,  Rateable;

    protected $translatable = ['address','description','name' ];
    protected $fillable = ['id','date','time','name','description','image','address_id','companion','section' ,'expire','user_id','service_id','status' ];

    public function service(){
        return $this->belongsTo(Service::class ,'service_id');

    }    public function user(){
        return $this->belongsTo(User::class ,'user_id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

}
