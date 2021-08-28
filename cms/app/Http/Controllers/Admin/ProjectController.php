<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Breadcrumb;
use App\Http\Controllers\Controller;
use App\Repositories\ProjectRepository;
use App\Repositories\FloorCategoryRepository;
use App\Repositories\FloorTypeRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\TenureRepository;
use App\Repositories\DirectionRepository;
use App\Repositories\PurposeRepository;
use App\Repositories\TypeRepository;
use App\Repositories\ProjectFloorRepository;
use App\Repositories\ProjectLastRepository;
use App\Repositories\ProjectGalleryRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Project;


class ProjectController extends Controller
{
    protected $project;
    protected $floor_category;
    protected $floor_type;
    protected $district;
    protected $tenure;
    protected $types;
    protected $projectfloor;
    protected $projectlast;
    protected $direction;
    protected $purpose;
    protected $gallery;

    public function __construct(ProjectRepository $project, FloorTypeRepository $floor_type, FloorCategoryRepository $floor_category, DistrictRepository $district, TenureRepository $tenure, TypeRepository $type, ProjectFloorRepository $projectfloor, ProjectLastRepository $projectlast, DirectionRepository $direction, PurposeRepository $purpose, ProjectGalleryRepository $gallery)
    {
        $this->project = $project;
        $this->floor_category = $floor_category;
        $this->floor_type = $floor_type;
        $this->district = $district;
        $this->tenure = $tenure;
        $this->type = $type;
        $this->projectfloor = $projectfloor;
        $this->projectlast = $projectlast;
        $this->direction = $direction;
        $this->purpose = $purpose;
        $this->gallery = $gallery;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Breadcrumb::title(trans('project.title'));

        return view('admin.project.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Breadcrumb::title(trans('project.create'));

        $floor_categories = $this->floor_category->datatable()->get();

        $floor_types = $this->floor_type->datatable()->get();

        $check_floors = \DB::table('floor_type')->whereNotIn('parent_id', [0])->groupBy('parent_id')->get();

        $check_floor = [];

        foreach($check_floors as $check){
            $check_floor[] = $check->parent_id; 
        }

        $districts = $this->district->datatable()->get();

        $tenures = $this->tenure->datatable()->get();

        $types = $this->type->datatable()->get();

        $directions = $this->direction->datatable()->get();

        $purposes = $this->purpose->datatable()->get();

        return view('admin.project.create_edit', compact(
            'floor_categories', 
            'floor_types', 
            'districts', 
            'tenures', 
            'types', 
            'check_floor', 
            'directions', 
            'purposes')
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $locales = \Config::get('translatable.locales');

        $input = $request->all();

        $project['project_logo'] = $input['project_logo'];

        $project['develop'] = $input['develop'];

        $project['phone'] = $input['phone'];

        $project['whatsapp'] = $input['whatsapp'];

        $project['position'] = $input['position'];

        $project['pdf_all'] = $input['pdf_all'];  
        
        $project['show_pdf'] = $input['show_pdf'];

        $project['image_pdf_all'] = $input['image_pdf_all'];

        // $project['facebook'] = $input['facebook'];

        // $project['twitter'] = $input['twitter'];

        // $project['linkedin'] = $input['linkedin'];

        $project['project_background_section'] = $input['project_background_section'];

        //$project['project_watermark'] = $input['project_watermark'];

        $project['district_id'] = $input['district'];

        $project['tenure_id'] = $input['tenure'];

        $project['type_id'] = $input['type'];

        $project['purpose_id'] = $input['purpose'];

        $project['direction_id'] = $input['direction'];

        $project['project_more_url'] = $input['project_more_url'];

        $project['project_price'] = $input['project_price'];

        $project['project_lastest_launches'] = !empty($input['project_lastest_launches']) ? 1 : 0;

        $project['project_heavily_discount'] = !empty($input['project_heavily_discount']) ? 1 : 0;

        $project['project_investor'] = !empty($input['project_investor']) ? 1 : 0;

        $project['project_mear_mrt'] = !empty($input['project_mear_mrt']) ? 1 : 0;

        $project['freehold'] = !empty($input['freehold']) ? 1 : 0;

        $project['active'] = !empty($input['active']) ? 1 : 0;

        $project['option'] = !empty($input['option']) ? 1 : 0;

        $project['link_backup'] = isset($input['link_backup']) ? $input['link_backup'] : NULL;

        $project['star_buy'] = !empty($input['star_buy']) ? 1 : 0;

        $project['project_grid'] = json_encode($input['project_grid'], true);

        $project['email'] = isset($input['email']) ? $input['email'] : NULL;

        $project['project_price_table'] = json_encode($input['project_price_table'], true);

        $project['project_price_images'] = json_encode($input['project_price_images'], true);

        $project['project_slides'] = json_encode($input['project_slides'], true);     

        $project['location'] = isset($input['location']) ? $input['location'] : NULL;

        $project['lat'] = isset($input['lat']) ? $input['lat'] : NULL;

        $project['lng'] = isset($input['lng']) ? $input['lng'] : NULL;

        $project['custom_report'] = !empty($input['custom_report']) ? 1 : 0;

        $project['map_shape'] = !empty($input['map_shape']) ? $input['map_shape'] : NULL;

        $project['near_place'] = isset($input['near_place']) ? $input['near_place'] : NULL;

        $project['estimated_rental_yield'] = !empty($input['estimated_rental_yield']) ? $input['estimated_rental_yield'] : 0;

        $project['estimated_capital_appreciation'] = !empty($input['estimated_capital_appreciation']) ? $input['estimated_capital_appreciation'] : 0;

        $project_galleries = !empty($input['project_gallery']) ? $input['project_gallery'] : NULL;

        if (!empty($input['metadata'])) {
            $project['metadata'] = $input['metadata'];
        }

        foreach($locales as $locale){
            $project_text_grid['project_title'] = $input[$locale]['project_title'];

            $project_text_grid['project_subtitle'] = $input[$locale]['project_subtitle'];

            $project[$locale]['project_text_grid'] = json_encode($project_text_grid, true);

            $project[$locale]['name'] = $input[$locale]['name'];

            $project[$locale]['project_address'] = $input[$locale]['project_address'];

            $project[$locale]['project_location'] = NULL;

            $project[$locale]['tag'] = $input[$locale]['tag'];

            $project[$locale]['description'] = $input[$locale]['description'];

            $project[$locale]['project_price_title'] = $input[$locale]['project_price_title'];

            $project[$locale]['project_price_subtitle'] = $input[$locale]['project_price_subtitle'];

            $project[$locale]['project_price_description'] = $input[$locale]['project_price_description'];

            $project[$locale]['location_title'] = $input[$locale]['location_title'];

            $project[$locale]['location_subtitle'] = $input[$locale]['location_subtitle'];

            $project[$locale]['location_description'] = $input[$locale]['location_description'];

            $project[$locale]['gallery_title'] = $input[$locale]['gallery_title'];

            $project[$locale]['gallery_subtitle'] = $input[$locale]['gallery_subtitle'];

            $project[$locale]['gallery_description'] = $input[$locale]['gallery_description'];

            $project[$locale]['floorplan_title'] = $input[$locale]['floorplan_title'];

            $project[$locale]['floorplan_subtitle'] = $input[$locale]['floorplan_subtitle'];

            $project[$locale]['floorplan_description'] = $input[$locale]['floorplan_description'];

            $project[$locale]['contact_title'] = $input[$locale]['contact_title'];

            $project[$locale]['contact_subtitle'] = $input[$locale]['contact_subtitle'];

            $project[$locale]['contact_description'] = $input[$locale]['contact_description'];

            $project[$locale]['project_price_name_detail'] = json_encode($input[$locale]['price_name_detail'], true);
        }

        $project_id = $this->project->create($project);

        $project_floor['project_id'] = $project_id->id;

        $floor_categories = isset($input['floor_category_id']) ? $input['floor_category_id'] : [] ;

        $floor_type = isset($input['floor_type_id']) ? $input['floor_type_id'] : [] ;

        $last_update_date = $input['last_update_date'];

        if(count($floor_categories) > 0 && count($floor_type) > 0){
            foreach($floor_categories as $key_floor => $floor_category){
                if($floor_category != null && $floor_type[$key_floor] != null){
                    $project_floor['floor_category_id'] = $floor_category;
                    $project_floor['floor_type_id'] = $floor_type[$key_floor];
                    $project_floor['image'] = $input['project_floor_images'][$key_floor];
                    $project_floor['pdf'] = $input['project_floor_pdf'][$key_floor];
                    foreach($locales as $locale){
                        $project_floor[$locale]['content'] = $input[$locale]['project_floor_content'][$key_floor];
                        $project_floor[$locale]['unit'] = $input[$locale]['project_floor_unit'][$key_floor];
                    }
                    $this->projectfloor->create($project_floor);
                }
            }
        }

        if(isset($last_update_date) && count($last_update_date) > 0){
            foreach($last_update_date as $key_last => $last_update){
                if($last_update != null){
                    $project_last_update['project_id'] = $project_id->id;
                    $project_last_update['date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $last_update)->format('Y-m-d');
                    foreach($locales as $locale){
                        $project_last_update[$locale]['content'] = $input[$locale]['content_update'][$key_last];
                    }
                    $this->projectlast->create($project_last_update);
                }
            }
        }

        if(isset($project_galleries) && count($project_galleries) > 0){
            $project_gallery['project_id'] = $project_id->id;
            foreach($project_galleries as $key_gallery => $gallery){
                if($gallery != null){
                    $project_gallery['status'] = 1;
                    $project_gallery['position'] = $input['gallery_position'][$key_gallery];
                    $project_gallery['images'] = json_encode($gallery);
                    $this->gallery->create($project_gallery);
                }
            }
        }

        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_project.project')]));

        return redirect()->route('admin.project.index');
    }

    public function datatable()
    {
        $data = $this->project->datatable(1);

        return Datatables::of($data)
            ->editColumn(
                'active',
                function ($data) {
                    if ($data->active)
                        return '<span class="label label-success">'. trans('label.active') .'</span>';
                    return '<span class="label label-warning">'. trans('label.inactive') .'</span>';
                })
            ->addColumn(
                'action', function ($data) {
                return view('admin.layouts.partials.table_button')->with(
                    [
                        'link_edit' => route('admin.project.edit', $data->id),
                        'link_delete' => route('admin.project.destroy', $data->id),
                        'id_delete' => $data->id
                    ]
                )->render();
            })
            ->escapeColumns([])
            ->make(true);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Breadcrumb::title(trans('admin_tenure.edit'));

        $project = $this->project->find($id);

        $floor_categories = $this->floor_category->datatable()->get();

        $floor_types = $this->floor_type->datatable()->get();

        $check_floors = \DB::table('floor_type')->whereNotIn('parent_id', [0])->groupBy('parent_id')->get();

        $check_floor = [];

        foreach($check_floors as $check){
            $check_floor[] = $check->parent_id; 
        }

        $districts = $this->district->datatable()->get();

        $tenures = $this->tenure->datatable()->get();

        $types = $this->type->datatable()->get();

        $project_floors = $this->projectfloor->datatable()->where('project_id', $id)->get();

        $project_last_update = $this->projectlast->datatable()->where('project_id', $id)->get();

        $directions = $this->direction->datatable()->get();

        $purposes = $this->purpose->datatable()->get();

        $galleries = $this->gallery->datatable()->where('project_id', $id)->get();

        $metadata = $project->meta;

        return view('admin.project.create_edit', compact('project', 'floor_categories', 'floor_types', 'districts', 'tenures', 'types', 'check_floor', 'project_floors', 'project_last_update', 'directions', 'purposes', 'galleries', 'metadata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return *
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $locales = \Config::get('translatable.locales');

        $project['project_logo'] = $input['project_logo'];

        $project['develop'] = $input['develop'];

        $project['phone'] = $input['phone'];

        $project['whatsapp'] = $input['whatsapp'];

        $project['position'] = $input['position'];

        $project['pdf_all'] = $input['pdf_all'];  
        
        $project['show_pdf'] = $input['show_pdf'];

        $project['image_pdf_all'] = $input['image_pdf_all'];

        // $project['facebook'] = $input['facebook'];

        // $project['twitter'] = $input['twitter'];

        // $project['linkedin'] = $input['linkedin'];

        $project['project_background_section'] = $input['project_background_section'];

        //$project['project_watermark'] = $input['project_watermark'];

        $project['district_id'] = $input['district'];

        $project['tenure_id'] = $input['tenure'];

        $project['type_id'] = $input['type'];

        $project['purpose_id'] = $input['purpose'];

        $project['direction_id'] = $input['direction'];

        $project['project_more_url'] = $input['project_more_url'];

        $project['project_price'] = $input['project_price'];

        $project['project_lastest_launches'] = !empty($input['project_lastest_launches']) ? 1 : 0;

        $project['project_heavily_discount'] = !empty($input['project_heavily_discount']) ? 1 : 0;

        $project['project_investor'] = !empty($input['project_investor']) ? 1 : 0;

        $project['project_mear_mrt'] = !empty($input['project_mear_mrt']) ? 1 : 0;

        $project['freehold'] = !empty($input['freehold']) ? 1 : 0;

        $project['active'] = !empty($input['active']) ? 1 : 0;

        $project['option'] = !empty($input['option']) ? 1 : 0;

        $project['link_backup'] = isset($input['link_backup']) ? $input['link_backup'] : NULL;

        $project['star_buy'] = !empty($input['star_buy']) ? 1 : 0;

        $project['project_grid'] = json_encode($input['project_grid'], true);

        $project['email'] = isset($input['email']) ? $input['email'] : NULL;

        $project['project_price_table'] = json_encode($input['project_price_table'], true);

        $project['project_price_images'] = json_encode($input['project_price_images'], true);

        $project['project_slides'] = json_encode($input['project_slides'], true);

        $project['location'] = isset($input['location']) ? $input['location'] : NULL;

        $project['lat'] = isset($input['lat']) ? $input['lat'] : NULL;

        $project['lng'] = isset($input['lng']) ? $input['lng'] : NULL;

        $project['custom_report'] = !empty($input['custom_report']) ? 1 : 0;

        $project['map_shape'] = !empty($input['map_shape']) ? $input['map_shape'] : NULL;

        $project['near_place'] = isset($input['near_place']) ? $input['near_place'] : NULL;

        $project['estimated_rental_yield'] = !empty($input['estimated_rental_yield']) ? $input['estimated_rental_yield'] : 0;

        $project['estimated_capital_appreciation'] = !empty($input['estimated_capital_appreciation']) ? $input['estimated_capital_appreciation'] : 0;

        $project_galleries = (isset($input['project_gallery']) && !empty($input['project_gallery']) ) ? $input['project_gallery'] : NULL;

        if (!empty($input['metadata'])) {
            $project['metadata'] = $input['metadata'];
        }   

        foreach($locales as $locale){
            $project_text_grid['project_title'] = $input[$locale]['project_title'];

            $project_text_grid['project_subtitle'] = $input[$locale]['project_subtitle'];

            $project[$locale]['project_text_grid'] = json_encode($project_text_grid, true);

            $project[$locale]['name'] = $input[$locale]['name'];

            $project[$locale]['project_address'] = $input[$locale]['project_address'];

            $project[$locale]['project_location'] = NULL;

            $project[$locale]['tag'] = $input[$locale]['tag'];

            $project[$locale]['description'] = $input[$locale]['description'];

            $project[$locale]['project_price_title'] = $input[$locale]['project_price_title'];

            $project[$locale]['project_price_subtitle'] = $input[$locale]['project_price_subtitle'];

            $project[$locale]['project_price_description'] = $input[$locale]['project_price_description'];

            $project[$locale]['location_title'] = $input[$locale]['location_title'];

            $project[$locale]['location_subtitle'] = $input[$locale]['location_subtitle'];

            $project[$locale]['location_description'] = $input[$locale]['location_description'];

            $project[$locale]['gallery_title'] = $input[$locale]['gallery_title'];

            $project[$locale]['gallery_subtitle'] = $input[$locale]['gallery_subtitle'];

            $project[$locale]['gallery_description'] = $input[$locale]['gallery_description'];

            $project[$locale]['floorplan_title'] = $input[$locale]['floorplan_title'];

            $project[$locale]['floorplan_subtitle'] = $input[$locale]['floorplan_subtitle'];

            $project[$locale]['floorplan_description'] = $input[$locale]['floorplan_description'];

            $project[$locale]['contact_title'] = $input[$locale]['contact_title'];

            $project[$locale]['contact_subtitle'] = $input[$locale]['contact_subtitle'];

            $project[$locale]['contact_description'] = $input[$locale]['contact_description'];

            $project[$locale]['project_price_name_detail'] = json_encode($input[$locale]['price_name_detail'], true);
        }

        $project_id = $this->project->update($project, $id);

        $project_floor['project_id'] = $id;

        $floor_categories = isset($input['floor_category_id']) ? $input['floor_category_id'] : [] ;

        $floor_type = isset($input['floor_type_id']) ? $input['floor_type_id'] : [] ;

        $last_update_date = $input['last_update_date'];

        $check_floors = $this->projectfloor->datatable()->where('project_id', $id)->get();

        $check_last_update = $this->projectlast->datatable()->where('project_id', $id)->get();

        $check_galleries = $this->gallery->datatable()->where('project_id', $id)->get();

        if(isset($input['project_update'])){
            foreach($check_floors as $check_floor){
                if(!in_array($check_floor->id, $input['project_update'])){
                    $this->projectfloor->delete($check_floor->id);
                    $delete = \DB::table('project_floor_translation')->where('project_floor_id', $check_floor->id)->delete();
                }
            }
        } 
        
        if(isset($input['project_last_update'])){
            foreach($check_last_update as $check_last){
                if(!in_array($check_last->id, $input['project_last_update'])){
                    $this->projectlast->delete($check_last->id);
                    $delete = \DB::table('project_last_update_translation')->where('project_last_update_id', $check_last->id)->delete();
                }
            }
        }
       
        //-- temporary error correction
        $model =  $this->project->find($id);
        $model->floors()->delete();

        if(count($floor_categories) > 0 && count($floor_type) > 0){
            foreach($floor_categories as $key_floor => $floor_category){
                if($floor_category != null && $floor_type[$key_floor] != null){
                    $project_floor['floor_category_id'] = $floor_category;
                    $project_floor['floor_type_id'] = $floor_type[$key_floor];
                    $project_floor['image'] = $input['project_floor_images'][$key_floor];
                    $project_floor['pdf'] = $input['project_floor_pdf'][$key_floor];
                    foreach($locales as $locale){
                        $project_floor[$locale]['content'] = $input[$locale]['project_floor_content'][$key_floor];
                        $project_floor[$locale]['unit'] = $input[$locale]['project_floor_unit'][$key_floor];
                    }
                    $this->projectfloor->create($project_floor);
                    // if(isset($input['project_update'][$key_floor])){
                    //     $this->projectfloor->update($project_floor, $input['project_update'][$key_floor]);
                    // }else{
                    //   $this->projectfloor->create($project_floor);
                    // }
                }
            }
        } 

        if(isset($last_update_date) && count($last_update_date) > 0){
            foreach($last_update_date as $key_last => $last_update){
                if($last_update != null){
                    $project_last_update['project_id'] = $id;
                    $project_last_update['date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $last_update)->format('Y-m-d');
                    foreach($locales as $locale){
                        $project_last_update[$locale]['content'] = $input[$locale]['content_update'][$key_last];
                    }
                    if(isset($input['project_last_update'][$key_last])){
                        $this->projectlast->update($project_last_update, $input['project_last_update'][$key_last]);
                    }else{
                        $this->projectlast->create($project_last_update);
                    }
                }
            }
        } 

        if(isset($project_galleries) && count($project_galleries) > 0){
            foreach($project_galleries as $key_gallery_update => $gallery){
                if($gallery != null){
                    if(isset($input['gallery_id'])){
                        if(in_array($key_gallery_update, $input['gallery_id'])){
                            $project_gallery['position'] = $input['gallery_position'][$key_gallery_update];
                            $project_gallery['images'] = json_encode($gallery);
                            $this->gallery->update($project_gallery, $key_gallery_update);
                        }else{
                            $project_gallery['project_id'] = $project_id->id;
                            $project_gallery['status'] = 1;
                            $project_gallery['position'] = $input['gallery_position'][$key_gallery_update];
                            $project_gallery['images'] = json_encode($gallery);
                            $this->gallery->create($project_gallery);
                        }
                    }else{
                        $project_gallery['project_id'] = $project_id->id;
                        $project_gallery['status'] = 1;
                        $project_gallery['position'] = $input['gallery_position'][$key_gallery_update];
                        $project_gallery['images'] = json_encode($gallery);
                        $this->gallery->create($project_gallery);
                    }
                }
            }
        }

        foreach($check_galleries as $check_gallery){
            if(isset($input['gallery_id'])){
                if(!in_array($check_gallery->id, $input['gallery_id'])){
                    $this->gallery->delete($check_gallery->id);
                }
            }else{
                $this->gallery->delete($check_gallery->id);
            }
        }

        if($request->ajax()){
            return ['success'=>true, 'message'=>'Cập nhật trạng thái khách hàng thành công','notify_class'=>'success'];
        }

        session()->flash('success', trans('admin_message.updated_successful', ['attr' => trans('admin_project.project')]));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->project->delete($id);

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_project.project')]));

        return redirect()->back();
    }

    public function sort()
    {
        $projects = $this->project->sortProject();
        return view('admin.project.sort_project', compact(
            'projects'
        ));
    }

    public function sortUpdate(Request $request)
    {
        $input = $request->input();
        $positions = $input['positions'];
        foreach ($positions as $key => $value) {
            Project::where('id', $key)
                ->update([
                    'position' => $value['position']
                ]);
        }
        session()->flash(
            'success', 
            'Update success display order project!'
        );
        return redirect()->back();
    }
}