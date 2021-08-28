<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ContactRepository
 * @package namespace App\Repositories;
 */
interface GuidesRepository extends RepositoryInterface
{
    public function datatable();
    public function findBySlug($slug);
    public function getRelated($id);
}
