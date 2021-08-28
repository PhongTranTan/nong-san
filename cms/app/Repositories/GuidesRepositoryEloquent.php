<?php

namespace App\Repositories;

use App\Models\Guides;
use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class GuidesRepositoryEloquent extends BaseRepository implements GuidesRepository
{
    public function model()
    {
        return Guides::class;
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

        $locales = \Config::get('translatable.locales');

        foreach($locales as $locale){
            if(!empty($input[$locale]['slug'])){
                $slug = $input[$locale]['slug'];
                \DB::table('guides_translation')
                    ->where('guides_id', $id)->where('locale', $locale)
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

    public function getRelated($id){
        $guide = Guides::find($id);
        return $this->model
            ->whereNotIn('id', [
                $id
            ])
            ->where('guides_category_id', $guide->guides_category_id)
            ->publishdate()
            ->active()
            ->sortDesc()
            ->get();
    }
}
