<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\NewsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\Breadcrumb;
use Yajra\DataTables\Facades\DataTables;
use App\Jobs\SubscribeJob;
use App\Repositories\NewsCategoryRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\News;

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

    public function index()
    {
        Breadcrumb::title(trans('admin_news.title'));
        return view('admin.news.index');
    }

    public function create()
    {
        Breadcrumb::title(trans('admin_news.create'));
        $newsCategories = $this->newsCategory->datatable()->get();
        return view('admin.news.create_edit', compact(
            'newsCategories'
        ));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['publish_date'] = Carbon::createFromFormat(
            'd/m/Y', 
            $input['publish_date']
        )->format('Y-m-d');
        $news = $this->news->create($input);
        $lang = App::getLocale('en');
        $data = DB::table('news')
            ->join('news_translation', 'news.id', '=', 'news_translation.news_id')
            ->where('news_translation.locale', $lang)
            ->where('news.id', $news->id)
            ->first();
        $this->dispatch(new SubscribeJob($data));
        session()->flash(
            'success', 
            trans('admin_message.created_successful', [
                'attr' => trans('admin_news.news')
            ]));
        return redirect()->route('admin.news.index');
    }

    public function datatable()
    {
        $data = $this->news->datatable([
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
                        'link_edit' => route('admin.news.edit', $data->id),
                        'link_delete' => route('admin.news.destroy', $data->id),
                        'id_delete' => $data->id
                    ]
                )->render();
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function edit($id)
    {
        Breadcrumb::title(trans('admin_news.edit'));
        $news = $this->news->find($id);
        $metadata = $news->meta;
        $newsCategories = $this->newsCategory->datatable()->get();
        return view('admin.news.create_edit', compact(
            'news', 
            'metadata',
            'newsCategories'
        ));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $input['publish_date'] = Carbon::createFromFormat(
            'd/m/Y', 
            $input['publish_date']
        )->format('Y-m-d');
        $this->news->update($input, $id);
        session()->flash(
            'success', 
            trans('admin_message.updated_successful', [
                'attr' => trans('admin_news.news')
            ]));
        return back();
    }

    public function destroy($id)
    {
        $this->news->delete($id);
        session()->flash(
            'success', 
            trans('admin_message.deleted_successful', [
                'attr' => trans('admin_news.news')
            ]));
        return redirect()->back();
    }

    public function storeDataTest(Request $request)
    {
        $input = News::first()->toArray();
        unset($input['id']);
        $count = 0;
        $newsCategories = $this->newsCategory->datatable()->get();
        foreach ($newsCategories as $key => $newsCategory) {
            $input['news_category_id'] = $newsCategory->id;
            for ($i = 0; $i < 15; $i++) {
                $count++;
                $input['slug'] = $this->generateRandomString();
                $input['name'] = "news" . $this->generateRandomString();
                $news = $this->news->create($input);
                echo "$news->name ";
                echo " \n" . route('frontend.news.detail',[
                    'slug' => $news->slug
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
        return "news-$randomString";
    }
}
