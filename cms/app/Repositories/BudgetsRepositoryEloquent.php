<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BudgetsRepository;
use App\Models\Budgets;

/**
 * Class ContactRepositoryEloquent
 * @package namespace App\Repositories;
 */
class BudgetsRepositoryEloquent extends BaseRepository implements BudgetsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Budgets::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function datatable()
    {
        return $this->model->select('*');
    }
}
