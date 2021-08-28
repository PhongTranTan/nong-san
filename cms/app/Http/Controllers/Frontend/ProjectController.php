<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\ProjectRepository;
use App\Repositories\ProjectFloorRepository;
use App\Repositories\FloorCategoryRepository;
use App\Repositories\FloorTypeRepository;
use App\Repositories\ProjectLastRepository;
use App\Repositories\TenureRepository;
use App\Repositories\TypeRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\BannerRepository;
use App\Repositories\ProjectGalleryRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Repositories\LinkReportRepository;

class ProjectController extends Controller
{
    protected $project;
    protected $projectfloor;
    protected $floor_type;
    protected $floor_category;
    protected $projectlast;
    protected $purpose;
    protected $district;
    protected $type;
    protected $project_gallery;
    protected $banner;
    protected $linkreport;

    public function __construct( ProjectRepository $project, FloorTypeRepository $floor_type, FloorCategoryRepository $floor_category, ProjectFloorRepository $projectfloor, ProjectLastRepository $projectlast, TenureRepository $tenure, TypeRepository $type, DistrictRepository $district, ProjectGalleryRepository $project_gallery, BannerRepository $banner, LinkReportRepository $linkreport)
    {
        parent::__construct();
        $this->project = $project;
        $this->projectfloor = $projectfloor;
        $this->floor_type = $floor_type;
        $this->floor_category = $floor_category;
        $this->projectlast = $projectlast;
        $this->type = $type;
        $this->district = $district;
        $this->tenure = $tenure;
        $this->project_gallery = $project_gallery;
        $this->banner = $banner;
        $this->linkreport = $linkreport;
    }

    public function getProjectDetail($slug)
    {
        $page = Page::where('code', 'PROJECT-DETAIL')->first();

        $blocks = [];

        if ($page->parentBlocks->count()) {
            $blocks = $page->parentBlocks->groupBy('code');
        }

        $project = $this->project->findBySlug($slug);

        if($project){
            $metadata = $project->meta;
        }

        $project_floors = $this->projectfloor->datatable()->where('project_id', $project->id)->get();

        $project_last_update = $this->projectlast->datatable()->where('project_id', $project->id)->orderBy('date', 'DESC')->paginate(6);

        $arr_floor_types = $arr_floor_categories = $filter_types = $floor_types = [];

        if($project_floors){
            foreach($project_floors as $key_floor => $project_floor){

                if(!isset($arr_floor_types[$project_floor->floor_category_id])){
                    $arr_floor_types[$project_floor->floor_category_id] = [];
                }

                if(!in_array($project_floor->floor_category_id, $arr_floor_categories)){
                    $arr_floor_categories[] = $project_floor->floor_category_id;
                }

                $check_type_parent = $this->floor_type->datatable()->where('id', $project_floor->floor_type_id)->first();

                if(isset($check_type_parent->parent_id) && $check_type_parent->parent_id != 0){
                    
                    $arr_floor_types[$project_floor->floor_category_id][$check_type_parent->parent_id][] = $project_floor->floor_type_id;

                    if(!in_array($check_type_parent->parent_id, $filter_types)){
                        $filter_types[] = $check_type_parent->parent_id;
                        $get_parent_type = $this->floor_type->datatable()->where('id', $check_type_parent->parent_id)->first();
                        $floor_types[$get_parent_type->id] = $get_parent_type;
                    }

                    if(!in_array($project_floor->floor_type_id, $filter_types)){
                        $filter_types[] = $project_floor->floor_type_id;
                        $floor_types[$check_type_parent->id] = $check_type_parent;
                    }

                }else{
                    $arr_floor_types[$project_floor->floor_category_id][$project_floor->floor_type_id] = [];

                    if(!in_array($project_floor->floor_type_id, $filter_types)){
                        $filter_types[] = $project_floor->floor_type_id;
                        $floor_types[$check_type_parent->id] = $check_type_parent;
                    }

                } 

            }
        }

        $floor_categories = $this->floor_category->datatable()->whereIn('id', $arr_floor_categories)->get();

        $project_galleries = $this->project_gallery->datatable()->where('project_id', $project->id)->where('status', 1)->get();

        return view('themes.project-detail', compact('project', 'project_floors', 'floor_categories', 'floor_types', 'filter_types', 'arr_floor_types', 'project_last_update', 'project_galleries', 'blocks', 'metadata'));
    }

    public function getTypeInfo(Request $rq){
        $locale = app()->getLocale();
        $input = $rq->all();
        $info = json_decode($input['info']);
        $open = $info->open;
        $project = $info->project;
        $arr_open = explode("-", $open);
        $count_arr_open = count($arr_open);
        $category = $type = $subtype = null;
        if($count_arr_open >= 3){
            if($count_arr_open == 3){
                if(isset($arr_open[1]) && isset($arr_open[2])){
                    $category = $arr_open[1];
                    $type = $arr_open[2];
                }
            }else{
                if(isset($arr_open[1]) && isset($arr_open[2]) && isset($arr_open[3])){
                    $category = $arr_open[1];
                    $type = $arr_open[3];
                }
            }
        }
        $project_floor['info'] = $this->projectfloor->datatable()
                                            ->where('floor_category_id', $category)
                                            ->where('floor_type_id', $type)
                                            ->where('project_id', $project)
                                            ->first();
        $project_floor['category'] = \DB::table('floor_category_translation')->where('locale', $locale)->where('floor_category_id', $category)->first();
        $project_floor['type'] = \DB::table('floor_type_translation')->where('locale', $locale)->where('floor_type_id', $type)->first();
        return json_encode($project_floor);
    }

    public function getProjectDetailInfo(Request $rq){
        $input = $rq->all();
        $project = $this->project->datatable()->select('project.*', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->active()->where('project.id', $input["data"])->first();
        $project_last_update = null;
        if($project != null){
            $project_last_update = $this->projectlast->datatable()->where('project_id', $project->id)->orderBy('date', 'DESC')->paginate(6);
        }
        $data['project'] = $project;
        $data['project_last_update'] = $project_last_update;
        return json_encode($data);
    }

    public function getProjectLoadMore(Request $rq){
        $input = $rq->all();
        $page_current = $input['take'];
        $skip = $page_current * \Config::get('constants.paginate-detail');
        $take = \Config::get('constants.paginate-detail');
        $projects = $this->project->datatable()
                    ->select('project.*', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')
                    ->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')
                    ->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')
                    ->position()
                    ->active()->orderBy('id', 'DESC')->skip($skip)->take($take)->get();
        return json_encode($projects);
    }

    public function getProjectInvestorLoadMore(Request $rq){
        $input = $rq->all();
        $page_current = $input['take'];
        $skip = $page_current * \Config::get('constants.paginate-detail');
        $take = \Config::get('constants.paginate-detail');
        $projects = $this->project->datatable()
                    ->select('project.*', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')
                    ->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')
                    ->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')
                    ->active()->where('project_investor', 1)
                    ->position()
                    ->orderBy('id', 'DESC')->skip($skip)->take($take)->get();
        return json_encode($projects);
    }

    public function getProjectBelowLoadMore(Request $rq){
        $input = $rq->all();
        $page_current = $input['take'];
        $skip = $page_current * \Config::get('constants.paginate-detail');
        $take = \Config::get('constants.paginate-detail');
        $projects = $this->project->datatable()
                    ->select('project.*', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')
                    ->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')
                    ->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')
                    ->active()->where('project_price','<',7000)
                    ->position()
                    ->orderBy('id', 'DESC')->skip($skip)->take($take)->get();
        return json_encode($projects);
    }

    public function getProjectFreeHoldLoadMore(Request $rq){
        $input = $rq->all();
        $page_current = $input['take'];
        $skip = $page_current * \Config::get('constants.paginate-detail');
        $take = \Config::get('constants.paginate-detail');
        $projects = $this->project->datatable()
                    ->select('project.*', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')
                    ->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')
                    ->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')
                    ->active()->where('freehold', 1)
                    ->position()
                    ->orderBy('id', 'DESC')->skip($skip)->take($take)->get();
        return json_encode($projects);
    }

    public function getProjectHeavilyLoadMore(Request $rq){
        $input = $rq->all();
        $page_current = $input['take'];
        $skip = $page_current * \Config::get('constants.paginate-detail');
        $take = \Config::get('constants.paginate-detail');
        $projects = $this->project->datatable()
                    ->select('project.*', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')
                    ->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')
                    ->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')
                    ->active()->where('project_heavily_discount', 1)
                    ->position()
                    ->orderBy('id', 'DESC')->skip($skip)->take($take)->get();
        return json_encode($projects);
    }

    public function getProjectLastestLoadMore(Request $rq){
        $input = $rq->all();
        $page_current = $input['take'];
        $skip = $page_current * \Config::get('constants.paginate-detail');
        $take = \Config::get('constants.paginate-detail');
        $projects = $this->project->datatable()
                    ->select('project.*', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')
                    ->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')
                    ->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')
                    ->active()->where('project_lastest_launches', 1)
                    ->position()
                    ->orderBy('id', 'DESC')->skip($skip)->take($take)->get();
        return json_encode($projects);
    }

    public function getProjectNearMRTLoadMore(Request $rq){
        $input = $rq->all();
        $page_current = $input['take'];
        $skip = $page_current * \Config::get('constants.paginate-detail');
        $take = \Config::get('constants.paginate-detail');
        $projects = $this->project->datatable()
                    ->select('project.*', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')
                    ->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')
                    ->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')
                    ->active()->where('project_mear_mrt', 1)
                    ->position()
                    ->orderBy('id', 'DESC')->skip($skip)->take($take)->get();
        return json_encode($projects);
    }

    public function getReloadFavorite(Request $rq){
        $input = $rq->all();
        $arr_project = json_decode($input['favorite']);
        $project = $this->project->datatable()
                    ->select('project.*', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')
                    ->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')
                    ->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')
                    ->whereIn('project.id', $arr_project)->active()->get();
        return json_encode($project);
    }

    public function addFavoriteProject(Request $rq){
        $input = $rq->all();
        $project = $this->project->datatable()
                    ->select('project.*', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')
                    ->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')
                    ->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')
                    ->where('project.id', $input['add_favorite'])->active()->get();
        return json_encode($project);
    }

    public function getSearchIndex(Request $rq){
        $locale = app()->getLocale();
        $input = $rq->all();
        $parameters = $rq->query();

        $page = Page::where('code', 'SEARCH-INDEX')->first();
        $banners = $this->banner->datatable()->active()->where('page_id', $page->id)->orderBy('id', 'DESC')->get();

        $tenures = $this->tenure->datatable()->active()->get();

        $districts = $this->district->datatable()->active()->get();

        $types = $this->type->datatable()->active()->get();

        $projects = [];
        $count_project = 0;
        if($rq->get('submit') == ''){

            $projects = \DB::table('project')->select('project.*', 'project_translation.name', 'project_translation.slug', 'project_translation.description', 'project_translation.tag', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->join('project_translation', 'project.id', '=', 'project_translation.project_id')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->where('active', 1)->where('project_translation.locale', $locale);

            if(isset($input['purpose']) || isset($input['tenure']) || isset($input['direction']) || isset($input['search']) || isset($input['district']) || isset($input['type'])){
                
                if(isset($input['purpose']) && $input['purpose'] != null){
                    $projects = $projects->whereIn('project.purpose_id', $input['purpose']);
                }
                if(isset($input['tenure']) && $input['tenure'] != null && $input['tenure'][0] != 0){
                    $projects = $projects->whereIn('project.tenure_id', $input['tenure']);
                }
                if(isset($input['direction']) && $input['direction'] != null){
                    $projects = $projects->whereIn('project.direction_id', $input['direction']);
                }
                if(isset($input['district']) && $input['district'] != null && $input['district'][0] != 0){
                    $projects = $projects->whereIn('project.district_id', $input['district']);
                }
                if(isset($input['type']) && $input['type'] != null && $input['type'][0] != 0){
                    $projects = $projects->whereIn('project.type_id', $input['type']);
                }
                if(isset($input['search']) && $input['search'] != null){
                    $search = $input['search'];
                    $projects = $projects->where(function($query) use($search){
                        $query->where('project_translation.name', 'like', '%'.$search.'%')
                                ->orWhere('project_translation.project_address', 'like', '%'.$search.'%')
                                ->orWhere('project.location', 'like', '%'.$search.'%');
                    });
                }
                $count_project = $projects->count();
                if($rq->get('sort')){
                    $projects = $projects->orderBy('project_translation.name', $rq->get('sort'))->paginate(\Config::get('constants.paginate'));
                }else{
                    $projects = $projects->orderBy('project.position', 'DESC')->orderBy('project.id', 'DESC')->paginate(\Config::get('constants.paginate'));
                }
            }else{
                $count_project = $projects->count();
                if($rq->get('sort')){
                    $projects = $projects->orderBy('project_translation.name', $rq->get('sort'))->paginate(\Config::get('constants.paginate'));
                }else{
                    $projects = $projects->orderBy('project.position', 'DESC')->orderBy('project.id', 'DESC')->paginate(\Config::get('constants.paginate'));
                }
            }
            return view('themes.search-index', compact('projects', 'count_project', 'tenures', 'districts', 'types', 'banners', 'parameters'));
        }
        return abort(404);
    }

    public function getSearchIndexDetail(Request $rq){
        $locale = app()->getLocale();
        $input = $rq->all();
        $parameters = $rq->query();
        $page = Page::where('code', 'SEARCH-INDEX-DETAIL')->first();
        $banners = $this->banner->datatable()->active()->where('page_id', $page->id)->orderBy('id', 'DESC')->get();

        $tenures = $this->tenure->datatable()->active()->get();

        $districts = $this->district->datatable()->active()->get();

        $types = $this->type->datatable()->active()->get();
        $with = [];
        if($rq->get('submit') == ''){

            $projects = \DB::table('project')->select('project.*', 'project_translation.name', 'project_translation.slug', 'project_translation.description', 'project_translation.tag', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name')->join('project_translation', 'project.id', '=', 'project_translation.project_id')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')->where('active', 1)->where('project_translation.locale', $locale);

            if(isset($input['purpose']) || isset($input['tenure']) || isset($input['direction']) || isset($input['search']) || isset($input['district']) || isset($input['type'])){
                
                if(isset($input['purpose']) && $input['purpose'] != null){
                    $projects = $projects->whereIn('project.purpose_id', $input['purpose']);
                }
                if(isset($input['tenure']) && $input['tenure'] != null && $input['tenure'][0] != 0){
                    $projects = $projects->whereIn('project.tenure_id', $input['tenure']);
                }
                if(isset($input['direction']) && $input['direction'] != null){
                    $projects = $projects->whereIn('project.direction_id', $input['direction']);
                }
                if(isset($input['district']) && $input['district'] != null && $input['district'][0] != 0){
                    $projects = $projects->whereIn('project.district_id', $input['district']);
                }
                if(isset($input['type']) && $input['type'] != null && $input['type'][0] != 0){
                    $projects = $projects->whereIn('project.type_id', $input['type']);
                }
                if(isset($input['search']) && $input['search'] != null){
                    $search = $input['search'];
                    $projects = $projects->where(function($query) use($search){
                        $query->where('project_translation.name', 'like', '%'.$search.'%')
                                ->orWhere('project_translation.project_address', 'like', '%'.$search.'%')
                                ->orWhere('project.location', 'like', '%'.$search.'%');
                    });
                }
                $count_projects = $projects->count();
                if($rq->get('sort')){
                    $projects = $projects->orderBy('project_translation.name', $rq->get('sort'))->paginate(\Config::get('constants.paginate-detail'));
                }else{
                    $projects = $projects->orderBy('project.position', 'DESC')->orderBy('project.id', 'DESC')->paginate(\Config::get('constants.paginate-detail'));
                }
                $count_projects = ceil($count_projects / \Config::get('constants.paginate-detail'));
                $project_last_update = null;
                if($projects != null && count($projects) > 0){
                    $project_last_update = $this->projectlast->datatable()->where('project_id', $projects[0]->id)->orderBy('date', 'DESC')->paginate(\Config::get('constants.paginate-detail'));
                }
                $with = ['count_projects' => $count_projects, 'project_last_update' => $project_last_update, 'projects' => $projects, 'tenures' => $tenures, 'districts' => $districts, 'types' => $types];
            }
            else{
                $count_projects = $projects->count();
                if($rq->get('sort')){
                    $projects = $projects->orderBy('project_translation.name', $rq->get('sort'))->paginate(\Config::get('constants.paginate-detail'));
                }else{
                    $projects = $projects->orderBy('project.position', 'DESC')->orderBy('project.id', 'DESC')->paginate(\Config::get('constants.paginate-detail'));
                }
                $count_projects = ceil($count_projects / \Config::get('constants.paginate-detail'));
                $with = ['count_projects' => $count_projects, 'projects' => $projects, 'tenures' => $tenures, 'districts' => $districts, 'types' => $types];
            }
            return view('themes.search-index-detail', compact('banners', 'parameters'))->with($with);
        }
        return abort(404);
    }

    public function getLinkReport(Request $rq, $link){
        $page = Page::where('code', 'CUSTOM-REPORT')->first();
        
        $linkreport = $this->linkreport->datatable()->where('url', $link)->first();

        if(!$linkreport){
            return abort(404);
        }

        $banner_images = json_decode($linkreport->banner_images);

        $banner_title = json_decode($linkreport->banner_title);

        $banner_description = json_decode($linkreport->banner_description);

        $check_projects = json_decode($linkreport->project_choose);

        $projects = $this->project->datatable()
        ->select('project.*', 'district_translation.name as district_name', 'tenure_translation.name as tenure_name', 'type_translation.name as type_name')->leftJoin('district_translation', 'project.district_id', '=', 'district_translation.district_id')
        ->leftJoin('tenure_translation', 'project.tenure_id', '=', 'tenure_translation.tenure_id')
        ->leftJoin('type_translation', 'project.type_id', '=', 'type_translation.type_id')
        ->active()
        ->whereIn('project.id', $check_projects)
        ->orderBy('project.position', 'DESC')
        ->orderBy('project.id', 'DESC')
        ->paginate(\Config::get('constants.paginate-detail'));

        return view('themes.custom-report', compact('projects', 'linkreport', 'banner_images', 'banner_title', 'banner_description'));
    }
}
