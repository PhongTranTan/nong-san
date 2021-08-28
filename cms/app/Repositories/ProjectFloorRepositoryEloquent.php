<?php

namespace App\Repositories;

use App\Models\ProjectFloor;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectFloorRepositoryEloquent extends BaseRepository implements ProjectFloorRepository
{
    public function model()
    {
        return ProjectFloor::class;
    }

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
        $input['active'] = !empty($input['active']) ? 1 : 0;
        $model = $this->model->create($input);
        return $model;
    }

    public function update(array $input, $id)
    {
        $input['active'] = !empty($input['active']) ? 1 : 0;
        $model = $this->model->find($id);
        return $model->update($input);
    }
}
