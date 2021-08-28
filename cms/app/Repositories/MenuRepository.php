<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface MenuRepository.
 *
 * @package namespace App\Repositories;
 */
interface MenuRepository extends RepositoryInterface
{
    public function datatable();

    public function store(array $input);

    public function update(array $input, $id);
}
