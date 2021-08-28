<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ContactRepository
 * @package namespace App\Repositories;
 */
interface ScheduleRepository extends RepositoryInterface
{
    public function datatable();
}
