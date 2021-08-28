<?php

namespace App\Repositories;

use App\Models\Tenure;
use App\Traits\RepositoryTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class TenureRepositoryEloquent extends BaseRepository implements TenureRepository
{
    use RepositoryTrait;

    public function model()
    {
        return Tenure::class;
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
        $input['active'] = isset($input['active']) ? 1 : 0;
        $model = $this->model->create($input);
        return $model->update($input);
    }

    public function update(array $input, $id)
    {
        $input['active'] = isset($input['active']) ? 1 : 0;
        $model = $this->model->find($id);
        return $model->update($input);
    }
}
