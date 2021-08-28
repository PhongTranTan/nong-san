<?php

namespace App\Http\ViewComposers;

use App\Repositories\NewsRepository;
use App\Repositories\PageRepository;
use App\Repositories\PageRepositoryEloquent;
use App\Repositories\PartnerRepository;
use App\Repositories\ProductRepository;
use App\Repositories\NewsCategoryRepository;
use App\Repositories\ProjectCategoryRepository;
use Illuminate\View\View;

class GlobalComposer
{
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {

    }
}
