<?php

namespace App\Repositories;

use App\Models\GuidesCategory;
use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class GuidesCategoryRepositoryEloquent extends BaseRepository implements GuidesCategoryRepository
{
    public function model()
    {
        return GuidesCategory::class;
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

    public function findBySlug($slug)
    {
        $model = $this->model->whereTranslation('slug', $slug)->first();

        return $model;
    }

    public function getRelated($id){
        return $this->model->whereNotIn('id', [$id])->get();
    }
}
