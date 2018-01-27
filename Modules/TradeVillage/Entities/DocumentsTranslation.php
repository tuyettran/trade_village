<?php

namespace Modules\TradeVillage\Entities;

use Illuminate\Database\Eloquent\Model;

class DocumentsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['content', 'author', 'title'];
    protected $table = 'tradevillage__documents_translations';
}
