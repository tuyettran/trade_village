<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\Course_commentsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCourse_commentsDecorator extends BaseCacheDecorator implements Course_commentsRepository
{
    public function __construct(Course_commentsRepository $course_comments)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.course_comments';
        $this->repository = $course_comments;
    }
}
