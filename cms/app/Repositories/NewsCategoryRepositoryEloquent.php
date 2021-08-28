<?php

namespace App\Repositories;

use App\Models\NewsCategory;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class NewsCategoryRepositoryEloquent extends BaseRepository implements NewsCategoryRepository
{
    public function model()
    {
        return NewsCategory::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function datatable(array $with = [])
    {
        return $this->model->select('*')
            ->with($with)
            ->orderBy('id', 'DESC');
    }

    public function create(array $input)
    {
        $input['active'] = !empty($input['active']) ? 1 : 0;
        $model = $this->model->create($input);
        if (!empty($input['metadata'])) {
            $model->metaCreateOrUpdate($input['metadata']);
        }
        return $model;
    }

    public function update(array $input, $id)
    {
        $input['active'] = !empty($input['active']) ? 1 : 0;
        $model = $this->model->findOrFail($id);
        $model->update($input);
        if (!empty($input['metadata'])) {
            $model->metaCreateOrUpdate($input['metadata']);
        }
        return $model;
    }
}
