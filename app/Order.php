<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Order extends Model
{
    use Translatable;
    protected $translatable = ['address','description','name' ];
}
