<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ContactRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Breadcrumb;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    protected $contact;

    public function __construct(ContactRepository $contact)
    {
        $this->contact = $contact;
    }

    public function index()
    {
        Breadcrumb::title(trans('admin_contact.title'));
        
        return view('admin.contact.index');
    }

    public function datatable()
    {
        $data = $this->contact->datatable();
        return DataTables::of($data)
            ->editColumn(
                'type',
                function ($data) {
                    $type = null;
                    $check_type = json_decode($data->type);
                    if(is_array($check_type)){
                        if (in_array(1, $check_type)){
                            $type .= "- ".trans('label.home_loan')."\r\n";
                        }
                        if (in_array(2, $check_type)){
                            $type .= "- ".trans('label.mortgage_insurance');
                        }
                        if (in_array(3, $check_type)){
                            $type .= "Contact Project";
                        }
                    }else{
                        $type .= trans('label.contact_mail');
                    }
                    return $type;
                })
            ->editColumn(
                'project_id',
                function ($data) {
                    if ($data->project_id != null){
                        $project = \DB::table('project')->join('project_translation', 'project.id', '=', 'project_translation.project_id')->where('project.id', $data->project_id)->where('project_translation.locale', 'en')->first();
                        if($project != null){
                            return $project->name;
                        }else{
                            return '';
                        }
                    }
                    return '';
                }
            )
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
                        'btn_view_datatable' => true,
                        'link_delete' => route('admin.contact.destroy', $data->id),
                        'id_delete' => $data->id
                    ]
                )->render();
                }
            )
            ->escapeColumns(['name', 'phone', 'email', 'type', 'message', 'project_id'])
            ->make(true);
    }

    public function destroy($id)
    {
        $contact = $this->contact->find($id);
        $contact->delete();

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_contact.contact')]));

        return redirect()->back();
    }
}
