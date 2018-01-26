<?php

namespace Modules\TradeVillage\Entities;

use Illuminate\Database\Eloquent\Model;

class Course_commentsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['content'];
    protected $table = 'tradevillage__course_comments_translations';
}
