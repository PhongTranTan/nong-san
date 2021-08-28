<?php namespace App\Traits;


trait CategoryRepositoryTrait
{
    public function listRecursive($maxLevel = 0, array $ignore_ids = [])
    {
        $maxLevel = (int)$maxLevel;
        $data = $this->model->whereNull('parent_id');
        if (count($ignore_ids) > 0) {
            $data->whereNotIn('id', $ignore_ids);
        }
        if ($maxLevel > 0) {
            $data->with([
                'children' => function ($child) use($maxLevel, $ignore_ids){
                    if (count($ignore_ids) > 0) {
                        $child->whereNotIn('id', $ignore_ids);
                    }

                    if ($maxLevel >= 2) {
                        $child->with([
                            'children' => function($child2) use($maxLevel, $ignore_ids){
                                if (count($ignore_ids) > 0) {
                                    $child2->whereNotIn('id', $ignore_ids);
                                }
                            }
                        ]);
                    }
                }
            ]);
        }

        return $data->get();
    }
}