<?php namespace App\Traits;

use App\Models\Catalogue;

trait CatalogueTrait
{
    public function catalogues()
    {
        $catalogue_key = $this->table;
        return $this->hasMany(Catalogue::class, "object_id")->where(function ($q) use ($catalogue_key) {
            return $q->where("catalogue_key", $catalogue_key);
        });
    }

    public function storeCatalogues(array $arr)
    {
        $locales = config("laravellocalization.supportedLocales");
        $config = config("files.catalogue");
        foreach ($arr as $key => $value) {
            $check = true;
            foreach ($locales as $code => $name) {
                if (empty($value[$code]["file"]) || empty($value[$code]["name"])) {
                    $check = false;
                    break;
                }
            }
            if (!$check) {
                continue;
            }

            $input = [];

            foreach ($locales as $code => $name) {
                $input[$code]["size"] = $value[$code]["file"]->getClientSize() / 1024; // KB
                $input[$code]["ext"] = $value[$code]["file"]->extension();
                $input[$code]["name"] = $value[$code]["name"];
                $path = \Storage::putFile($config["path"], $value[$code]["file"]);
                $input[$code]["path"] = $path;
            }
            $input["object_id"] = $this->id;
            $input["catalogue_key"] = $this->table;
            $this->catalogues()->create($input);
        }
    }

    public function deleteCatalogues(array $ids, $all = false)
    {
        if ($all === true) {
            $catalogues = $this->catalogues;
        } else {
            $catalogues = $this->catalogues()->whereIn("id", $ids)->get();
        }
        $locales = config("laravellocalization.supportedLocales");

        foreach ($catalogues as $catalogue) {
            foreach ($locales as $code => $name) {
                if (!empty($catalogue->{"path:{$code}"})) {
                    \Storage::delete($catalogue->{"path:{$code}"});
                }
            }
            if (!empty($catalogue->image)) {
                \Storage::delete($catalogue->image);
            }
            $catalogue->delete();
        }
    }
}
