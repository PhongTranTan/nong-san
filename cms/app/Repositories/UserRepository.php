<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository
 * @package namespace App\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    public function datatable();

    public function store(array $attributes);

    public function update(array $attributes, $id);
}
