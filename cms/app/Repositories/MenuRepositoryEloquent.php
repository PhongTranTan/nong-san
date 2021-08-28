<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MenuRepository;
use App\Models\Menu;

/**
 * Class MenuRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MenuRepositoryEloquent extends BaseRepository implements MenuRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Menu::class;
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
        return $this->model->select('*')->withTranslation();
    }
    
    public function store(array $input){
        $model = $this->model->create($input);
        $model->updateSlugTranslation();
        return $model;
    }

    public function update(array $input, $id){
        $model = $this->model->find($id);
        $model->update($input);
        $model->updateSlugTranslation();
        return $model;
    }
}
