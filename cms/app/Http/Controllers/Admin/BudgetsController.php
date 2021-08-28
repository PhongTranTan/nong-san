<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Breadcrumb;
use App\Http\Controllers\Controller;
use App\Repositories\BudgetsRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class BudgetsController extends Controller
{
    protected $budgets;

    public function __construct(BudgetsRepository $budgets)
    {
        $this->budgets = $budgets;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Breadcrumb::title(trans('budgets.title'));
        return view('admin.budgets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Breadcrumb::title(trans('budgets.create'));

        return view('admin.budgets.create_edit');
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

        $this->budgets->create($input);

        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_budgets.budgets')]));

        return redirect()->route('admin.budgets.index');
    }

    public function datatable()
    {
        $data = $this->budgets->datatable();

        return Datatables::of($data)
            ->addColumn(
                'action', function ($data) {
                return view('admin.layouts.partials.table_button')->with(
                    [
                        'link_edit' => route('admin.budgets.edit', $data->id),
                        'link_delete' => route('admin.budgets.destroy', $data->id),
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
        Breadcrumb::title(trans('admin_budgets.edit'));

        $budgets = $this->budgets->find($id);

        return view('admin.budgets.create_edit', compact('budgets'));
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

        $this->budgets->update($input, $id);

        if($request->ajax()){
            return ['success'=>true, 'message'=>'Cập nhật trạng thái thành công','notify_class'=>'success'];
        }

        session()->flash('success', trans('admin_message.updated_successful', ['attr' => trans('admin_budgets.budgets')]));

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
        $this->budgets->delete($id);

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_budgets.budgets')]));

        return redirect()->back();
    }
}