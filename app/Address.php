<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use TCG\Voyager\Traits\Spatial;
use TCG\Voyager\Traits\Translatable;

class Address extends Model
{
    use Translatable;
    use Spatial;



    protected $fillable = ['address','status','location','user_id'];
    protected $translatable = ['address'];
    protected $spatial = ['location'];


    public function user(){
        return $this->belongsTo(User::class ,'user_id');
    }


}
