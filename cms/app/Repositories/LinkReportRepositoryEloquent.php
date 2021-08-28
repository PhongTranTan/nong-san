<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LinkReportRepository;
use App\Models\LinkReport;

/**
 * Class ContactRepositoryEloquent
 * @package namespace App\Repositories;
 */
class LinkReportRepositoryEloquent extends BaseRepository implements LinkReportRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LinkReport::class;
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

    public function create(array $input)
    {
        $model = $this->model->create($input);
        return $model->update($input);
    }

    public function update(array $input, $id)
    {
        $model = $this->model->find($id);
        return $model->update($input);
    }
}
