<?php

namespace Modules\Tradevillage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class districts extends Model
{
    use Translatable;

    protected $table = 'tradevillage__districts';
    protected $fillable = [];
}
