<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Breadcrumb;
use App\Http\Controllers\Controller;
use App\Repositories\VenueCategoryRepository;
use App\Repositories\VenueRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VenueController extends Controller
{
    protected $venue;
    protected $venue_category;

    public function __construct(VenueRepository $venue, VenueCategoryRepository $venue_category)
    {
        $this->venue = $venue;
        $this->venue_category = $venue_category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Breadcrumb::title(trans('admin_venue.title'));
        return view('admin.venue.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Breadcrumb::title(trans('admin_venue.create'));
        $venue_category = $this->venue_category->datatable()->where('active',1)->get();
        return view('admin.venue.create_edit', compact('venue_category'));
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

        $this->venue->create($input);

        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_venue.venue')]));

        return redirect()->route('admin.venue.index');
    }

    public function datatable()
    {
        $data = $this->venue->datatable();

        return Datatables::of($data)
            ->editColumn(
                'active',
                function ($data) {
                    if ($data->active)
                        return '<span class="label label-success">'. trans('label.active') .'</span>';
                    return '<span class="label label-warning">'. trans('label.inactive') .'</span>';
                }
            )
            ->addColumn(
                'action', function ($data) {
                return view('admin.layouts.partials.table_button')->with(
                    [
                        'link_edit' => route('admin.venue.edit', $data->id),
                        'link_delete' => route('admin.venue.destroy', $data->id),
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
        Breadcrumb::title(trans('admin_venue.edit'));

        $venue = $this->venue->find($id);
        $venue_category = $this->venue_category->datatable()->where('active',1)->get();
        return view('admin.venue.create_edit', compact('venue', 'venue_category'));
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
        $this->venue->update($input, $id);
        session()->flash('success', trans('admin_message.updated_successful', ['attr' => trans('admin_venue.venue')]));
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
        $this->venue->delete($id);

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_venue.venue')]));

        return redirect()->back();
    }
}