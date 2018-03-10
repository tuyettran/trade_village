<?php

namespace Modules\TradeVillage\Entities;

use Illuminate\Database\Eloquent\Model;

class DocumentsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'author', 'description'];
    protected $table = 'tradevillage__documents_translations';
}
