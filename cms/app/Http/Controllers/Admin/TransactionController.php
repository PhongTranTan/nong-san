<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Breadcrumb;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryCreateRequest;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class TransactionController extends Controller
{
    protected $transaction;

    public function __construct(TransactionRepository $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Breadcrumb::title(trans('admin_transaction.title'));
        return view('admin.transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Breadcrumb::title(trans('admin_transaction.create'));

        return view('admin.transaction.create_edit');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryCreateRequest $request)
    {
        $input = $request->all();

        $this->transaction->create($input);

        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_transaction.transaction')]));

        return redirect()->route('admin.transaction.index');
    }

    public function datatable(Request $request)
    {
        $transaction = $this->transaction->datatable();
        if($customer_id = $request->get('customer_id'))
            $transaction = $transaction->where('customer_id', $customer_id);

        return Datatables::of($transaction)
            ->editColumn(
                'cancel_completed_at',
                function ($data){
                    return getStatusDate($data);
                }
            )
            ->editColumn(
                'amount_to',
                function ($data){
                    return round($data->amount_to, 2);
                }
            )
            ->editColumn(
                'hashes',
                function ($data) {
                    return "<a target='_blank' class='btn btn-info' href='".route('admin.transaction.show',$data->id)."'>Chi tiết</a>";
                }
            )
            ->editColumn(
                'status',
                function ($data) {
                    switch ($data->status)
                    {
                        case TRANSACTION_CANCEL: return '<span class="label label-danger">'. $data->status .'</span>';
                        case TRANSACTION_COMPLETED: return '<span class="label label-success">'. $data->status .'</span>';
                        default: return '<span class="label label-warning">'. $data->status .'</span>';
                    }
                }
            )
            ->addColumn(
                'action', function ($data) {
                return view('admin.layouts.partials.table_button')->with(
                    [
                        'btn_view_datatable' => true,
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
        return $this->transaction->find($id)->hashes;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Breadcrumb::title(trans('admin_transaction.edit'));

        $transaction = $this->transaction->find($id);

        return view('admin.transaction.create_edit', compact('transaction'));
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
        $input = $request->only('active');

        $this->transaction->update($input, $id);

        if($request->ajax()){
            return ['success'=>true, 'message'=>'Cập nhật trạng thái khách hàng thành công','notify_class'=>'success'];
        }

        session()->flash('success', trans('admin_message.updated_successful', ['attr' => trans('admin_transaction.transaction')]));

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
        $this->transaction->delete($id);

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_transaction.transaction')]));

        return redirect()->back();
    }
}