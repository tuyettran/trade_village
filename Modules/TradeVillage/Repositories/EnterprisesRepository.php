<?php

namespace Modules\TradeVillage\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface EnterprisesRepository extends BaseRepository
{

    public function getEnterpriseByAttributes(array $attributes);
    public function searchEnterpriseByVillages(array $village_ids, $key, $locale);
    public function search($key, $locale);
}
