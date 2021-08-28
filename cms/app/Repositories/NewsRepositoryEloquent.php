<?php

namespace App\Repositories;

use App\Models\News;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class NewsRepositoryEloquent extends BaseRepository implements NewsRepository
{
    public function model()
    {
        return News::class;
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
        $input['highlight'] = !empty($input['highlight']) ? 1 : 0;
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
        $input['highlight'] = !empty($input['highlight']) ? 1 : 0;
        $model = $this->model->findOrFail($id);
        $model->update($input);
        if (!empty($input['metadata'])) {
            $model->metaCreateOrUpdate($input['metadata']);
        }
        $model->updateSlugTranslation();
        $locales = Config::get('translatable.locales');
        foreach($locales as $locale){
            if(!empty($input[$locale]['slug'])){
                $slug = $input[$locale]['slug'];
                DB::table('news_translation')
                    ->where('news_id', $id)->where('locale', $locale)
                    ->update(['slug' => $slug]);
            }
        }
        return $model;
    }

    public function findBySlug($slug)
    {
        $model = $this->model
            ->whereTranslation('slug', $slug)
            ->first();
        return $model;
    }

    public function getRelated($id){
        $news = News::find($id);
        return $this->model
            ->whereNotIn('id', [
                $id
            ])
            ->where('news_category_id', $news->news_category_id)
            ->publishdate()
            ->active()
            ->sortDesc()
            ->get();
    }
}
