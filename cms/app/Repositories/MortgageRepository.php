<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SubjectRepository
 * @package namespace App\Repositories;
 */
interface MortgageRepository extends RepositoryInterface
{
    public function datatable();
}
