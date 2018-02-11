<?php

namespace Modules\Tradevillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class provinces extends Model
{
    use Translatable;

    protected $table = 'tradevillage__provinces';
    protected $fillable = [];
}
