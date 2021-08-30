<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\TranslateUrl;
use App\Http\Controllers\Controller;
use App\Repositories\BannerRepository;
use App\Repositories\PageRepository;
use App\Repositories\NewsRepository;
use App\Repositories\NewsCategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductTypeRepository;
use Breadcrumb;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class PageController extends Controller
{
    private $page;
    private $banner;
    private $news;
    private $product;
    private $productTypes;
    private $newsCategory;

    public function __construct(
        PageRepository $page,
        BannerRepository $banner,
        NewsRepository $news,
        NewsCategoryRepository $newsCategory,
        ProductRepository $product,
        ProductTypeRepository $productTypes
    )
    {
        $this->page = $page;
        $this->banner = $banner;
        $this->news = $news;
        $this->newsCategory = $newsCategory;
        $this->product = $product;
        $this->productTypes = $productTypes;
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
                $productTypes = $this->productTypes->datatable()
                    ->active()
                    ->limit(3)
                    ->get();
                $products = $this->product->datatable()
                    ->active()
                    ->limit(16)
                    ->get();
                $news = $this->news->datatable()
                    ->active()
                    ->highlight()
                    ->publishdate()
                    ->sortDesc()
                    ->limit(6)
                    ->get();
                $with = [
                    'banners' => $banners,
                    'products' => $products,
                    'news' => $news,
                    'productTypes' => $productTypes,
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
                case 'gallery':
                    {
                        $banners = $this->banner->datatable()
                            ->active()
                            ->where('page_id', $page->id)
                            ->orderBy('banner.position', 'ASC')
                            ->get();
                        $with = [
                            'banners' => $banners
                        ];
                    break;
                }
                case 'contact':
                    {
                        $banners = $this->banner->datatable()
                            ->active()
                            ->where('page_id', $page->id)
                            ->orderBy('banner.position', 'ASC')
                            ->get();
                        $with = [
                            'banners' => $banners
                        ];
                    break;
                }
                case 'about':
                    {
                        $banners = $this->banner->datatable()
                            ->active()
                            ->where('page_id', $page->id)
                            ->orderBy('banner.position', 'ASC')
                            ->get();
                        $with = [
                            'banners' => $banners
                        ];
                    break;
                }
                case 'news':
                {
                    $banners = $this->banner->datatable()
                        ->active()
                        ->where('page_id', $page->id)
                        ->orderBy('banner.position', 'ASC')
                        ->get();
                    $newsQuery = $this->news->datatable();
                    if (isset($request->cate)) {
                        $newsQuery->where('news_category_id', $request->cate);
                    }
                    $news = $newsQuery->active()
                        ->publishdate()
                        ->sortDesc()
                        ->paginate(6);
                    if ($request->ajax()) {
                        return [
                            'data' => view('frontend.news.partials.ajax_list_news', compact(
                                'news'
                            ))->render(),
                        ];
                    }
                    $newsCategories = $this->newsCategory
                        ->datatable()
                        ->active()
                        ->get();
                    $with = [
                        'banners' => $banners,
                        'news' => $news,
                        'newsCategories' => $newsCategories
                    ];
                    break;
                }
                case 'shop':
                {
                    $banners = $this->banner->datatable()
                        ->active()
                        ->where('page_id', $page->id)
                        ->orderBy('banner.position', 'ASC')
                        ->get();
                    $productQuery = $this->product->datatable();
                    if (isset($request->cate)) {
                        $productQuery->where('product_type_id', $request->cate);
                    }
                    if (isset($request->key)) {
                        $keyWord = htmlspecialchars($request->key);
                        $productQuery->where(function ($queSub) use ($keyWord) {
                            $queSub->whereTranslationLike('name', "%$keyWord%")
                                ->orWhereTranslationLike('description', 'like', "%$keyWord%");
                        });
                    }
                    $products = $productQuery->active()
                        ->sortDesc()
                        ->paginate(12);
                    if ($request->ajax()) {
                        return [
                            'data' => view('frontend.products.partials.ajax_list_product', compact(
                                'products'
                            ))->render(),
                        ];
                    }
                    $productTypes = $this->productTypes
                        ->datatable()
                        ->active()
                        ->get();
                    $with = [
                        'banners' => $banners,
                        'products' => $products,
                        'productTypes' => $productTypes,
                    ];
                    break;
                }
            }

            return view(
                THEME_PATH_VIEW . ".{$page->theme}", 
                compact(
                    'page', 
                    'blocks', 
                    'metadata', 
                    'types', 
                    'districts'
                ))->with($with);
        }
        return abort(404);
    }

}
