<?php namespace App\Traits;

use App\Models\ObjectMedia;

trait MediaTrait
{
    public function media()
    {
        return $this->hasOne(ObjectMedia::class, 'object_id')
            ->where('type', $this->table)
            ->orderBy('position');
    }

    public function medias()
    {
        return $this->hasMany(ObjectMedia::class, 'object_id')
            ->where('type', $this->table)
            ->orderBy('position');
    }

    public function createMedia($path, $position = 0)
    {
        if (is_array($path)) {
            foreach ($path as $value) {
                $input = [
                    'object_id' => $this->id,
                    'type' => $this->table,
                    'path' => $value,
                    'position' => $position
                ];
                ObjectMedia::create($input);
            }
        } else {
            $input = [
                'object_id' => $this->id,
                'type' => $this->table,
                'path' => $path,
                'position' => $position
            ];
            ObjectMedia::create($input);
        }
    }

    public function deleteMedias($ids, $all = false)
    {
        if ($all) {
            $this->medias()->delete();
        } else {
            if (is_array($ids)) {
                $this->medias()->whereIn('object_media.id', $ids)->delete();
            } else {
                $this->medias()->where('object_media.id', $ids)->delete();
            }
        }
    }
}