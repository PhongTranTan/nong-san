<?php

namespace App\Repositories;

use App\Models\Project;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    public function model()
    {
        return Project::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function datatable($orderBy = 0)
    {
        if($orderBy != 0){
            return $this->model->select('*')->orderBy('created_at','DESC');
        }
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

        $locales = \Config::get('translatable.locales');

        foreach($locales as $locale){
            if(!empty($input[$locale]['slug'])){
                $slug = $input[$locale]['slug'];
                \DB::table('project_translation')
                    ->where('project_id', $id)->where('locale', $locale)
                    ->update(['slug' => $slug]);
            }
        }

        return $model;
    }

    public function findBySlug($slug)
    {
        $model = $this->model->whereTranslation('slug', $slug)->first();

        return $model;
    }

    public function sortProject()
    {
        $projects =  $this->model
            ->orderBy('position')
            ->get();
        return $projects;
    }
}
