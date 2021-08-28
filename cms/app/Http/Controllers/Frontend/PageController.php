<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\TranslateUrl;
use App\Http\Controllers\Controller;
use App\Repositories\BannerRepository;
use App\Repositories\PageRepository;
use Breadcrumb;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class PageController extends Controller
{
    private $page;
    private $banner;

    public function __construct(
        PageRepository $page,
        BannerRepository $banner
    )
    {
        $this->page = $page;
        $this->banner = $banner;
    }

    public function index()
    {
        $page = $this->page->findBySlug('/');
        $blocks = [];
        if ($page->parentBlocks->count()) {
            $blocks = $page->parentBlocks->groupBy('code');
        }
        foreach ($page->translations as $translation) {
            TranslateUrl::addWithLink($translation->locale, "/{$translation->locale}");
        }
        $metadata = $page->meta;
        if (view()->exists(THEME_PATH_VIEW . ".{$page->theme}")) {
            $with = [];
            if ($page->theme == 'home') {
                $banners = $this->banner
                    ->datatable()
                    ->active()
                    ->where('page_id', $page->id)
                    ->orderBy('banner.position', 'ASC')
                    ->get();
                $with = [
                    'banners' => $banners,
                ];
            }
            return view(
                THEME_PATH_VIEW . ".{$page->theme}", 
                compact('page', 'blocks', 'metadata')
            )->with($with);
        }
        abort(404);
    }

    public function show(Request $request, $slug)
    {
        $with = [
            'translations',
            'parentBlocks',
            'parentBlocks.children'
        ];
        $page = $this->page->findBySlug($slug);
        $blocks = collect();
        if ($page->parentBlocks->count()) {
            $blocks = $page->parentBlocks->groupBy('code');
        }
        foreach ($page->translations as $translation) {
            $url = $translation->slug ? $translation->slug : COMING_SOON;
            TranslateUrl::addWithLink($translation->locale, "/{$translation->locale}/{$url}");
        }
        $metadata = $page->meta;
        if (!$metadata || !$metadata->title) {
            $metadata = (object)[
                'title' => $page->title,
                'description' => $page->description,
                'key_word' => 'nongsan'
            ];
        }
        if (view()->exists(THEME_PATH_VIEW . ".{$page->theme}")) {
            $with = [];
            $locale = App::getLocale();
            switch ($page->theme) {
            }

            return view(
                THEME_PATH_VIEW . ".{$page->theme}", 
                compact(
                    'page', 
                    'blocks', 
                    'metadata', 
                    'types', 
                    'tenures', 
                    'districts'
                ))->with($with);
        }
        return abort(404);
    }

}
