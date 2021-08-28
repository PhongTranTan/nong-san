<?php

namespace App\Repositories;

use App\Models\ProjectLast;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectLastRepositoryEloquent extends BaseRepository implements ProjectLastRepository
{
    public function model()
    {
        return ProjectLast::class;
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
