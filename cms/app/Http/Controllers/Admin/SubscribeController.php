<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\SubscribeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Breadcrumb;
use Yajra\DataTables\Facades\DataTables;

class SubscribeController extends Controller
{
    protected $subscribe;

    public function __construct(SubscribeRepository $subscribe)
    {
        $this->subscribe = $subscribe;
    }

    public function index()
    {
        Breadcrumb::title(trans('admin_contact.title'));
        
        return view('admin.subscribe.index');
    }

    public function datatable()
    {
        $data = $this->subscribe->datatable();
        return DataTables::of($data)
            ->editColumn(
                'status',
                function ($data) {
                    if ($data->status)
                        return '<span class="label label-status label-success">'. trans('admin_subscribe.active') .'</span>';
                    return '<span class="label label-status label-warning">'. trans('admin_subscribe.inactive') .'</span>';
                })
            ->editColumn(
                'created_at',
                function ($data) {
                    return cvDbTime($data->created_at, DB_TIME, PHP_DATE_TIME);
                }
            )
            ->addColumn(
                'action',
                function ($data) {
                    return view('admin.layouts.partials.table_button')->with(
                    [
                        'btn_status' => true,
                        'id_update' => $data->id,
                        'link_delete' => route('admin.subscribe.destroy', $data->id),
                        'id_delete' => $data->id
                    ]
                )->render();
                }
            )
            ->escapeColumns([])
            ->make(true);
    }

    public function destroy($id)
    {
        $subscribe = $this->subscribe->find($id);

        $subscribe->delete();

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_subscribe.subscribe')]));

        return redirect()->back();
    }

    public function updateStatus(Request $rq){
    	$input = $rq->all();
    	$check = \DB::table('subscribe')->where('id', $input['id'])->first();
    	if($check != null){
    		($check->status == 0) ? $status = 1 : $status = 0;
    		$update = \DB::table('subscribe')->where('id', $check->id)->update(['status' => $status]);
    		return $status;
    	}
    	return false;
    }
}
