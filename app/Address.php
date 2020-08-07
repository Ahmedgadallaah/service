<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use TCG\Voyager\Traits\Spatial;
use TCG\Voyager\Traits\Translatable;

class Address extends Model
{
    use Translatable;
    use Spatial;


    protected $fillable = ['address' , 'location','user_id'];
    protected $translatable = ['address'];
    protected $spatial = ['location'];

}
