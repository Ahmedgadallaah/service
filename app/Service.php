<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Service extends Model
{
    use Translatable;
    protected $fillable = ['name','image'];
    protected $translatable = ['name'];

}
