<?php

namespace App\Repositories;

use App\Models\Testimonials;
use Prettus\Repository\Eloquent\BaseRepository;

class TestimonialsRepositoryEloquent extends BaseRepository implements TestimonialsRepository
{
    public function model()
    {
        return Testimonials::class;
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
        $model->update($input);
        return $model;
    }
}
