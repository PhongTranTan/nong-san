<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ReviewRepository
 * @package namespace App\Repositories;
 */
interface TypeRepository extends RepositoryInterface
{
    public function datatable();
}
