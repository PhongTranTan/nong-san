<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface MenuItemRepository.
 *
 * @package namespace App\Repositories;
 */
interface MenuItemRepository extends RepositoryInterface
{
    public function datatable();

    public function store(array $input);

    public function update(array $input, $id);
}
