<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\Breadcrumb;
use App\Repositories\MenuRepository;
use App\Repositories\PageRepository;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $menu;

    public function __construct(MenuRepository $menu){
        $this->menu = $menu;
    }

    public function index()
    {

        Breadcrumb::title(trans('admin_menus.title'));
        return view('admin.menu.index');
    }

    public function datatable()
    {
        $data = $this->menu->datatable();
        return DataTables::of($data)
            ->addColumn(
                'translations',
                function ($data) {
                    return $data->title;
                }
            )
            ->addColumn(
                'action',
                function ($data) {
                    return view('admin.layouts.partials.table_button')->with(
                        [
                        'link_edit' => route('admin.menu.edit', $data->id),
                        'link_delete' => route('admin.menu.destroy', $data->id),
                        'id_delete' => $data->id
                        ]
                    )->render();
                }
            )
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Breadcrumb::title(trans('admin_menus.create'));

        return view('admin.menu.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();



        $this->menu->store($input);

        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_menus.menu')]));

        return redirect()->route('admin.menu.index');
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
        Breadcrumb::title(trans('admin_menu.edit'));

        $menu = $this->menu->find($id);

        return view('admin.menu.create_edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $this->menu->update($input, $id);

        session()->flash('success', trans('admin_message.updated_successful', ['attr' => trans('admin_menu.menu')]));

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
        $this->menu->delete($id);

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_menu.menu')]));

        return redirect()->back();
    }
}
