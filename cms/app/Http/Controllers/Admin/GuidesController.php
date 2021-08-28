<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\GuidesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\Breadcrumb;
use Yajra\DataTables\Facades\DataTables;
use App\Jobs\SubscribeJob;
use App\Repositories\GuidesCategoryRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Models\Guides;

class GuidesController extends Controller
{
    protected $guides;
    protected $guidesCategory;

    public function __construct(
        GuidesRepository $guides, 
        GuidesCategoryRepository $guidesCategory
    )
    {
        parent::__construct();
        $this->guides = $guides;
        $this->guidesCategory = $guidesCategory;
    }

    public function index()
    {
        Breadcrumb::title(trans('admin_guides.title'));
        return view('admin.guides.index');
    }

    public function create()
    {
        Breadcrumb::title(trans('admin_guides.create'));
        $guideCategories = $this->guidesCategory->datatable()->get();
        return view('admin.guides.create_edit', compact(
            'guideCategories'
        ));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['publish_date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $input['publish_date'])->format('Y-m-d');
        $guide = $this->guides->create($input);
        $lang = App::getLocale('en');
        $data = DB::table('guides')->join('guides_translation', 'guides.id', '=', 'guides_translation.guides_id')->where('guides_translation.locale', $lang)->where('guides.id', $guide->id)->first();
        $this->dispatch(new SubscribeJob($data));
        session()->flash(
            'success', 
            trans('admin_message.created_successful', [
                'attr' => trans('admin_guides.guides')
            ]));
        return redirect()->route('admin.guides.index');
    }

    public function datatable()
    {
        $data = $this->guides->datatable([
            'translations'
        ]);
        return Datatables::of($data)
            ->editColumn(
                'highlight',
                function ($data) {
                    if ($data->highlight)
                        return '<span class="label label-success">'. trans('label.active') .'</span>';
                    return '<span class="label label-warning">'. trans('label.inactive') .'</span>';
                })
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
                        'link_edit' => route('admin.guides.edit', $data->id),
                        'link_delete' => route('admin.guides.destroy', $data->id),
                        'id_delete' => $data->id
                    ]
                )->render();
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function edit($id)
    {
        Breadcrumb::title(trans('admin_guides.edit'));
        $guides = $this->guides->find($id);
        $metadata = $guides->meta;
        $guideCategories = $this->guidesCategory->datatable()->get();
        return view('admin.guides.create_edit', compact(
            'guides', 
            'metadata',
            'guideCategories'
        ));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $input['publish_date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $input['publish_date'])->format('Y-m-d');
        $this->guides->update($input, $id);
        session()->flash(
            'success', 
            trans('admin_message.updated_successful', [
                'attr' => trans('admin_guides.guides')
            ]));
        return back();
    }

    public function destroy($id)
    {
        $this->guides->delete($id);
        session()->flash(
            'success', 
            trans('admin_message.deleted_successful', [
                'attr' => trans('admin_guides.guides')
            ]));
        return redirect()->back();
    }

    public function storeDataTest(Request $request)
    {
        $input = Guides::first()->toArray();
        unset($input['id']);
        $count = 0;
        $guidesCategories = $this->guidesCategory->datatable()->get();
        foreach ($guidesCategories as $key => $guidesCategory) {
            $input['guides_category_id'] = $guidesCategory->id;
            for ($i = 0; $i < 15; $i++) {
                $count++;
                $input['slug'] = $this->generateRandomString();
                $input['title'] = "guides" . $this->generateRandomString();
                $guides = $this->guides->create($input);
                echo "$guides->title ";
                echo " \n" . route('frontend.guides.detail',[
                    'slug' => $guides->slug
                ]) . " \n";
            }
        }
        return "Create Done $count record!";
    }

    public function generateRandomString($length = 30) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz-';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return "guides-$randomString";
    }
}
