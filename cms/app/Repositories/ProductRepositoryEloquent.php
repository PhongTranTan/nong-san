<?php

namespace App\Repositories;

use App\Models\Product;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{
    public function model()
    {
        return Product::class;
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
        if (!empty($input['metadata'])) {
            $model->metaCreateOrUpdate($input['metadata']);
        }
        $model->updateSlugTranslation();
        return $model;
    }

    public function update(array $input, $id)
    {
        $input['active'] = !empty($input['active']) ? 1 : 0;
        $model = $this->model->find($id);
        $model->update($input);
        if (!empty($input['metadata'])) {
            $model->metaCreateOrUpdate($input['metadata']);
        }
        $model->updateSlugTranslation();
        return $model;
    }

    public function findBySlug($slug)
    {
        $model = $this->model->whereTranslation('slug', $slug)->first();
        return $model;
    }

    public function sortProject()
    {
        $projects =  $this->model->orderBy('display_order')->get();
        return $projects;
    }
}
