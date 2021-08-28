<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\Breadcrumb;
use App\Repositories\MenuRepository;
use App\Repositories\MenuItemRepository;
use App\Repositories\PageRepository;
use Yajra\DataTables\Facades\DataTables;

# Models
use App\Models\Menu;
use App\Models\MenuItem;

class MenuItemController extends Controller
{

    protected $menu;
    protected $menu_item;
    protected $page;

    public function __construct(
        MenuRepository $menu,
        MenuItemRepository $menu_item,
        PageRepository $page
    )
    {
        $this->menu = $menu;
        $this->menu_item = $menu_item;
        $this->page = $page;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Breadcrumb::title(trans('admin_menu_item.title'));

        $tree_menu = MenuItem::treeCMS();
        $menu_item = MenuItem::getMenuItemListCMS($tree_menu);

        return view('admin.menu_item.index', compact('menu_item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Breadcrumb::title(trans('admin_menu_item.create'));

        // List Menu
        $menu = $this->menu->all();
        
        // List Menuitem to parent
        $tree_menu = MenuItem::treeCMS();
        $menu_parent = MenuItem::getSelectOption($tree_menu);

        $types = MenuItem::types();
        $target = MenuItem::target();

        return view('admin.menu_item.create_edit', compact(
            'menu',
            'menu_parent',
            'types',
            'target'
        ));
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

        $this->menu_item->store($input);

        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_menu_item.menu')]));

        return redirect()->route('admin.menu.item.index');
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

        $menu_item = $this->menu_item->find($id);

        // List Menu
        $menu = $this->menu->all();
        
        // List Menu Item to parent
        $tree_menu = MenuItem::treeCMS();
        $menu_parent = MenuItem::getSelectOption($tree_menu, $menu_item->parent_id);

        $types = MenuItem::types();
        $target = MenuItem::target();

        // List Menu of Menuitem
        $array_menu = $menu_item->menus->pluck('id')->toArray();

        $type = $menu_item->type;

        $data_link = $this->getDataLink($type);

        return view('admin.menu_item.create_edit', compact(
            'menu_item',
            'menu',
            'menu_parent',
            'types',
            'target',
            'type',
            'data_link',
            'array_menu'
        ));
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

        $this->menu_item->update($input, $id);

        session()->flash('success', trans('admin_message.updated_successful', ['attr' => trans('admin_menu_item.menu_item')]));

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
        $this->menu_item->delete($id);

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_menu_item.menu_item')]));

        return redirect()->back();
    }

    /* 
        Get data from table
        $type : table name
    */
    public function getDataLink($type)
    {
        if($type != 'custom_link')
            return \DB::table($type)->get();
        
        return null;
    }

    public function getTheme(Request $request)
    {
        $input = $request->only('type');

        $type = $input['type'];

        if($type == 'custom_link') {
            return restSuccess();
        }
        
        if($type != 'custom_link' && $type != '') {
            $data_link = \DB::table($type)->get();
        }

        return view('admin.menu_item.partials.theme_link_ajax', compact('data_link', 'type'));
    }

    public function sort(Request $request)
    {
        $position = $request->input('position');
        $arr = explode('&', $position);
        if ($arr && count($arr)) {
            for ($i = 0; $i < count($arr); $i++) {
                $_arr = explode('=', $arr[$i]);
                MenuItem::where('id', $_arr[0])->update(['position' => $_arr[1]]);
            }
        }
    }

}
