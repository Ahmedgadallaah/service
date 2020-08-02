<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class City extends Model
{
    use Translatable;
    protected $fillable = ['name','country_id'];
    protected $translatable = ['name'];
}
