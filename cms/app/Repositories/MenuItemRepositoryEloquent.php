<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MenuItemRepository;
use App\Models\MenuItem;
/**
 * Class MenuItemRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MenuItemRepositoryEloquent extends BaseRepository implements MenuItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MenuItem::class;
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

        $input['active'] = !empty($input['active']) ? 1 : 0;

        if(!empty($input["parent_id"])) {
            $parentMenuItem = $this->model->find($input["parent_id"]);
            $level = $parentMenuItem->level + 1;
            $input['level'] = $level;
        }

        $model = $this->model->create($input);

        $model->menus()->attach($input['menu_id']);

        $model->updateSlugTranslation();
        
        return $model;
    }

    public function update(array $input, $id){

        $model = $this->model->find($id);

        $input['active'] = !empty($input['active']) ? 1 : 0;

        if(!empty($input["parent_id"])) {
            $parentMenuItem = $this->model->find($input["parent_id"]);
            $level = $parentMenuItem->level + 1;
            $input['level'] = $level;
        }

        $model->update($input);

        $model->menus()->sync($input['menu_id']);

        $model->updateSlugTranslation();

        return $model;
    }
}
