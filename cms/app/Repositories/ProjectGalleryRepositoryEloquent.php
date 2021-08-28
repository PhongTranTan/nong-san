<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProjectGalleryRepository;
use App\Models\ProjectGallery;

/**
 * Class ContactRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ProjectGalleryRepositoryEloquent extends BaseRepository implements ProjectGalleryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectGallery::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
       
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
        return $model;
    }

    public function update(array $input, $id)
    {
        $model = $this->model->find($id);
        return $model->update($input);
    }
}
