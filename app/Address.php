<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use TCG\Voyager\Traits\Spatial;

class Address extends Model
{

    use Spatial;
    protected $spatial = ['location'];

}
