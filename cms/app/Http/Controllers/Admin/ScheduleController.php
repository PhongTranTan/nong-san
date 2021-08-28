<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ScheduleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Breadcrumb;
use Yajra\DataTables\Facades\DataTables;

class ScheduleController extends Controller
{
    protected $schedule;

    public function __construct(ScheduleRepository $schedule)
    {
        $this->schedule = $schedule;
    }

    public function index()
    {
        Breadcrumb::title(trans('admin_schedule.title'));
        
        return view('admin.schedule.index');
    }

    public function datatable()
    {
        $data = $this->schedule->datatable();
        return DataTables::of($data)
        	->editColumn(
                'type',
                function ($data) {
                    if ($data->type == 0){
                        return 'Scheduled Toure';
                    }
                    if ($data->type == 1){
                        return 'VVIP Registration';
                    }
                })
        	->editColumn(
                'property',
                function ($data) {
                	$property_name = null;
                	if($data->property){
                		$arr_property = json_decode($data->property);
                		foreach($arr_property as $property){
                			if($property == 1){
                				$property_name .= "- Own stay"."\r\n";
                			}
                			if($property == 2){
                				$property_name .= "- Invesment"."\r\n";
                			}
                		}
                		return $property_name;
                	}
                	return '';   
                })
        	->editColumn(
                'project_id',
                function ($data) {
                	$project_name = null;
                	if($data->project_id){
                		$arr_projects = explode(",", $data->project_id);
                		$projects = \App\Models\Project::whereIn('id', $arr_projects)->get();
                		foreach($projects as $project){
                			$project_name .= "- ".$project->name."\r\n";
                		}
                		return $project_name;
                	}
                	return '';   
                })
            ->addColumn(
                'action',
                function ($data) {
                    return view('admin.layouts.partials.table_button')->with(
                    [
                        'btn_view_datatable' => true,
                        'link_delete' => route('admin.schedule.destroy', $data->id),
                        'id_delete' => $data->id
                    ]
                )->render();
                }
            )
            ->escapeColumns(['fullname', 'phone', 'email', 'date', 'time', 'type', 'budget', 'number_of_rooms', 'property', 'project_id', 'message', 'agree'])
            ->make(true);
    }

    public function destroy($id)
    {
        $schedule = $this->schedule->find($id);
        $schedule->delete();

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_schedule.schedule')]));

        return redirect()->back();
    }
}
