<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\TranslateUrl;
use App\Http\Controllers\Controller;
use App\Repositories\BannerRepository;
use App\Repositories\GuidesRepository;
use App\Repositories\TestimonialsRepository;
use App\Repositories\SiborRatesRepository;
use App\Repositories\MortgageRepository;
use App\Repositories\PageRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\TenureRepository;
use App\Repositories\DirectionRepository;
use App\Repositories\LogoPartnerRepository;
use App\Repositories\ProjectLastRepository;
use App\Repositories\PurposeRepository;
use App\Repositories\TypeRepository;
use App\Repositories\DistrictRepository;
use Breadcrumb;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Repositories\NewsRepository;
use App\Repositories\NewsCategoryRepository;
use App\Repositories\GuidesCategoryRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class PageController extends Controller
{
    private $page;
    private $banner;
    private $guides;
    private $testimonials;
    private $sibor_rates;
    private $mortgages;
    private $project;
    private $tenure;
    private $direction;
    private $partner;
    private $projectlast;
    private $purpose;
    private $district;
    private $type;
    private $news;
    private $newsCategory;
    private $guidesCategory;

    public function __construct(
        PageRepository $page,
        BannerRepository $banner,
        GuidesRepository $guides,
        SiborRatesRepository $sibor_rates,
        TestimonialsRepository $testimonials,
        MortgageRepository $mortgages,
        ProjectRepository $project,
        TenureRepository $tenure,
        DirectionRepository $direction,
        LogoPartnerRepository $partner,
        ProjectLastRepository $projectlast,
        PurposeRepository $purpose,
        TypeRepository $type,
        DistrictRepository $district,
        NewsRepository $news,
        NewsCategoryRepository $newsCategory,
        GuidesCategoryRepository $guidesCategory
    )
    {
        $this->page = $page;
        $this->banner = $banner;
        $this->guides = $guides;
        $this->sibor_rates = $sibor_rates;
        $this->testimonials = $testimonials;
        $this->mortgages = $mortgages;
        $this->project = $project;
        $this->tenure = $tenure;
        $this->direction = $direction;
        $this->partner = $partner;
        $this->projectlast = $projectlast;
        $this->purpose = $purpose;
        $this->type = $type;
        $this->district = $district;
        $this->news = $news;
        $this->newsCategory = $newsCategory;
        $this->guidesCategory = $guidesCategory;
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
                $banners = $this->banner->datatable()->active()->where('page_id', $page->id)->orderBy('banner.position', 'ASC')->get();
                $guides = $this->guides->datatable()->active()->highlight()->publishdate()->orderBy('publish_date', 'DESC')->limit(9)->get();
                $testimonials = $this->testimonials->datatable()->active()->orderBy('position', 'ASC')->get();
                $tenures = $this->tenure->datatable()->active()->get();
                $directions = $this->direction->datatable()->active()->get();
                $purposes = $this->purpose->datatable()->active()->get();
                $star_buy_projects = $this->project->datatable()
                    ->active()
                    ->where('star_buy', 1)
                    ->position()
                    ->orderBy('id', 'DESC')
                    ->get();
                $news = $this->news->datatable()
                    ->active()
                    ->highlight()
                    ->publishdate()
                    ->sortDesc()
                    ->limit(9)
                    ->get();
                $with = [
                    'banners' => $banners,
                    'guides' => $guides,
                    'testimonials' => $testimonials,
                    'tenures' => $tenures,
                    'directions' => $directions,
                    'star_buy_projects' => $star_buy_projects,
                    'purposes' => $purposes,
                    'news' => $news,
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
                'key_word' => '3forcom'
            ];
        }
        $tenures = $this->tenure->datatable()->active()->get();
        $districts = $this->district->datatable()->active()->get();
        $types = $this->type->datatable()->active()->get();
        if (view()->exists(THEME_PATH_VIEW . ".{$page->theme}")) {
            $with = [];
            $locale = App::getLocale();
            switch ($page->theme) {
                case 'home-loan':
                {
                    $banners = $this->banner->datatable()->active()->where('page_id', $page->id)->orderBy('banner.position', 'ASC')->get();
                    $sibor_rates = $this->sibor_rates->datatable()->active()->where('type', 0)->orderBy('date', 'DESC')->first();
                    $sor_rates = $this->sibor_rates->datatable()->active()->where('type', 1)->orderBy('date', 'DESC')->first();
                    $testimonials = $this->testimonials->datatable()->active()->orderBy('position', 'ASC')->get();
                    $partners = $this->partner->datatable()->where(['type' => 1, 'active' => 1])->orderBy('id', 'DESC')->get();
                    $with = [
                        'banners' => $banners,
                        'sibor_rates' => $sibor_rates,
                        'testimonials' => $testimonials,
                        'partners' => $partners,
                        'sor_rates' => $sor_rates
                    ];
                    break;
                }
                case 'mortgage-insurance':
                {
                    $banners = $this->banner->datatable()->active()->where('page_id', $page->id)->orderBy('banner.position', 'ASC')->get();
                    $mortgages = $this->mortgages->datatable()->active()->orderBy('mortgage.position', 'ASC')->get();
                    $partners = $this->partner->datatable()->where(['type' => 2, 'active' => 1])->orderBy('id', 'DESC')->get();
                    $with = [
                        'banners' => $banners,
                        'mortgages' => $mortgages,
                        'partners' => $partners
                    ];
                    break;
                }
                case 'guides':
                {
                    $banners = $this->banner
                        ->datatable()
                        ->active()
                        ->where('page_id', $page->id)
                        ->orderBy('banner.position', 'ASC')
                        ->get();
                    $guidesQuery = $this->guides->datatable();
                    if (isset($request->cate)) {
                        $guidesQuery->where('guides_category_id', $request->cate);
                    }
                    $guides = $guidesQuery->active()
                        ->publishdate()
                        ->sortDesc()
                        ->paginate(6);
                    if ($request->ajax()) {
                        return [
                            'data' => view('frontend.guides.partials.ajax_list_guides', compact(
                                'guides'
                            ))->render(),
                        ];
                    }
                    $guidesCategories = $this->guidesCategory
                        ->datatable()
                        ->active()
                        ->get();
                    $with = [
                        'banners' => $banners,
                        'guides' => $guides,
                        'guidesCategories' => $guidesCategories
                    ];
                    break;
                }
                case 'list-project':
                {
                    $banners = $this->banner->datatable()->active()->where('page_id', $page->id)->orderBy('banner.position', 'ASC')->get();
                    $projects = \App\Models\Project::select('project.*', 'project_translation.name', 'project_translation.description', 'project_translation.slug', 'project_translation.project_address', 'project_translation.tag', 'project_translation.project_location', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->join('project_translation', 'project.id', '=', 'project_translation.project_id')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->where('project_translation.locale', $locale)->active();
                    if($request->get('sort')){
                        $projects = $projects->position()->orderBy('project_translation.name', $request->get('sort'))->paginate(\Config::get('constants.paginate'));
                    }else{
                        $projects = $projects->position()->orderBy('project.id', 'DESC')->paginate(\Config::get('constants.paginate'));
                    }
                    $with = [
                        'banners' => $banners,
                        'projects' => $projects,
                    ];
                    break;
                }
                case 'list-project-detail':
                {
                    $projects = \App\Models\Project::select('project.*', 'project_translation.name', 'project_translation.description', 'project_translation.slug', 'project_translation.project_address', 'project_translation.tag', 'project_translation.project_location', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->join('project_translation', 'project.id', '=', 'project_translation.project_id')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->where('project_translation.locale', $locale)->active();
                    if ($request->get('sort')) {
                        $projects = $projects
                            ->orderBy('project_translation.name', $request->get('sort'))
                            ->paginate(\Config::get('constants.paginate-detail'));
                    } else {
                        $projects = $projects
                            ->position()
                            ->orderBy('project.id', 'DESC')
                            ->paginate(\Config::get('constants.paginate-detail'));
                    }
                    $count_projects = $this->project
                        ->datatable()
                        ->select('project.*', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')
                        ->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')
                        ->active()
                        ->count();
                    $count_projects = ceil($count_projects / \Config::get('constants.paginate-detail'));
                    $project_last_update = null;
                    if ($projects != null && count($projects) > 0) {
                        $project_last_update = $this->projectlast
                            ->datatable()
                            ->where('project_id', $projects[0]->id)
                            ->orderBy('date', 'DESC')
                            ->paginate(\Config::get('constants.paginate-detail'));
                    }
                    $with = [
                        'projects' => $projects,
                        'project_last_update' => $project_last_update,
                        'count_projects' => $count_projects
                    ];
                    break;
                }
                case 'lastest-launch':
                {
                    $banners = $this->banner->datatable()->active()->where('page_id', $page->id)->orderBy('banner.position', 'ASC')->get();
                    $projects = \App\Models\Project::select('project.*', 'project_translation.name', 'project_translation.description', 'project_translation.slug', 'project_translation.project_address', 'project_translation.tag', 'project_translation.project_location', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->join('project_translation', 'project.id', '=', 'project_translation.project_id')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->where('project_translation.locale', $locale)->active()->where('project_lastest_launches', 1);
                    if($request->get('sort')){
                        $projects = $projects->orderBy('project_translation.name', $request->get('sort'))->paginate(\Config::get('constants.paginate'));
                    }else{
                        $projects = $projects->position()->orderBy('project.id', 'DESC')->paginate(\Config::get('constants.paginate'));
                    }
                    $with = [
                        'banners' => $banners,
                        'projects' => $projects,
                    ];
                    break;
                }
                case 'lastest-launch-detail':
                {
                    $projects = \App\Models\Project::select('project.*', 'project_translation.name', 'project_translation.description', 'project_translation.slug', 'project_translation.project_address', 'project_translation.tag', 'project_translation.project_location', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->join('project_translation', 'project.id', '=', 'project_translation.project_id')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->where('project_translation.locale', $locale)->active()->where('project_lastest_launches', 1);
                    $count_projects = $projects->count();
                    if($request->get('sort')){
                        $projects = $projects->orderBy('project_translation.name', $request->get('sort'))->paginate(\Config::get('constants.paginate-detail'));
                    }else{
                        $projects = $projects->position()->orderBy('project.id', 'DESC')->paginate(\Config::get('constants.paginate-detail'));
                    }
                    $count_projects = ceil($count_projects / \Config::get('constants.paginate-detail'));
                    $project_last_update = null;
                    if($projects != null && count($projects) > 0){
                        $project_last_update = $this->projectlast->datatable()->where('project_id', $projects[0]->id)->orderBy('date', 'DESC')->paginate(\Config::get('constants.paginate-detail'));
                    }
                    $with = [
                        'projects' => $projects,
                        'project_last_update' => $project_last_update,
                        'count_projects' => $count_projects
                    ];
                    break;
                }
                case 'heavily':
                {
                    $banners = $this->banner->datatable()->active()->where('page_id', $page->id)->orderBy('banner.position', 'ASC')->get();
                    $projects = \App\Models\Project::select('project.*', 'project_translation.name', 'project_translation.description', 'project_translation.slug', 'project_translation.project_address', 'project_translation.tag', 'project_translation.project_location', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->join('project_translation', 'project.id', '=', 'project_translation.project_id')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->where('project_translation.locale', $locale)->active()->where('project_heavily_discount', 1);
                    if($request->get('sort')){
                        $projects = $projects->orderBy('project_translation.name', $request->get('sort'))->paginate(\Config::get('constants.paginate'));
                    }else{
                        $projects = $projects->position()->orderBy('project.id', 'DESC')->paginate(\Config::get('constants.paginate'));
                    }
                    $with = [
                        'banners' => $banners,
                        'projects' => $projects,
                    ];
                    break;
                }
                case 'heavily-detail':
                {
                    $projects = \App\Models\Project::select('project.*', 'project_translation.name', 'project_translation.description', 'project_translation.slug', 'project_translation.project_address', 'project_translation.tag', 'project_translation.project_location', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->join('project_translation', 'project.id', '=', 'project_translation.project_id')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->where('project_translation.locale', $locale)->active()->where('project_heavily_discount', 1);
                    if($request->get('sort')){
                        $projects = $projects->orderBy('project_translation.name', $request->get('sort'))->paginate(\Config::get('constants.paginate-detail'));
                    }else{
                        $projects = $projects->position()->orderBy('project.id', 'DESC')->paginate(\Config::get('constants.paginate-detail'));
                    }
                    $count_projects = $this->project->datatable()->select('project.*', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->active()->where('project_heavily_discount', 1)->count();
                    $count_projects = ceil($count_projects / \Config::get('constants.paginate-detail'));
                    $project_last_update = null;
                    if($projects != null && count($projects) > 0){
                        $project_last_update = $this->projectlast->datatable()->where('project_id', $projects[0]->id)->orderBy('date', 'DESC')->paginate(\Config::get('constants.paginate-detail'));
                    }
                    $with = [
                        'projects' => $projects,
                        'project_last_update' => $project_last_update,
                        'count_projects' => $count_projects
                    ];
                    break;
                }
                case 'investor':
                {
                    $banners = $this->banner->datatable()->active()->where('page_id', $page->id)->orderBy('banner.position', 'ASC')->get();
                    $projects = \App\Models\Project::select('project.*', 'project_translation.name', 'project_translation.description', 'project_translation.slug', 'project_translation.project_address', 'project_translation.tag', 'project_translation.project_location', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->join('project_translation', 'project.id', '=', 'project_translation.project_id')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->where('project_translation.locale', $locale)->active()->where('project_investor', 1);
                    if($request->get('sort')){
                        $projects = $projects->orderBy('project_translation.name', $request->get('sort'))->paginate(\Config::get('constants.paginate'));
                    }else{
                        $projects = $projects->position()->orderBy('project.id', 'DESC')->paginate(\Config::get('constants.paginate'));
                    }
                    $with = [
                        'banners' => $banners,
                        'projects' => $projects,
                    ];
                    break;
                }
                case 'investor-detail':
                {
                    $projects = \App\Models\Project::select('project.*', 'project_translation.name', 'project_translation.description', 'project_translation.slug', 'project_translation.project_address', 'project_translation.tag', 'project_translation.project_location', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->join('project_translation', 'project.id', '=', 'project_translation.project_id')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->where('project_translation.locale', $locale)->active()->where('project_investor', 1);
                    if($request->get('sort')){
                        $projects = $projects->orderBy('project_translation.name', $request->get('sort'))->paginate(\Config::get('constants.paginate-detail'));
                    }else{
                        $projects = $projects->position()->orderBy('project.id', 'DESC')->paginate(\Config::get('constants.paginate-detail'));
                    }
                    $count_projects = $this->project->datatable()->select('project.*', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->active()->where('project_investor', 1)->count();
                    $count_projects = ceil($count_projects / \Config::get('constants.paginate-detail'));
                    $project_last_update = null;
                    if($projects != null && count($projects) > 0){
                        $project_last_update = $this->projectlast->datatable()->where('project_id', $projects[0]->id)->orderBy('date', 'DESC')->paginate(\Config::get('constants.paginate-detail'));
                    }
                    $with = [
                        'projects' => $projects,
                        'project_last_update' => $project_last_update,
                        'count_projects' => $count_projects
                    ];
                    break;
                }
                case 'below-7000':
                {
                    $banners = $this->banner->datatable()->active()->where('page_id', $page->id)->orderBy('banner.position', 'ASC')->get();
                    $projects = \App\Models\Project::select('project.*', 'project_translation.name', 'project_translation.description', 'project_translation.slug', 'project_translation.project_address', 'project_translation.tag', 'project_translation.project_location', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->join('project_translation', 'project.id', '=', 'project_translation.project_id')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->where('project_translation.locale', $locale)->active()->where('project_price','<',7000);
                    if($request->get('sort')){
                        $projects = $projects->orderBy('project_translation.name', $request->get('sort'))->paginate(\Config::get('constants.paginate'));
                    }else{
                        $projects = $projects->position()->orderBy('project.id', 'DESC')->paginate(\Config::get('constants.paginate'));
                    }
                    $with = [
                        'banners' => $banners,
                        'projects' => $projects,
                    ];
                    break;
                }
                case 'below-7000-detail':
                {
                    $projects = \App\Models\Project::select('project.*', 'project_translation.name', 'project_translation.description', 'project_translation.slug', 'project_translation.project_address', 'project_translation.tag', 'project_translation.project_location', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->join('project_translation', 'project.id', '=', 'project_translation.project_id')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->where('project_translation.locale', $locale)->active()->where('project_price','<',7000);
                    $count_projects = $projects->count();
                    if($request->get('sort')){
                        $projects = $projects->orderBy('project_translation.name', $request->get('sort'))->paginate(\Config::get('constants.paginate-detail'));
                    }else{
                        $projects = $projects->position()->orderBy('project.id', 'DESC')->paginate(\Config::get('constants.paginate-detail'));
                    }
                    $count_projects = ceil($count_projects / \Config::get('constants.paginate-detail'));
                    $project_last_update = null;
                    if($projects != null && count($projects) > 0){
                        $project_last_update = $this->projectlast->datatable()->where('project_id', $projects[0]->id)->orderBy('date', 'DESC')->paginate(\Config::get('constants.paginate-detail'));
                    }
                    $with = [
                        'projects' => $projects,
                        'project_last_update' => $project_last_update,
                        'count_projects' => $count_projects
                    ];
                    break;
                }
                case 'near-mrt':
                {
                    $banners = $this->banner->datatable()->active()->where('page_id', $page->id)->orderBy('banner.position', 'ASC')->get();
                    $projects = \App\Models\Project::select('project.*', 'project_translation.name', 'project_translation.description', 'project_translation.slug', 'project_translation.project_address', 'project_translation.tag', 'project_translation.project_location', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->join('project_translation', 'project.id', '=', 'project_translation.project_id')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->where('project_translation.locale', $locale)->active()->where('project_mear_mrt', 1);
                    if($request->get('sort')){
                        $projects = $projects->orderBy('project_translation.name', $request->get('sort'))->paginate(\Config::get('constants.paginate'));
                    }else{
                        $projects = $projects->position()->orderBy('project.id', 'DESC')->paginate(\Config::get('constants.paginate'));
                    }
                    $with = [
                        'banners' => $banners,
                        'projects' => $projects,
                    ];
                    break;
                }
                case 'near-mrt-detail':
                {
                    $projects = \App\Models\Project::select('project.*', 'project_translation.name', 'project_translation.description', 'project_translation.slug', 'project_translation.project_address', 'project_translation.tag', 'project_translation.project_location', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->join('project_translation', 'project.id', '=', 'project_translation.project_id')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->where('project_translation.locale', $locale)->active()->where('project_mear_mrt', 1);
                    $count_projects = $projects->count();
                    if($request->get('sort')){
                        $projects = $projects->orderBy('project_translation.name', $request->get('sort'))->paginate(\Config::get('constants.paginate-detail'));
                    }else{
                        $projects = $projects->position()->orderBy('project.id', 'DESC')->paginate(\Config::get('constants.paginate-detail'));
                    }
                    $count_projects = ceil($count_projects / \Config::get('constants.paginate-detail'));
                    $project_last_update = null;
                    if($projects != null && count($projects) > 0){
                        $project_last_update = $this->projectlast->datatable()->where('project_id', $projects[0]->id)->orderBy('date', 'DESC')->paginate(\Config::get('constants.paginate-detail'));
                    }
                    $with = [
                        'projects' => $projects,
                        'project_last_update' => $project_last_update,
                        'count_projects' => $count_projects
                    ];
                    break;
                }
                case 'freehold':
                {
                    $banners = $this->banner->datatable()->active()->where('page_id', $page->id)->orderBy('banner.position', 'ASC')->get();
                    $projects = \App\Models\Project::select('project.*', 'project_translation.name', 'project_translation.description', 'project_translation.slug', 'project_translation.project_address', 'project_translation.tag', 'project_translation.project_location', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->join('project_translation', 'project.id', '=', 'project_translation.project_id')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->where('project_translation.locale', $locale)->active()->where('freehold', 1);
                    if($request->get('sort')){
                        $projects = $projects->orderBy('project_translation.name', $request->get('sort'))->paginate(\Config::get('constants.paginate'));
                    }else{
                        $projects = $projects->position()->orderBy('project.id', 'DESC')->paginate(\Config::get('constants.paginate'));
                    }
                    $with = [
                        'banners' => $banners,
                        'projects' => $projects,
                    ];
                    break;
                }
                case 'freehold-detail':
                {
                    $projects = \App\Models\Project::select('project.*', 'project_translation.name', 'project_translation.description', 'project_translation.slug', 'project_translation.project_address', 'project_translation.tag', 'project_translation.project_location', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->join('project_translation', 'project.id', '=', 'project_translation.project_id')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->where('project_translation.locale', $locale)->active()->where('freehold', 1);
                    if($request->get('sort')){
                        $projects = $projects->orderBy('project_translation.name', $request->get('sort'))->paginate(\Config::get('constants.paginate-detail'));
                    }else{
                        $projects = $projects->position()->orderBy('project.id', 'DESC')->paginate(\Config::get('constants.paginate-detail'));
                    }
                    $count_projects = $this->project->datatable()->select('project.*', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->active()->where('freehold', 1)->count();
                    $count_projects = ceil($count_projects / \Config::get('constants.paginate-detail'));
                    $project_last_update = null;
                    if($projects != null && count($projects) > 0){
                        $project_last_update = $this->projectlast->datatable()->where('project_id', $projects[0]->id)->orderBy('date', 'DESC')->paginate(\Config::get('constants.paginate-detail'));
                    }
                    $with = [
                        'projects' => $projects,
                        'project_last_update' => $project_last_update,
                        'count_projects' => $count_projects
                    ];
                    break;
                }
                case 'custom-report':
                {
                    $banners = $this->banner->datatable()->active()->where('page_id', $page->id)->orderBy('banner.position', 'ASC')->get();
                    $projects = $this->project->datatable()->select('project.*', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name', 'type_translation.name as type_name')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->leftJoin('type_translation', 'project.type_id', '=', 'type_translation.type_id')->active()->where('custom_report', 1)->position()->orderBy('id', 'DESC')->paginate(\Config::get('constants.paginate'));
                    $with = [
                        'banners' => $banners,
                        'projects' => $projects,
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
            }

            return view(THEME_PATH_VIEW . ".{$page->theme}", compact('page', 'blocks', 'metadata', 'types', 'tenures', 'districts'))->with($with);
        }
        return abort(404);
    }

}
