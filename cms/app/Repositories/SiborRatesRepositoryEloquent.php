<?php

namespace App\Repositories;

use App\Models\SiborRates;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class SiborRatesRepositoryEloquent extends BaseRepository implements SiborRatesRepository
{
    public function model()
    {
        return SiborRates::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function datatable()
    {
        return $this->model->select('*');
    }

    public function update(array $input, $id)
    {
        $input['active'] = !empty($input['active']) ? 1 : 0;
        $model = $this->model->find($id);
        return $model->update($input);
    }

    public function create(array $input)
    {
        $input['active'] = !empty($input['active']) ? 1 : 0;

        $model = $this->model->create($input);

        return $model;
    }
}
