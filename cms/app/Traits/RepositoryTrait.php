<?php
/**  * Created by PhpStorm.
 * User: Hadesker - HienNV
 * Date: 7/25/2018
 * Time: 1:48 PM
 */

namespace App\Traits;


trait RepositoryTrait
{
    public function findBySlug($slug, $level = null, $with = [])
    {
        $model = $this->model->whereTranslation('slug', $slug);

        if ($level !== null) {
            $model->where('level', $level);
        }

        if (!empty($with)) {
            $model->with($with);
        }

        return $model->firstOrFail();
    }
}