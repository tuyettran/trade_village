<?php

namespace Modules\TradeVillage\Repositories\Cache;

use Modules\TradeVillage\Repositories\Course_usersRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCourse_usersDecorator extends BaseCacheDecorator implements Course_usersRepository
{
    public function __construct(Course_usersRepository $course_users)
    {
        parent::__construct();
        $this->entityName = 'tradevillage.course_users';
        $this->repository = $course_users;
    }
}
