<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\NewsRepository;
use App\Repositories\NewsCategoryRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    protected $news;
    protected $newsCategory;

    public function __construct(
        NewsRepository $news,
        NewsCategoryRepository $newsCategory
    )
    {
        parent::__construct();
        $this->news = $news;
        $this->newsCategory = $newsCategory;
    }

    public function getNewsDetail($slug)
    {
        $news = $this->news->findBySlug($slug);
        if (!$news) {
            return abort('404');
        }
        $metadata = $news->meta;
        $related_news = $this->news->getRelated($news->id);
        $newsCategories = $this->newsCategory
            ->datatable()
            ->active()
            ->get();
        return view('frontend.news.detail', compact(
            'news', 
            'related_news', 
            'metadata',
            'newsCategories'
        ));
    }
}
